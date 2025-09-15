<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        // Customize where authenticated users are redirected
        $middleware->redirectUsersTo(function ($request) {
            return $request->user() ? '/' : null;
        });
        
        // Customize where authenticated and unauthenticated users are redirected
        // $middleware->redirectUsersTo(function ($request) {
        //     // If user is authenticated, redirect to home
        //     if ($request->user()) {
        //         return '/';
        //     }
        //     // If user is not authenticated, redirect to login
        //     return '/login';
        // });
        

         // Custom Role Middleware
        $middleware->alias([
            'isAdmin'   => \App\Http\Middleware\EnsureUserIsAdmin::class,
            'isVendor'  => \App\Http\Middleware\EnsureUserIsVendor::class,
            'isCustomer' => \App\Http\Middleware\IsCustomer::class,
            'isApprovedVendor' => \App\Http\Middleware\isApprovedVendor::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
