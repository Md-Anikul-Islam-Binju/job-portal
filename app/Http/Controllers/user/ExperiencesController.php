<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Experiences;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class ExperiencesController extends Controller
{
    public function index()
    {
        $experience = Experiences::where('user_id', auth()->user()->id)->latest()->get();
        return view('user.pages.experience.index', compact('experience'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'designation' => 'required',
            ]);
            $experience = new Experiences();
            $experience->office_name = $request->office_name;
            $experience->office_name_bn = $request->office_name_bn;
            $experience->designation = $request->designation;
            $experience->designation_bn = $request->designation_bn;
            $experience->year_of_experience = $request->year_of_experience;
            $experience->user_id = auth()->user()->id;
            $experience->save();
            Toastr::success('Experiences Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'designation' => 'required',
            ]);
            $experience = Experiences::find($id);
            $experience->office_name = $request->office_name;
            $experience->office_name_bn = $request->office_name_bn;
            $experience->designation = $request->designation;
            $experience->designation_bn = $request->designation_bn;
            $experience->year_of_experience = $request->year_of_experience;
            $experience->save();
            Toastr::success('Experiences Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $experience = Experiences::find($id);
            $experience->delete();
            Toastr::success('Experiences Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
