<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::latest()->get();
        return view('admin.pages.event.index', compact('event'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'details' => 'required',
                'event_date' => 'required',
                'event_time' => 'required',
            ]);

            $event = new Event();
            $event->title = $request->title;
            $event->title_bn = $request->title_bn;
            $event->details = $request->details;
            $event->details_bn = $request->details_bn;
            $event->event_date = $request->event_date;
            $event->event_time = $request->event_time;
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/event'), $file);
                $event->image = $file;
            }
            $event->save();

            Toastr::success('Event Added Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'details' => 'required',
                'event_date' => 'required',
                'event_time' => 'required',

            ]);
            $event = Event::find($id);
            $event->title = $request->title;
            $event->title_bn = $request->title_bn;
            $event->details = $request->details;
            $event->details_bn = $request->details_bn;
            $event->event_date = $request->event_date;
            $event->event_time = $request->event_time;
            $event->status = $request->status;
            if ($request->image) {
                $file = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/event'), $file);
                $event->image = $file;
            }
            $event->save();
            Toastr::success('Event Updated Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $event = Event::find($id);
            $event->delete();
            Toastr::success('Event Deleted Successfully', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
