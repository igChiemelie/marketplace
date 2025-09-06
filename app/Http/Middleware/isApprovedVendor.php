<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsApprovedVendor
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        // Make sure user is logged in and is a vendor
        if (!Auth::check() || Auth::user()->role !== 'vendor') {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        // Check vendor approval status
        if (Auth::user()->status !== 'active') {
            return redirect()->route('vendor.register.form')
                             ->with('error', 'Your vendor account is not yet approved.');
        }

        return $next($request);
    }
}
