<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs.index');
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }
}
