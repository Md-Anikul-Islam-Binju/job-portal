<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermsConditionController extends Controller
{
    public function termsCondition()
    {
        $terms = TermsAndCondition::latest()->first();
        $siteSetting = SiteSetting::latest()->first();
        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;
        return inertia('TermsCondition',compact('terms','siteSetting','auth'));
    }
}
