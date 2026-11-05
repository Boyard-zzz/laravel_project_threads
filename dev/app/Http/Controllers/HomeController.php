<?php

namespace App\Http\Controllers;

use App\Models\Thread;

class HomeController extends Controller
{
    public function index()
    {
        $threads = Thread::latest()->get();

        return view('home', compact('threads'));
    }
}