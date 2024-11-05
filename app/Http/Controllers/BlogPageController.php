<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function blog()
    {
        $siteSetting = SiteSetting::latest()->first();
        return inertia('Blog',compact('siteSetting'));
    }
}
