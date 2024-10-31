<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::latest()->get();
        return response()->json($skills);
    }

    // Store a new skill
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $skill = Skill::create([
                'name' => $request->name,
                'name_bn' => $request->name_bn,
            ]);

            return response()->json(['message' => 'Skill Added Successfully', 'data' => $skill], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
