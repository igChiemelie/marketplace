<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait ApiResponse
{
    protected function success(Request $request, $data = [], $message = 'Success', $status = 200)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $data,
            ], $status);
        }
        return $data; // fallback for Blade views
    }

    protected function error(Request $request, $message = 'Error', $status = 400)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => $message,
            ], $status);
        }
        return back()->withErrors(['error' => $message]);
    }
}
