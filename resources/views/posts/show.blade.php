@extends('layouts.app')

@section('content') 
    <div class="float-right">
        <a href="/posts" class="btn btn-success">Back to posts</a>
    </div>
    <h1>{{$post->title}}</h1>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written at: {{$post->created_at}}</small>
    <hr>
    <a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a>

    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right','onsubmit' => 'return confirmDelete()'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
@endsection
<script> function confirmDelete() { var result = confirm('Are you sure you want to delete?'); if (result) { return true; } else { return false; } } </script>﻿