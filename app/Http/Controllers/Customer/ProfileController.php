<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $customer = auth()->user();
        // dd($customer);
        return view('customer.profile', compact('customer'));

    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'shop_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload if present
        if ($request->hasFile('shop_logo')) {
            $path = $request->file('shop_logo')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);
        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully!');
    }

    public function password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('customer.profile')->with('success', 'Password updated successfully.');
    }

}
