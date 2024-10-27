<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        $siteSetting = SiteSetting::latest()->first();
        return inertia('Contact',compact('siteSetting'));
    }
}
