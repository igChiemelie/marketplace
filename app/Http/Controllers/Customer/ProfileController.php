<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('customer.profile');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate(['name'=>'required','email'=>'required|email']);
        $user->update($data);
        return redirect()->route('customer.profile')->with('success','Profile updated');
    }
}
