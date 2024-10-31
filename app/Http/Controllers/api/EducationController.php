<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $education = Education::where('user_id', auth()->user()->id)->latest()->get();
        return response()->json($education);
    }

    // Store a new education record
    public function store(Request $request)
    {
        $request->validate([
            'institute_name' => 'required|string',
            'degree_name' => 'required|string',
            'result' => 'required|string',
            'passing_year' => 'required|integer',
        ]);

        try {
            $education = Education::create([
                'institute_name' => $request->institute_name,
                'institute_name_bn' => $request->institute_name_bn,
                'degree_name' => $request->degree_name,
                'degree_name_bn' => $request->degree_name_bn,
                'result' => $request->result,
                'passing_year' => $request->passing_year,
                'user_id' => auth()->user()->id,
            ]);

            return response()->json(['message' => 'Education Added Successfully', 'data' => $education], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    // Update an existing education record
    public function update(Request $request, $id)
    {
        $request->validate([
            'institute_name' => 'required|string',
            'degree_name' => 'required|string',
            'result' => 'required|string',
            'passing_year' => 'required|integer',
        ]);

        try {
            $education = Education::findOrFail($id);
            $education->update($request->only(['institute_name', 'institute_name_bn', 'degree_name', 'degree_name_bn', 'result', 'passing_year']));

            return response()->json(['message' => 'Education Updated Successfully', 'data' => $education]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    // Delete an education record
    public function destroy($id)
    {
        try {
            $education = Education::findOrFail($id);
            $education->delete();

            return response()->json(['message' => 'Education Deleted Successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
