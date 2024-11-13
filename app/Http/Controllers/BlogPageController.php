<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPageController extends Controller
{
    public function blog(Request $request)
    {
        $siteSetting = SiteSetting::latest()->first();

        // Paginate the blogs with search functionality
        $blogs = Blog::when($request->search, function ($query, $search) {
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
        return inertia('Blog', compact('siteSetting', 'blogs','auth'));
    }

    public function blogDetails($id)
    {
        $siteSetting = SiteSetting::latest()->first();
        $blogs = Blog::where('id',$id)->first();
        $auth = Auth::user() ? [
            'name' => Auth::user()->name,
            'name_bn' => Auth::user()->name_bn,
            'email' => Auth::user()->email,
            'role' => Auth::user()->role,
        ] : null;
        return inertia('BlogDetails', compact('siteSetting', 'blogs','auth'));
    }
}
