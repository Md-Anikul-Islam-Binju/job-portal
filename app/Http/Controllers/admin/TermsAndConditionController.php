<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermsAndConditionController extends Controller
{
    public function index()
    {
        $termsAndCondition = TermsAndCondition::where('id', 1)->first();
        return view('admin.pages.termsAndCondition.index', compact('termsAndCondition'));
    }

    public function createOrUpdateTermsCondition(Request $request, $id = null)
    {
        // Define validation rules for title and details
        $rules = [
            'title' => 'nullable|string|max:255',
            'details' => 'nullable|string',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if updating an existing About entry or creating a new one
        if ($id) {
            $termsAndCondition = TermsAndCondition::findOrFail($id);
            // Update only title and details
            $termsAndCondition->update($request->only(['title','title_bn', 'details','details_bn']));
        } else {
            // Create a new About entry with only title and details
            $termsAndCondition = TermsAndCondition::create($request->only(['title','title_bn', 'details','details_bn']));
        }

        // Prepare the success message
        $message = $id ? 'Terms And Condition updated successfully!' : 'Terms And Condition created successfully!';
        return redirect()->back()->with('success', $message);
    }
}
