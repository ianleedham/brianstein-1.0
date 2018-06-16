@extends('layouts.app')

@section('content')
    <h1 >Blog</h1>
    <p >
        This blog was the first thing I created using the Laravel framework.
        It demonstrates eloquent through the crud functionality: create, read, update, destroy.
        The boiler plate for the controllable and database migration was generated through the artisan command I just
        had to fill in the specifics.
        The blog also includes file uploading which is made extremely easy via Laravel and validation which checks what
        is being presented is correct.
        It also has access controls via Laravels inbuilt auth middle wear and if statements. This means that you can
        only edit or delete your own posts and are only able to add, edit or delete at all if you are logged in.
    </p>
    <div style="padding: 3rem">
        <h2>Posts</h2>

        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="well">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                        </div>
                    </div>
                </div>
            @endforeach
            {{$posts->links()}}
        @else
            <p>No posts found</p>
        @endif
    </div>
@endsection