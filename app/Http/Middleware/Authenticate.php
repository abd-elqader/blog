<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $guard = Auth::getDefaultDriver();
        $guard1 = Auth::guard('web');
        dd($guard, $guard1);
        switch ($guard) {
            case 'admin':
                return $request->expectsJson() ? null : route('dashboard.login');

            // case 'another_guard':
            //     return $request->expectsJson() ? null : route('another_guard.login');

            // Add more cases for other guards as needed

            default:
                return $request->expectsJson() ? null : route('login');
        }

    }
}
