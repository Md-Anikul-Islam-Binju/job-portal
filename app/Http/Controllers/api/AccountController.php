<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function account()
    {
        $user = auth()->user(); // Get the authenticated user
        return response()->json($user); // Return user details as JSON
    }

    public function createOrUpdateAccount(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'nullable',
            'name_bn' => 'nullable',
            'email' => 'nullable|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|unique:users,phone,' . auth()->id(),
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
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Get the authenticated user
        $user = auth()->user();

        // Update user fields except for files
        $user->fill($request->except(['profile', 'cv', 'resume']));

        // Handle file uploads (similar to previous logic)
        if ($request->hasFile('profile')) {
            if ($user->profile && File::exists(public_path($user->profile))) {
                File::delete(public_path($user->profile));
            }
            $profileName = time().'.'.$request->file('profile')->extension();
            $request->file('profile')->move(public_path('images/profile'), $profileName);
            $user->profile = 'images/profile/'.$profileName;
        }

        // Handle CV upload
        if ($request->hasFile('cv')) {
            if ($user->cv && File::exists(public_path($user->cv))) {
                File::delete(public_path($user->cv));
            }
            $cvName = time().'.'.$request->file('cv')->extension();
            $request->file('cv')->move(public_path('images/cv'), $cvName);
            $user->cv = 'images/cv/'.$cvName;
        }

        // Handle resume upload
        if ($request->hasFile('resume')) {
            if ($user->resume && File::exists(public_path($user->resume))) {
                File::delete(public_path($user->resume));
            }
            $resumeName = time().'.'.$request->file('resume')->extension();
            $request->file('resume')->move(public_path('images/resume'), $resumeName);
            $user->resume = 'images/resume/'.$resumeName;
        }

        // Save user data
        $user->save();

        return response()->json(['message' => 'Account updated successfully!', 'user' => $user], 200);
    }

    public function jobList()
    {
        $job = Job::latest()->get();
        return response()->json($job); // Return user details as JSON
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
        $candidate = JobApplication::where('user_id', auth()->user()->id)->with('company', 'job')->get();
        return response()->json($candidate, 200); // Return applied jobs as JSON
    }



}
