@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Welcome To SportPost</h1>
    </div>
    <h1>Latest Posts</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="{{ asset('storage/assets/images/' . $post->cover_image) }}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{ $post->title }}</a></h3>
                        <small>Posted on {{ $post->created_at->format('M d, Y') }} by {{ $post->user->name }}</small>
                        <br>
                        <br>
                        <!-- Display post body here -->
                        {!!$post->body!!}
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No Posts Found</p>
    @endif
@endsection
