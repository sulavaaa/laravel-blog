@extends('layouts.app')

@section('content')
    
    <hr>
    <h1>{{$post->title}}</h1>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written at: {{$post->created_at}}</small>
    <hr>
    <a href="/posts" class="btn btn-success">Back to posts</a>
@endsection