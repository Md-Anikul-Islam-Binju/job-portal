<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class LocationController extends Controller
{
    public function index()
    {
        $location = Location::where('user_id', auth()->user()->id)->latest()->get();
        return view('company.pages.location.index', compact('location'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $location = new Location();
            $location->name = $request->name;
            $location->name_bn = $request->name_bn;
            $location->user_id = auth()->user()->id;
            $location->save();
            Toastr::success('Location Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);
            $location = Location::find($id);
            $location->name = $request->name;
            $location->name_bn = $request->name_bn;
            $location->status = $request->status;
            $location->save();
            Toastr::success('Location Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $location = Location::find($id);
            $location->delete();
            Toastr::success('Location Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
