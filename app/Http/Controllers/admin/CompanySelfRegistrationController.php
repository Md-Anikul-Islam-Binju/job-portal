<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\CompanyAccountVerificationMail;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yoeunes\Toastr\Facades\Toastr;

class CompanySelfRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.registrationFormByCompany');
    }

    public function storeRegistration(Request $request)
    {
        // Validate input
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'licence' => 'required',
            'address' => 'required',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $verificationCode = rand(100000, 999999);

        try {
            if ($request->hasFile('licence')) {
                $licenceFile = time() . '.' . $request->licence->extension();
                $request->licence->move(public_path('images/licence'), $licenceFile);
                $input['licence'] = $licenceFile; // Store file name in input array
            }
            // Create user with verification code
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'licence' => $input['licence'],
                'password' => $input['password'],
                'verification_code' => $verificationCode,
                'status' => 0,
                'role' => 'company',
            ]);

            // Send verification email
            Mail::to($request->email)->send(new CompanyAccountVerificationMail($user));

            Toastr::success('Company created, please verify', 'Success');
            return redirect()->route('company.verification');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                return back()->withErrors(['email' => 'The email has already been taken. Please choose a different email.']);
            }
            return back()->withErrors(['email' => 'An error occurred. Please try again later.']);
        }
    }




    public function showVerificationForm()
    {
        return view('auth.registrationVerificationByCompany');
    }


    public function verify(Request $request)
    {
        $this->validate($request, [
            'verification_code' => 'required',
        ]);
        $user = User::where('verification_code', $request->verification_code)->first();
        if ($user) {
            $user->update([
                'status' => 0,
                'verification_code' => null,
            ]);
            $user = User::where('email', $user->email)->first();

            if ($user) {
                //dd($user);
                $user->update([
                    'email_verified_at' => now(),
                ]);
                Toastr::success('Your Company has been verified. You can now Login', 'Success');
                return redirect()->route('company.dashboard');
            } else {
                return back()->withErrors(['verification_code' => 'No associated user found for this email.']);
            }
        } else {
            return back()->withErrors(['verification_code' => 'Invalid verification code.']);
        }
    }
}
