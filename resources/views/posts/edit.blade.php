@extends('layouts.app')

@section('content')
    <a href="{{ url('/posts') }}" class="btn btn-primary"> <-- Back to Posts</a>
    <h1>Edit Post</h1>
    {!! Form::open(['url' => ['posts',$post->id], 'method' => 'POST','enctype'=>'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title','Title')}}
        {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body','Content')}}
        {{Form::textarea('body',$post->body,['class'=>'form-control','placeholder'=>'Content'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
    <br>
@endsection
