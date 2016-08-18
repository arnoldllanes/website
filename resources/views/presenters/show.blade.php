@extends('layouts.main')

@section('content')
    <section id="product">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-12 section-heading text-center">
                    <h2>{{ $presenter->name }}
                        <h2>
                            @if($presenter->email)
                                <p style="display: inline-block"><strong>Email:</strong> {{ $presenter->email }}</p>
                            @endif
                            @if($presenter->website)
                                <p style="display: inline-block"><strong>Website:</strong> <a target="__Blank"
                                                                                              href="http://{{ $presenter->website }}">{{ $presenter->website }}</a>
                                </p>
                            @endif
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 subtext">
                                    <p>List of all articles associated with "{{ $presenter->name }}". Enjoy!</p>
                                </div>
                            </div>
                </div>
            </div>
            <div class="row">
                @foreach($presenter->myArticles as $article)
                    <div class="post-entry">
                        <div class="col-md-6">
                            <div class="post animate-box">
                                <a href="/articles/{{ $article->id }}"><img src="/images/blogicon.png"
                                                                            alt="Product"></a>
                                <div>
                                    <h3>
                                        <a href="/articles/{{ $article->id }}">{{ str_limit($article->title, $limit = 25, $end = '...') }}</a>
                                    </h3>
                                    <p>{{ str_limit($article->body, $limit = 25, $end = '...') }}</p>
                                    <p>Presented by: {{ $article->publisher->name }}</p>
                                    <p>Published on: {{ $article->published_at }}</p>
                                    <p>Tags:
                                        @foreach($article->tags->slice(0, 2) as $tag)
                                            {{ $tag->name }}
                                        @endforeach
                                        ...
                                    </p>
                                    <span><a href="/articles/{{ $article->id }}">Read Article...</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection