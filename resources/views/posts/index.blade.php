@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Welcome To SportPost</h1>
    </div>
    <h1>Latest Posts</h1>
    @if(count($posts)> 1)
        @foreach($posts as $post)
            <div class="well">
                <h3><a href="/posts/{{$post->id}}"> {{$post->title}}</a></h3>
                <small>Posted on {{$post->created_at}}</small>
            </div>
        @endforeach
        @else
        <p>No Posts Found</p>
    @endif
@endsection
