<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

class TermsConditionController extends Controller
{
    public function termsCondition()
    {
        $terms = TermsAndCondition::latest()->first();
        $siteSetting = SiteSetting::latest()->first();
        return inertia('TermsCondition',compact('terms','siteSetting'));
    }
}
