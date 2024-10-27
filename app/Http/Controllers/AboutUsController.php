<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function about()
    {
        $about = About::latest()->first();
        $siteSetting = SiteSetting::latest()->first();
        return inertia('AboutUs',compact('about','siteSetting'));
    }
}
