<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * This middleware ensures that only authenticated users can access the methods in this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard with posts ordered by creation date.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        // Fetch posts with the latest post first
        $posts = $user->posts()->orderBy('created_at', 'desc')->get(); // Ensuring posts are ordered by date

        return view('dashboard')->with('posts', $posts);
    }
}
