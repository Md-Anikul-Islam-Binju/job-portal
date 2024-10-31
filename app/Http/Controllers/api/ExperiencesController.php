<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Experiences;
use Illuminate\Http\Request;

class ExperiencesController extends Controller
{
    public function index()
    {
        $experience = Experiences::where('user_id', auth()->user()->id)->latest()->get();
        return response()->json($experience);
    }

    // Store a new experience record
    public function store(Request $request)
    {
        $request->validate([
            'office_name' => 'required|string',
            'designation' => 'required|string',
            'year_of_experience' => 'required|integer',
        ]);

        try {
            $experience = Experiences::create([
                'office_name' => $request->office_name,
                'office_name_bn' => $request->office_name_bn,
                'designation' => $request->designation,
                'designation_bn' => $request->designation_bn,
                'year_of_experience' => $request->year_of_experience,
                'user_id' => auth()->user()->id,
            ]);

            return response()->json(['message' => 'Experience Added Successfully', 'data' => $experience], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
