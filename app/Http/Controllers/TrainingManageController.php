<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\TermsAndCondition;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingManageController extends Controller
{
    public function training(Request $request)
    {
        $siteSetting = SiteSetting::latest()->first();

        // Paginate the trainings with search functionality
        $trainings = Training::when($request->search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->get();

        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'name_bn' => Auth::user()->name_bn,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;

        return inertia('Training', compact('siteSetting', 'trainings', 'auth'));
    }

    public function trainingDetails($id)
    {
        $siteSetting = SiteSetting::latest()->first();
        $training = Training::where('id',$id)->first();
        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'name_bn' => Auth::user()->name_bn,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;
        return inertia('TrainingDetails', compact('siteSetting', 'training','auth'));
    }
}
