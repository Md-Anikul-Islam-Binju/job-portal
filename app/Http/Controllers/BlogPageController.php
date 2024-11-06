<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

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
        return inertia('Blog', compact('siteSetting', 'blogs'));
    }
}
