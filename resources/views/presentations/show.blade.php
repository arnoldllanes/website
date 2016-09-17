@extends('layouts.main')

@section('content')
    <section id="intro" style="padding-bottom: 0">
        <div class="container">
            <div class="row" style="padding-top:50px">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
                    <div class="intro animate-box">

                        <h2>Presented By: <a href="/presenters/{{ $presentation->presenter->id }}">{{ $presentation->presenter->name }}</a> <small><em>Posted: {{ Carbon\Carbon::parse($presentation->created_at)->diffForHumans() }}</em></small></h2>
                   
                            @if($presentation->presenter->email)
                                <p><strong>Email: </strong>{{ $presentation->presenter->email }}</p>
                            @endif
                            @if($presentation->presenter->website)
                                <p><strong>Website: </strong><a href="http://{{ $presentation->presenter->website }}">{{ $presentation->presenter->website }}</a></p>
                            @endif
                        
                    </div>
                    <p class="animate-box" style="display:inline-block">
                    @if($presentation->tags->count() !== 0)
                        Tags:
                    @endif
                    @foreach($presentation->tags as $tag)
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

            @if(Auth::user() !== null && Auth::user()->isAdmin() && $presentation->approved == false)
                <form action="{{ action('PresentationController@approve', ['presentation' => $presentation->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>

                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#rejectPresentation">Reject Post</a>
                        
            @endif
            

            @if(Auth::user() !== null && Auth::user()->isAdmin() || Auth::user() !== null && Auth::user()->isMember())
                <a style="display:inline-block" href="/presentations/{{ $presentation->id }}/edit"><p> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit presentation</p></a>

                <form action="{{ action('PresentationController@destroy', ['presentation' => $presentation->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-default">Delete Presentation</button>
                </form>
            @endif

                <h2 class="text-center">{{ $presentation->title }}</h2>
                <hr>

            @if($presentation->video_embed)
                <div class="text-center">
                    {!! $presentation->video_embed !!}    
                </div>
            @endif

                <p style="word-wrap: break-word;">{{ $presentation->body }}</p>

                <hr>

                <p>Published By: {{ $presentation->publisher->name }}</p>

                @if($presentation->edited_by)
                    <p>Edited By: {{ $presentation->edited_by }}</p>
                @endif

                @if($presentation->edited_date)
                    <p>Edited: {{ Carbon\Carbon::parse($presentation->edited_date)->diffForHumans() }}</p>
                @endif
            </div>
            <!-- <div class="col-md-4"></div> -->
            @include('partials.modals.reject-presentation')
        </div>
    </main>

<!-- Comment form ection-->
    @if(!Auth::guest())
        <div class="row animate-box">
            <h2 class="text-center">Post a comment</h2>

            <div class="col-md-1 col-md-push-1">
                <img src="{{ Auth::user()->getAvatarUrl() }}">
            </div>

            <div class="col-md-8 col-md-push-1">
                <form action="{{ action('CommentController@postComment', ['postId' => $presentation->id, 'type' => 'presentation']) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea placeholder="Comment on {{ $presentation->title }}" name="comment" class="form-control" rows="2"></textarea>
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
        @if (!$presentation->comments)
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
                        <form action="{{ action('CommentController@postReply', ['presentationId' => $presentation->id, 'commentId' => $comment->id]) }}" method="post">
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