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


//    public function store(LoginRequest $request): RedirectResponse
//    {
//        $request->authenticate();
//        $request->session()->regenerate();
//        $user = Auth::user();
//
//        if ($user->role == 'user' && is_null($user->email_verified_at)) {
//            return redirect()->route('user.verification');
//        }
//
//        if ($user->role == 'company' && is_null($user->email_verified_at)) {
//            return redirect()->route('company.verification');
//        }
//
//        if ($user->role == 'admin') {
//            return redirect()->intended('/admin/dashboard');
//        } elseif ($user->role == 'company') {
//            if($user->status == 'inactive'){
//                Auth::guard('web')->logout();
//                $request->session()->invalidate();
//                $request->session()->regenerateToken();
//                return redirect()->route('message');
//            }
//            return redirect()->intended('/company/dashboard');
//        }elseif ($user->role == 'user'){
//
//            if($user->status == 'inactive'){
//                Auth::guard('web')->logout();
//                $request->session()->invalidate();
//                $request->session()->regenerateToken();
//                return redirect()->route('message');
//            }
//            return redirect()->intended('/user/dashboard');
//        }
//        return redirect()->intended(RouteServiceProvider::HOME);
//    }


    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on user role and status checks
            if ($user->role == 'user' && is_null($user->email_verified_at)) {
                return redirect()->route('user.verification');
            }

            if ($user->role == 'company' && is_null($user->email_verified_at)) {
                return redirect()->route('company.verification');
            }

            if ($user->role == 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role == 'company') {
                if ($user->status == 'inactive') {
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('message');
                }
                return redirect()->intended('/company/dashboard');
            } elseif ($user->role == 'user') {
                if ($user->status == 'inactive') {
                    Auth::guard('web')->logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    return redirect()->route('message');
                }
                return redirect()->intended('/user/dashboard');
            }

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle failed login attempts
            return back()->withErrors([
                'email' => 'The provided email or password is incorrect.',
            ])->withInput($request->only('email'));
        }
    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
