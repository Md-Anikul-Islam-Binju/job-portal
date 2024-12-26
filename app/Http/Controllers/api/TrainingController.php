<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function training()
    {
        $training = Training::latest()->get();
        return response()->json($training);
    }
}
