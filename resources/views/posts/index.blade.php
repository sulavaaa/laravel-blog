@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts))
        @foreach($posts as $post)
            <div class="card bg-light p-3 m-2">
                <h3>
                    <!--<a href="/posts/{{$post->id}}">{{$post->title}}</a>-->
                    <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
                </h3>
                
                <!--Normal date format-->
                <!--<small>Written on {{$post->created_at}}</small>-->
                
                <!--Changed date format-->
                <small>Written on {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}} by {{$post->user->name}}</small>
                
            </div>
        
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection

