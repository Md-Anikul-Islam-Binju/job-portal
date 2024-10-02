<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyDashboardController extends Controller
{
    public function index()
    {
        $company = auth()->user();
        return view('company.dashboard', compact('company'));
    }
}
