<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class CompanyDashboardController extends Controller
{
    public function index()
    {
        $company = auth()->user();
        if ($company->status === 0) {
            return view('company.message');
        }
        $totalJob = Job::where('company_id',auth()->user()->id)->count();
        $totalCandidate = JobApplication::where('company_id',auth()->user()->id)->count();
        return view('company.dashboard', compact('company','totalJob','totalCandidate'));
    }

}
