<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\UserAccountVerificationMail;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yoeunes\Toastr\Facades\Toastr;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.dashboard', compact('user'));
    }

    public function showRegistrationForm()
    {
        return view('auth.registrationForm');
    }

    public function storeRegistration(Request $request)
    {
        // Validate input
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $verificationCode = rand(100000, 999999);

        try {
            // Create user with verification code
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'password' => $input['password'],
                'verification_code' => $verificationCode,
                'status' => 0,
                'role' => 'user',
            ]);

            // Send verification email
            Mail::to($request->email)->send(new UserAccountVerificationMail($user));

            Toastr::success('Account created, please verify', 'Success');
            return redirect()->route('user.verification');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return back()->withErrors(['email' => 'The email has already been taken. Please choose a different email.']);
            }
            return back()->withErrors(['email' => 'An error occurred. Please try again later.']);
        }
    }




    public function showVerificationForm()
    {
        return view('auth.registrationVerification');
    }


    public function verify(Request $request)
    {
        $this->validate($request, [
            'verification_code' => 'required',
        ]);
        $user = User::where('verification_code', $request->verification_code)->first();
        if ($user) {
            $user->update([
                'status' => 1,
                'verification_code' => null,
            ]);
            $user = User::where('email', $user->email)->first();

            if ($user) {
                //dd($user);
                $user->update([
                    'email_verified_at' => now(),
                ]);
                Toastr::success('Your account has been verified. You can now Login', 'Success');
                return redirect()->route('user.dashboard');
            } else {
                return back()->withErrors(['verification_code' => 'No associated user found for this email.']);
            }
        } else {
            return back()->withErrors(['verification_code' => 'Invalid verification code.']);
        }
    }

}
