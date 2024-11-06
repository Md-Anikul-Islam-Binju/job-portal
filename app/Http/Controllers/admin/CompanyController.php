<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yoeunes\Toastr\Facades\Toastr;

class CompanyController extends Controller
{
    public function index()
    {
        $company = User::where('role','=','company')->latest()->get();
        return view('admin.pages.company.index', compact('company'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email', // Ensures email is unique
                'phone' => 'required',
                'password' => 'required|min:8', // Ensures a minimum password length
                'profile' => 'required',
            ]);

            // Handle licence image upload
            $licenceFile = time() . '.' . $request->licence->extension();
            $request->licence->move(public_path('images/licence'), $licenceFile);

            $company = new User();
            $company->name = $request->name;
            $company->name_bn = $request->name_bn;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->address = $request->address;
            $company->role = 'company';
            $company->status = 1;
            $company->licence = $licenceFile;

            // Handle profile image upload if provided
            if ($request->hasFile('profile')) {
                $profileFile = time() . '.' . $request->profile->extension();
                $request->profile->move(public_path('images/logo'), $profileFile);
                $company->profile = $profileFile;
            }
            // Hash and save password
            $company->password = bcrypt($request->password);
            $company->save();
            Toastr::success('Company Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'required',
                'licence' => 'nullable|image',
                'profile' => 'nullable',
            ]);

            $company = User::findOrFail($id);
            $company->name = $request->name;
            $company->name_bn = $request->name_bn;
            $company->email = $request->email;
            $company->phone = $request->phone;
            $company->address = $request->address;
            $company->status = $request->status;

            // Update password if provided
            if ($request->filled('password')) {
                $company->password = Hash::make($request->password);
            }

            // Licence image upload if provided
            if ($request->hasFile('licence')) {
                $licenceFilePath = public_path('images/licence/' . $company->licence);
                if (file_exists($licenceFilePath)) {
                    unlink($licenceFilePath);
                }
                $licenceFile = time() . '.' . $request->licence->extension();
                $request->licence->move(public_path('images/licence'), $licenceFile);
                $company->licence = $licenceFile;
            }

            // Profile image upload if provided
            if ($request->hasFile('profile')) {
                $profileFilePath = public_path('images/logo/' . $company->profile);
                if (file_exists($profileFilePath)) {
                    unlink($profileFilePath);
                }
                $profileFile = time() . '.' . $request->profile->extension();
                $request->profile->move(public_path('images/logo'), $profileFile);
                $company->profile = $profileFile;
            }

            $company->save();
            Toastr::success('Company Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $company = User::findOrFail($id);

            // Delete licence image if exists
            $licenceFilePath = public_path('images/licence/' . $company->licence);
            if (file_exists($licenceFilePath)) {
                unlink($licenceFilePath);
            }

            // Delete profile image if exists
            $profileFilePath = public_path('images/logo/' . $company->profile);
            if (file_exists($profileFilePath)) {
                unlink($profileFilePath);
            }

            $company->delete();
            Toastr::success('Company Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function companyUnderJob($id)
    {
        $job = Job::where('company_id', $id)->latest()->get();
        return view('admin.pages.company.companyUnderJob', compact('job'));
    }


    public function companyUnderJobApplyCandidate($id)
    {
        $jobApplication = JobApplication::where('job_id', $id)->with('user')->latest()->get();
        $jobApplicationCount = JobApplication::where('job_id', $id)->count();
        return view('admin.pages.company.companyUnderJobApplication', compact('jobApplication', 'jobApplicationCount'));
    }

    public function companyUnderJobApplyCandidateDestroy($id)
    {
        try {
            $jobApplication = JobApplication::find($id);
            $jobApplication->delete();
            Toastr::success('Job Application Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }



}
