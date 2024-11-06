<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    public function create(): View
    {
        return view('auth.login');
    }


    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();


        // Check if the user is a 'user' role and email is not verified
        if ($user->role == 'user' && is_null($user->email_verified_at)) {
            // Redirect to the verification page if email is not verified
            return redirect()->route('user.verification');
        }

        // Check if the user is a 'user' role and email is not verified
        if ($user->role == 'company' && is_null($user->email_verified_at)) {
            // Redirect to the verification page if email is not verified
            return redirect()->route('company.verification');
        }


        // Redirect based on user role
        if ($user->role == 'admin') {
            return redirect()->intended('/admin/dashboard');
        } elseif ($user->role == 'company') {
            if($user->status == 'inactive'){
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('message');
            }
            return redirect()->intended('/company/dashboard');
        }elseif ($user->role == 'user'){

            if($user->status == 'inactive'){
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('message');
            }
            return redirect()->intended('/user/dashboard');
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
