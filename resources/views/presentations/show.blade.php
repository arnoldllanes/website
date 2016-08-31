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
            @if(!Auth::guest())
                <a style="display:inline-block" href="/presentations/{{ $presentation->id }}/edit"><p> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit presentation</p></a>

                <form action="{{ action('PresentationController@destroy', ['presentation' => $presentation->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-default">Delete Presentation</button>
                </form>

            @endif
                <h2 class="text-center">{{ $presentation->title }}</h2>
                <hr>

                <p>{{ $presentation->body }}</p>

                <hr>

                <p>Published By: {{ $presentation->publisher->name }}</p>

                @if($presentation->edited_by)
                    <p>Edited By: {{ $presentation->edited_by }}</p>
                @endif

                @if($presentation->edited_date)
                    <p>Edited Date: {{ $presentation->edited_date }}</p>
                @endif
            </div>
            <!-- <div class="col-md-4"></div> -->
        </div>
    </main>
@endsection