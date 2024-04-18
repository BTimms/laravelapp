<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

// Controls the posts
class PostsController extends Controller
{
    // This middleware ensures that only authenticated users can access the methods in this controller.
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    // Show the application with posts ordered by creation date.
    public function index()
    {
        // Retrieve all posts from the database and order them by creation date in descending order.
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    // Display the form for creating a new post.
    public function create()
    {
        return view('posts.create');
    }

    // Store a newly created post in the database.
    public function store(Request $request)
    {
        // Validate the incoming request data to ensure it meets the required criteria.
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',





            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Create a new post instance and populate its attributes with the request data.
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;

        // Handle the uploaded cover image, if provided.
        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->file('cover_image')->storeAs('public/assets/images', $fileNameToStore);
            $post->cover_image = $fileNameToStore;
        } else {
            $post->cover_image = 'noimage.jpg';
        }

        // Save the post to the database.
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    // Display the specified post.
    public function show(string $id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    // Display the form for editing the specified post.
    public function edit(string $id)
    {
        $post = Post::find($id);
        // Check if the authenticated user is the owner of the post.
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        return view('posts.edit')->with('post', $post);
    }

    // Update the specified post in the database.
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data to ensure it meets the required criteria.
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        // Find the post by its ID and update its attributes with the new data.
        $post = Post::find($id);
        if($request->hasFile('cover_image')) {
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $request->file('cover_image')->storeAs('public/assets/images', $fileNameToStore);
            $post->cover_image = $fileNameToStore;
        }

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    // Remove the specified post from the database.
    public function destroy(string $id)
    {
        // Find the post by its ID.
        $post = Post::find($id);
        // Check if the authenticated user is the owner of the post.
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        // Delete the post's cover image from storage if it exists.
        if($post->cover_image != 'noimage.jpg'){
            Storage::delete('public/assets/images/' . $post->cover_image);
        }
        // Delete the post from the database.
        $post->delete();

        return redirect('/posts')->with('success', 'Post Removed');
    }
}
