<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompanyMiddleware
{

    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->role === 'company') {
            if (is_null($user->email_verified_at)) {
                return redirect()->route('company.verification');
            }
            return $next($request);
        }
        return redirect('/');
    }
}
