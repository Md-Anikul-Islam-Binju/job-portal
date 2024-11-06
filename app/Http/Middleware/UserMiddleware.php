<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
//        if (auth()->check() && auth()->user()->role == 'user') {
//            return $next($request);
//        }
//        return redirect('/');

        $user = Auth::user();

        // Check if user is logged in, has the 'user' role, and email is verified
        if ($user && $user->role === 'user') {
            if (is_null($user->email_verified_at)) {
                // Redirect to verification page if email is not verified
                return redirect()->route('user.verification');
            }
            return $next($request);
        }

        // Redirect to home if not an authenticated user
        return redirect('/');
    }
}
