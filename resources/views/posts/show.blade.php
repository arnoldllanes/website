@extends('layouts.main')

@section('content')
  <section id="intro" style="padding-bottom: 0">
        <div class="container">
            <div class="row" style="padding-top:50px">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
                    <div class="intro animate-box">

                        <h2>Presented By: <a href="/presenters/{{ $post->owner->id }}">{{ $post->owner->name }}</a> <small><em>Posted: {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</em></small></h2>
                   
                        
                    </div>
                    <p class="animate-box" style="display:inline-block">
                    @if($post->tags->count() !== 0)
                        Tags:
                    @endif
                    @foreach($post->tags as $tag)
                        <li class="animate-box" style="display: inline-block"><a href="/tags/{{ $tag->id }}">{{ $tag->name }}</a></li>
                    @endforeach
                    </p>
                </div>
            </div>
        <div>
    </section>

    <main id="main">
        <div class="container">
            <div class="col-md-8 col-md-offset-2 animate-box">

                @if(Auth::user() !== null && Auth::user()->isAdmin() && $post->approved == false)
                <form action="{{ action('PostController@approve', ['post' => $post->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>

                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#rejectPost">Reject Post</a>
                        
            @endif
            

            @if(Auth::user() !== null && Auth::user()->isAdmin() || Auth::user() !== null && Auth::user()->isMember())
                <a style="display:inline-block" href="/posts/{{ $post->id }}/edit"><p> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit post</p></a>

                <form action="{{ action('PostController@destroy', ['post' => $post->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-default">Delete Post</button>
                </form>
            @endif

                <h2 class="text-center">{{ $post->title }}</h2>
                <hr>

                <p style="word-wrap: break-word;">{{ $post->body }}</p>

                <hr>

                <p>Posted By: {{ $post->owner->name }}</p>

                @if($post->edited_date)
                    <p>Edited: {{ Carbon\Carbon::parse($post->edited_date)->diffForHumans() }}</p>
                @endif
            </div>
            <!-- <div class="col-md-4"></div> -->
            @include('partials.modals.reject-post')
        </div>
    </main>


@endsection