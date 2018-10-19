@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts))
        @foreach($posts as $post)
            <div class="card bg-light p-3 m-2">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">

                        <h3>
                            <!--<a href="/posts/{{$post->id}}">{{$post->title}}</a>-->
                            <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a>
                        </h3>
                        
                        <!--Normal date format-->
                        <!--<small>Written on {{$post->created_at}}</small>-->
                        
                        <!--Changed date format-->
                        <small>Written on {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}} by {{$post->user->name}}</small>
                    </div>
                </div>
                
            </div>
        
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection

