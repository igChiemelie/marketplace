<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
// use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerWelcomeMail;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Auth\Events\Registered;

// class RegisterController extends Controller
// {
//     /*
//     |--------------------------------------------------------------------------
//     | Register Controller
//     |--------------------------------------------------------------------------
//     |
//     | This controller handles the registration of new users as well as their
//     | validation and creation. By default this controller uses a trait to
//     | provide this functionality without requiring any additional code.
//     |
//     */

//     use RegistersUsers;

//     /**
//      * Where to redirect users after registration.
//      *
//      * @var string
//      */
//     protected $redirectTo = '/home';

//     /**
//      * Create a new controller instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         $this->middleware('guest');
//     }

//     /**
//      * Get a validator for an incoming registration request.
//      *
//      * @param  array  $data
//      * @return \Illuminate\Contracts\Validation\Validator
//      */
//     protected function validator(array $data)
//     {
//         return Validator::make($data, [
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//             'password' => ['required', 'string', 'min:8', 'confirmed'],
//         ]);
//     }

//     /**
//      * Create a new user instance after a valid registration.
//      *
//      * @param  array  $data
//      * @return \App\Models\User
//      */
//     protected function create(array $data)
//     {
//         return User::create([
//             'name' => $data['name'],
//             'email' => $data['email'],
//             'password' => Hash::make($data['password']),
//         ]);
//     }
// }


class RegisterController extends Controller 
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showCustomerRegisterForm()
    {
        return view('auth.customer_register');
    }

    public function registerCustomer(Request $request)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'role'=>'customer',
            'status'=>'pending', //pending until email verification
        ]);

        // Trigger Laravel's verification email
        // event(new Registered($user));
        // Send verification email
        // $user->sendEmailVerificationNotification();

        Mail::to($user->email)->queue(new CustomerWelcomeMail($user));
        auth()->guard()->login($user);


        return redirect()->route('home')->with('success','Welcome!');
        // return redirect()->route('customer.dashboard')->with('success', 'Registration successful! Please check your email to verify your account.');
    }
}
