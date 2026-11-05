<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

       $threads = Thread::latest()->get();

       return view('home', compact('threads'));
       
    }
}
