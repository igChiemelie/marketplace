<?php
namespace App\Http\Middleware;
use Closure;
class EnsureUserIsVendor
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isVendor()) { abort(403); }
        return $next($request);
    }
}
