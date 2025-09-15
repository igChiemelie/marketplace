<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\VendorProfile;
use Intervention\Image\Facades\Image;

class VendorProfileController extends Controller
{
     public function index()
    {
        // Fetch all approved & active vendors with product count
        $vendors = VendorProfile::where('approval_status', 'approved')
            ->withCount('products')
            ->latest()
            ->paginate(2); // paginate for performance

        return view('vendors', compact('vendors'));
    }

    public function edit()
    {
        $vendor = VendorProfile::with('user')->where('user_id', Auth::id())->firstOrFail();
        return view('vendor.profile', compact('vendor'));
    }

    public function update(Request $request)
    {
        $vendor = VendorProfile::with('user')->where('user_id', Auth::id())->firstOrFail();
        $user = $vendor->user;

        $request->validate([
            'shop_name' => 'required|string|max:255',
            'shop_description' => 'nullable|string',
            'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'shop_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
        ]);

        // ---- Logo Upload ----
        if ($request->hasFile('shop_logo')) {
            // delete old logo if exists
            if ($vendor->shop_logo && Storage::disk('public')->exists($vendor->shop_logo)) {
                Storage::disk('public')->delete($vendor->shop_logo);
            }

            $logoFile = $request->file('shop_logo');
            $logoPath = 'vendors/logos/' . uniqid() . '.' . $logoFile->getClientOriginalExtension();

            // save inside storage/app/public/vendors/logos
            $logoFile->storeAs('vendors/logos', basename($logoPath), 'public');

            // store relative path (so asset('storage/...') works in Blade)
            $vendor->shop_logo = $logoPath;
        }

        // ---- Banner Upload ----
        if ($request->hasFile('shop_banner')) {
            // delete old banner if exists
            if ($vendor->shop_banner && Storage::disk('public')->exists($vendor->shop_banner)) {
                Storage::disk('public')->delete($vendor->shop_banner);
            }

            $bannerFile = $request->file('shop_banner');
            $bannerPath = 'vendors/banners/' . uniqid() . '.' . $bannerFile->getClientOriginalExtension();

            // save inside storage/app/public/vendors/banners
            $bannerFile->storeAs('vendors/banners', basename($bannerPath), 'public');

            // store relative path
            $vendor->shop_banner = $bannerPath;
        }


        // Update other fields
        $vendor->shop_name = $request->shop_name;
        $vendor->shop_description = $request->shop_description;
        $vendor->save();

        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    // public function update(Request $request)
    // {
    //     $vendor = Auth::user();

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'shop_name' => 'required|string|max:255',
    //         'phone' => 'nullable|string|max:20',
    //         'address' => 'nullable|string|max:255',
    //         'logo' => 'nullable|image|max:2048',
    //         'description' => 'nullable|string',
    //     ]);

    //     $vendor->name = $request->name;
    //     $vendor->shop_name = $request->shop_name;
    //     $vendor->phone = $request->phone;
    //     $vendor->address = $request->address;
    //     $vendor->description = $request->description;

    //     if ($request->hasFile('logo')) {
    //         // delete old logo if exists
    //         if ($vendor->shop_logo && Storage::exists($vendor->shop_logo)) {
    //             Storage::delete($vendor->shop_logo);
    //         }
    //         $vendor->shop_logo = $request->file('logo')->store('vendor_logos', 'public');
    //     }

    //     $vendor->save();

    //     return redirect()->route('vendor.profile.edit')->with('success', 'Profile updated successfully!');
    // }
}
