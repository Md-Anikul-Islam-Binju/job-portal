<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{
    public function about()
    {
        $about = About::latest()->first();
        $siteSetting = SiteSetting::latest()->first();
        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;
        return inertia('AboutUs',compact('about','siteSetting','auth'));
    }
}
