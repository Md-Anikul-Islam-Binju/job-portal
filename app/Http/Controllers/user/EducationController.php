<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class EducationController extends Controller
{
    public function index()
    {
        $education = Education::where('user_id', auth()->user()->id)->latest()->get();
        return view('user.pages.education.index', compact('education'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'result' => 'required',
            ]);
            $education = new Education();
            $education->institute_name = $request->institute_name;
            $education->institute_name_bn = $request->institute_name_bn;
            $education->degree_name = $request->degree_name;
            $education->degree_name_bn = $request->degree_name_bn;
            $education->result = $request->result;
            $education->passing_year = $request->passing_year;
            $education->user_id = auth()->user()->id;
            $education->save();
            Toastr::success('Education Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'result' => 'required',
            ]);
            $education = Education::find($id);
            $education->institute_name = $request->institute_name;
            $education->institute_name_bn = $request->institute_name_bn;
            $education->degree_name = $request->degree_name;
            $education->degree_name_bn = $request->degree_name_bn;
            $education->result = $request->result;
            $education->passing_year = $request->passing_year;
            $education->save();
            Toastr::success('Education Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $education = Education::find($id);
            $education->delete();
            Toastr::success('Education Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
