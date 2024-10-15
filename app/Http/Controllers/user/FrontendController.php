<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function frontend()
    {
        $category = Category::latest()->get();
        $job = Job::latest()->get();
        return inertia('Index',compact('category','job'));
    }
}
