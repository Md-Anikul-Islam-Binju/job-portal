<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function frontend()
    {
        $category = Category::latest()->get();
        return inertia('Index',compact('category'));
    }
}
