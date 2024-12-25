<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventManageController extends Controller
{
    public function event(Request $request)
    {
        $siteSetting = SiteSetting::latest()->first();

        // Paginate the trainings with search functionality
        $events = Event::when($request->search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->get();

        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'name_bn' => Auth::user()->name_bn,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;

        return inertia('Event', compact('siteSetting', 'events', 'auth'));
    }

    public function eventDetails($id)
    {
        $siteSetting = SiteSetting::latest()->first();
        $event = Event::where('id',$id)->first();
        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'name_bn' => Auth::user()->name_bn,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;
        return inertia('EventDetails', compact('siteSetting', 'event','auth'));
    }
}
