@extends('layouts.app')

@section('content')
    <a href="{{ url('posts') }}" class="btn btn-primary"><-- Back to Posts</a>
    <h1>Create Post</h1>
    {!! Form::open(['url' => 'posts', 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
    {{Form::label('body','Content')}}
    {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Content'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}
    <br>
@endsection
