<?php

namespace App\Http\Controllers;

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
}
