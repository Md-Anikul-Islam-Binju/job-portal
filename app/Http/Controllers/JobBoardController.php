<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Location;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobBoardController extends Controller
{
    public function jobBoard()
    {
        $category = Category::latest()->get();
        $locations = Location::latest()->get();
        $job = Job::with('company')->where('deadline', '>=', now()->toDateString())->latest()->get();
        $siteSetting = SiteSetting::latest()->first();
        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'name_bn' => Auth::user()->name_bn,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;
        return inertia('JobBoard',compact('category','locations','job','siteSetting','auth'));
    }


    public function jobDetails($id)
    {
        $job = Job::where('id', $id)->first();
        $siteSetting = SiteSetting::latest()->first();
        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;

        $appliedJobs = [];
        if (auth()->check()) {
            $appliedJobs = JobApplication::where('user_id', auth()->id())->pluck('job_id')->toArray();
        }

        return inertia('JobDetails', compact('job', 'siteSetting', 'auth', 'appliedJobs'));
    }


}
