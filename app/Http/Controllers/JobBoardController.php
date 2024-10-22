<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class JobBoardController extends Controller
{
    public function jobBoard()
    {
        $category = Category::latest()->get();
        $job = Job::latest()->get();
        $siteSetting = SiteSetting::latest()->first();
        return inertia('JobBoard',compact('category','job','siteSetting'));
    }
}
