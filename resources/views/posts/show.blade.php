@extends('layouts.app')

@section('content')
    <a href="{{ url('/posts') }}" class="btn btn-primary">Back to Posts</a>
    <h1>{{ $post->title }}</h1>
    <img style="width:100%" src="{{ asset('storage/assets/images/' . $post->cover_image) }}">
    <small>Posted on {{ $post->created_at->format('M d, Y') }} by {{ $post->user->name }}</small>
    <hr>
    <div>
        {!! $post->body !!}
    </div>
    <br>
    @if(!Auth::guest() && Auth::user()->id == $post->user_id)
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="First group">
                <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a>
            </div>
            <div class="btn-group" role="group" aria-label="Second group">
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    @endif
    <br><br>
@endsection
