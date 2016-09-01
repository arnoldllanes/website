@extends('layouts.main')

@section('content')
    <section id="product">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-12 section-heading text-center">
                    <h2>Tag List</h2>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 subtext">
                            <p>Check out our collection of presentations through this tag list. Enjoy!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="post-entry">
                    <div class="col-md-6">
                        <div class="post animate-box">
                            <ol>
                                @foreach($tags as $tag)
                                    <li><a href="/tags/{{ $tag->id }}">{{ $tag->name }}</a> ({{ $tag->presentationCount() }})</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection