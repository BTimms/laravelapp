<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Controls the pages
class PagesController extends Controller
{
    // Show the application index page.
    public function index(){
        $title = 'Welcome To SportPort';
        //return view('pages.index', compact('title'));
        return view('pages.index') -> with('title', $title);
    }
}

