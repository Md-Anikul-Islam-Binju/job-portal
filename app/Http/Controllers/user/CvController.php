<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experiences;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function bangleCv()
    {
        $education = Education::where('user_id', auth()->user()->id)->latest()->get();
        $experience = Experiences::where('user_id', auth()->user()->id)->latest()->get();
        $skill = Skill::where('user_id', auth()->user()->id)->latest()->get();
        $user = User::where('id', auth()->user()->id)->first();
        return view('user.pages.cv.banglaCv', compact('education','experience','skill','user'));
    }


    public function englishCv()
    {
        $education = Education::where('user_id', auth()->user()->id)->latest()->get();
        $experience = Experiences::where('user_id', auth()->user()->id)->latest()->get();
        $skill = Skill::where('user_id', auth()->user()->id)->latest()->get();
        $user = User::where('id', auth()->user()->id)->first();
        return view('user.pages.cv.englishCv', compact('education','experience','skill','user'));
    }
}
