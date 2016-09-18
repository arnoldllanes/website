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

    <!-- Comment form section-->
    @if(!Auth::guest())
        <div class="row animate-box">
            <h2 class="text-center">Post a comment</h2>

            <div class="col-md-1 col-md-push-1">
                <img src="{{ Auth::user()->getAvatarUrl() }}">
            </div>

            <div class="col-md-8 col-md-push-1">
                <form action="{{ action('CommentController@postComment', ['id' => $post->id, 'type' => 'blog']) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea placeholder="Comment on {{ $post->title }}" name="comment" class="form-control" rows="2"></textarea>
                        @if ($errors->has('comment'))
                            <span class="help-block">{{ $errors->first('comment') }}</span>
                        @endif              
                    </div>
                    <button type="submit" class="btn btn-default">Post comment</button>
                </form>
                <hr>
            </div>
        </div>
    @endif
<!-- End comment section -->
<div class="row animate-box">
    <h2 class="text-center">Comments</h2>
    <div class="col-lg-12">
        @if (!$post->comments)
            <p>There are currently no comments.</p>
        @else
            @foreach($comments as $comment)
                <div class="media">
                    <a class="pull-left">
                        <img class="media-object" alt="" src="{{ $comment->user->getAvatarUrl() }}">
                    </a>
                    <div class="media-body">
                        <h4 style="display:inline-block" class="media-heading">{{ $comment->user->name }}</h4>
                        <span style="display:inline-block; margin-left: 85%"><i class="fa fa-flag" aria-hidden="true"></i></span>
                        <p>{{ $comment->body }}</p>
                        <ul class="list-inline">
                            <li>{{ $comment->created_at->diffForHumans() }}</li>
                            
                            @if (Auth::user() !== null && $comment->user->id !== Auth::user()->id)
                                <li><a href="{{ action('CommentController@like', ['commentId' => $comment->id]) }}">Like</a></li>
                            @endif
                            <li>{{ $comment->likes->count() }} {{ str_plural('like', $comment->likes->count()) }}</li>
                        </ul>
                        
                        @foreach ($comment->replies as $reply)
                            <div class="media">
                                <a class="pull-left">
                                    <img class="media-object" src="{{ $reply->user->getAvatarUrl() }}">
                                </a>
                                <div class="media-body">
                                    <h4 style="display:inline-block" class="media-heading">{{ $reply->user->name  }}</h4>
                                        <span style="display:inline-block; margin-left: 84%"><i class="fa fa-flag" aria-hidden="true"></i></span>
                                    <p>{{ $reply->body }}</p>
                                    <ul class="list-inline">
                                        <li>{{ $reply->created_at->diffForHumans() }}</li>
                                        @if (Auth::user() !== null && $reply->user->id !== Auth::user()->id)
                                        <li><a href="{{ action('CommentController@like', ['commentId' => $reply->id]) }}">Like</a></li>
                                        @endif
                                        <li>{{ $reply->likes->count() }} {{ str_plural('like', $reply->likes->count()) }}</li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach                   
                        <form action="{{ action('CommentController@postReply', ['id' => $post->id, 'commentId' => $comment->id, 'type' => 'blog']) }}" method="post">
                            <div class="form-group{{ $errors->has("reply-{$comment->id}") ? ' has-error' : '' }}">
                                <textarea name="reply-{{ $comment->id }}" class="form-control" rows="2" placeholder="Reply to this comment"></textarea>
                                @if ($errors->has("reply-{$comment->id}"))
                                    <span class="help-block">{{ $errors->first("reply-{$comment->id}") }}</span>
                                @endif
                            </div>
                                @if(Auth::guest())
                                    <button>Sign in</button>
                                @else
                                    <input type="submit" value="Reply" class="btn btn-default btn-sm">
                                @endif
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </form>
                    </div>
                </div>
                <!--FOR PAGINATION-->
            @endforeach

        @endif
    </div>
</div>


@endsection