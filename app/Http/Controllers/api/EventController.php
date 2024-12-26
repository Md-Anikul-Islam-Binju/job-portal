<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function event()
    {
        $event = Event::latest()->get();
        return response()->json($event);
    }
}
