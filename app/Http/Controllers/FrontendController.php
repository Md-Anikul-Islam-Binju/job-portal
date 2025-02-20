<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\Location;
use App\Models\Review;
use App\Models\SiteSetting;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function frontend()
    {
        //$category = Category::withCount('jobs')->latest()->limit(20)->get();
        $category = Category::withCount(['jobs' => function ($query) {
            $query->where('deadline', '>=', now()->toDateString());
        }])->latest()->limit(20)->get();

        $job = Job::with('company')->where('deadline', '>=', now()->toDateString())->latest()->limit(50)->get();
        $siteSetting = SiteSetting::latest()->first();
        $slider = Slider::latest()->get();
        $company = User::where('role','=','company')->latest()->limit(24)->get();
        $location = Location::latest()->get();
        $review = Review::latest()->limit(3)->get();
        $jobTotal = Job::where('deadline', '>=', now()->toDateString())->count();
        $companyTotal = User::where('role', '=','company')->count();
        $vacancyTotal = Job::where('deadline', '>=', now()->toDateString())->sum('vacancy');
        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'name_bn' => Auth::user()->name_bn,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;
        return inertia('Index',compact('category','job','siteSetting','auth',
            'slider','company','location','review','jobTotal','companyTotal','vacancyTotal'));
    }
}
