<?php

namespace App\Http\Controllers;

use App\Models\FreeMessage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contact()
    {
        $siteSetting = SiteSetting::latest()->first();
        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'name_bn' => Auth::user()->name_bn,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;
        return inertia('Contact',compact('siteSetting','auth'));
    }


    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:500',
        ]);

        // Store the data in the FreeMessage model
        FreeMessage::create($validatedData);

        // Optionally, send a response back
        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
