<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function frontend()
    {
        $category = Category::latest()->get();
        $job = Job::latest()->get();
        $siteSetting = SiteSetting::latest()->first();
        return inertia('Index',compact('category','job','siteSetting'));
    }
}
