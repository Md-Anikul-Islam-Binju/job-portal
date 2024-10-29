<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\SiteSetting;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function frontend()
    {
        $category = Category::latest()->get();
        $job = Job::latest()->limit(50)->get();
        $siteSetting = SiteSetting::latest()->first();
        $slider = Slider::latest()->first();
        $company = User::where('role','=','company')->latest()->limit(4)->get();

        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'name_bn' => Auth::user()->name_bn,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;
        return inertia('Index',compact('category','job','siteSetting','auth','slider','company'));
    }
}
