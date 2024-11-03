<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $companies = User::where('role', 'company')->get();
        $totalCompany = User::where('role', 'company')->count();
        $totalUser = User::where('role', 'user')->count();
        $totalCategory = Category::count();
        $totalLocation = Location::count();

        return view('admin.dashboard', compact('companies','totalCategory',
        'totalCompany','totalLocation','totalUser'));
    }

}
