@extends('layouts.main')

@section('content')
    <section id="product">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-12 section-heading text-center">
                    <h2>Blog Archive</h2>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 subtext">
                            <p>Check out the collection of blogs and/or presentations done at the San Diego Laravel Meet
                                Up. Enjoy!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($presentations as $presentation)
                    <div class="post-entry">
                        <div class="col-md-6">
                            <div class="post animate-box">
                                <a href="/presentations/{{ $presentation->id }}"><img src="images/blogicon.png" alt="Product"></a>
                                <div>
                                    <h3><a href="/presentations/{{ $presentation->id }}">{{ $presentation->title }}</a></h3>
                                <!-- <p>{{ str_limit($presentation->body, $limit = 25, $end = '...') }}</p> -->
                                    <p>Presented by: 
                                        <a href="/presenter/{{ $presentation->presenter->id }}">{{ $presentation->presenter->name }}</a>
                                    </p>
                                    <p>Published on: {{ Carbon\Carbon::parse($presentation->created_at)->diffForHumans() }}</p>
                                    <p>Tags:
                                        @foreach($presentation->tags->slice(0, 2) as $tag)
                                            {{ $tag->name }}
                                        @endforeach
                                        ...
                                    </p>
                                    <span><a href="/presentations/{{ $presentation->id }}">Read presentation...</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection