<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Education;
use App\Models\Experiences;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Location;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class JobController extends Controller
{
    public function index()
    {
        $location = Location::latest()->get();
        $category = Category::latest()->get();
        $job = Job::where('company_id', auth()->user()->id)->latest()->get();
        return view('company.pages.job.index', compact('location', 'category', 'job'));
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'location_id' => 'required',
            ]);
            $job = new Job();
            $job->category_id = $request->category_id;
            $job->location_id = $request->location_id;
            $job->title = $request->title;
            $job->title_bn = $request->title_bn;
            $job->address = $request->address;
            $job->address_bn = $request->address_bn;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->deadline = $request->deadline;
            $job->details = $request->details;
            $job->details_bn = $request->details_bn;
            $job->company_id = auth()->user()->id;
            $job->save();
            Toastr::success('Job Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'location_id' => 'required',
            ]);
            $job = Job::find($id);
            $job->category_id = $request->category_id;
            $job->location_id = $request->location_id;
            $job->title = $request->title;
            $job->title_bn = $request->title_bn;
            $job->address = $request->address;
            $job->address_bn = $request->address_bn;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->deadline = $request->deadline;
            $job->details = $request->details;
            $job->details_bn = $request->details_bn;
            $job->status = $request->status;
            $job->save();
            Toastr::success('Job Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $job = Job::find($id);
            $job->delete();
            Toastr::success('Job Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function candidate()
    {
        $candidate = JobApplication::where('company_id',auth()->user()->id)->with('user','job')->get();
        return view('company.pages.job.candidate',compact('candidate'));
    }

    public function candidateDestroy($id)
    {
        try {
            $jobApplication = JobApplication::find($id);
            $jobApplication->delete();
            Toastr::success('Job Application Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function candidateDetails($id)
    {
        $candidate = User::where('id',$id)->first();
        $candidateEducation = Education::where('user_id',$id)->get();

        $candidateExperiences = Experiences::where('user_id',$id)->get();

        $candidateSkill = Skill::where('user_id',$id)->get();



        return view('company.pages.job.candidateDetails',compact('candidate','candidateEducation',
        'candidateExperiences','candidateSkill'));
    }

}
