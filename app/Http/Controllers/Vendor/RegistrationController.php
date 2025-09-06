<?php
namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VendorProfile;
use App\Mail\VendorWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showRegistrationForm()
    {
        // return view('vendor.auth.register');
        return view('auth.vendor_register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|confirmed',
            'shop_name'=>'required|string|max:255',
            'nin'=>'required|string|max:255',
            'phone'=>'required|string|max:255',
            'shop_description'=>'required|string|max:255',
        ]);

        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'password'=>Hash::make($data['password']),
            'role'=>'vendor',
            'status'=>'pending',
        ]);

        $vendor = VendorProfile::create([
            'user_id'=>$user->id,
            'nin'=>$data['nin'],
            'shop_name'=>$data['shop_name'],
            'shop_description'=>$data['shop_description'],
            'shop_slug'=>Str::slug($data['shop_name']).'-'.Str::random(4),
            'approval_status'=>'pending'
        ]);

        Mail::to($user->email)->queue(new VendorWelcomeMail($vendor));

        return redirect()->route('vendor.registration.success')->with('success','Application submitted.');
        // return redirect()->route('auth.vendor_login')->with('success','Application submitted.');
    }

    public function registrationSuccess()
    {
        return view('auth.vendor_login');
    }
}
