<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\UserAccountVerificationMail;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalJob = Job::count();
        $totalApply = JobApplication::where('user_id',auth()->user()->id)->count();
        return view('user.dashboard', compact('user','totalJob','totalApply'));
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


    public function account()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('user.pages.account.index', compact('user'));
    }

    public function createOrUpdateAccount(Request $request, $id = null)
    {
        // Validation rules
        $rules = [
            'name' => 'nullable',
            'name_bn' => 'nullable',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'phone' => 'nullable|unique:users,phone,' . $id,
            'father_name' => 'nullable',
            'father_name_bn' => 'nullable',
            'mother_name' => 'nullable',
            'mother_name_bn' => 'nullable',
            'nationality' => 'nullable',
            'nationality_bn' => 'nullable',
            'blood_group' => 'nullable',
            'blood_group_bn' => 'nullable',
            'nid' => 'nullable',
            'dob' => 'nullable|date',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:5120',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:5120',
            'address' => 'nullable',
            'address_bn' => 'nullable',
            'details' => 'nullable',
            'details_bn' => 'nullable',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find or create user based on provided ID
        $user = $id ? User::findOrFail($id) : new User;

        // Update user fields except for files
        $user->fill($request->except(['profile', 'cv', 'resume']));

        // Handle profile image upload
        if ($request->hasFile('profile')) {
            // Delete the previous profile image if it exists
            if ($user->profile && File::exists(public_path($user->profile))) {
                File::delete(public_path($user->profile));
            }
            $profileName = time().'.'.$request->file('profile')->extension();
            $request->file('profile')->move(public_path('images/profile'), $profileName);
            $user->profile = 'images/profile/'.$profileName;
        }

        // Handle CV upload
        if ($request->hasFile('cv')) {
            // Delete the previous CV if it exists
            if ($user->cv && File::exists(public_path($user->cv))) {
                File::delete(public_path($user->cv));
            }
            $cvName = time().'.'.$request->file('cv')->extension();
            $request->file('cv')->move(public_path('images/cv'), $cvName);
            $user->cv = 'images/cv/'.$cvName;
        }

        // Handle resume upload
        if ($request->hasFile('resume')) {
            // Delete the previous resume if it exists
            if ($user->resume && File::exists(public_path($user->resume))) {
                File::delete(public_path($user->resume));
            }
            $resumeName = time().'.'.$request->file('resume')->extension();
            $request->file('resume')->move(public_path('images/resume'), $resumeName);
            $user->resume = 'images/resume/'.$resumeName;
        }

        // Save user data
        $user->save();

        $message = $id ? 'Account settings updated successfully!' : 'Account created successfully!';
        return redirect()->back()->with('success', $message);
    }

    public function applyJob(Request $request, Job $job)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Please login to apply for the job.'], 401);
        }

        $user = auth()->user();

        // Check if the user has already applied for the job
        $existingApplication = JobApplication::where('job_id', $job->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($existingApplication) {
            return response()->json(['message' => 'You have already applied for this job.'], 409);
        }

        // Create the job application
        JobApplication::create([
            'job_id' => $job->id,
            'user_id' => $user->id,
            'company_id' => $job->company_id,
        ]);

        return response()->json(['message' => 'Application successful!'], 200);
    }

    public function applyJobList()
    {
        $candidate = JobApplication::where('user_id',auth()->user()->id)->with('company','job')->get();
        return view('user.pages.account.applyJob',compact('candidate'));
    }






}
