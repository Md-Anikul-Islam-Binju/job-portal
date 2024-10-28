<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function frontend()
    {
        $category = Category::latest()->get();
        $job = Job::latest()->get();
        $siteSetting = SiteSetting::latest()->first();

        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;
        return inertia('Index',compact('category','job','siteSetting','auth'));
    }
}
