@extends('layouts.app')

@section('content')
    <a href="{{ url('posts') }}" class="btn btn-primary"><-- Back to Posts</a>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>{{ __('Dashboard') }}</h1></div>
                    <div class="card-body">
                        <h3>Your Blog Posts</h3>
                        @if(count($posts) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th>Details</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            <small>Posted on {{ $post->created_at->format('M d, Y') }} by {{ $post->user->name }}</small>
                                            <br>
                                            <span>{{ Str::limit($post->body, 100) }}</span>
                                        </td>
                                        <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                        <td>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have no posts</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
