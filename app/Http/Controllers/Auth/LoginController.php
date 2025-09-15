<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


    public function showCustomerLoginForm()
    {
        return view('auth.login');
        
    }

    public function customerLogin(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            if (Auth::user()->role === 'customer') {
                // return redirect()->route('customer.dashboard');
                // return redirect()->route('home');
                // return redirect()->intended(route('checkout.show'));
                // dd(session()->all());
                // 👇 Go to intended URL if exists, otherwise /home
                return redirect()->intended($this->redirectTo);
            }
            Auth::logout();
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showVendorLoginForm()
    {
        // return view('auth.vendor_login');
        // return view('auth.login');
        return view('auth.vendor_login');

    }

    public function vendorLogin(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            if (Auth::user()->role === 'vendor') {
                return redirect()->route('vendor.dashboard')->with('success','Logged in successfully.');
            }
            Auth::logout();
        }
        return back()->withErrors(['email' => 'Incorrect email or password']);
    }

    public function showAdminLoginForm()
    {
        // return view('auth.admin_login');
        return view('auth.admin_login');
    }

    public function adminLogin(Request $request)
    {
        if (Auth::attempt($request->only('email','password'))) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

}
