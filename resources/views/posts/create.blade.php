@extends('layouts.app')

@section('content')
    
    <hr>
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store','method'=>'POST']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title of the Post')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('title', '', ['class' => 'form-control', 'placeholder' => 'Add text'])}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection