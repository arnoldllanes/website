@extends('layouts.main')
@section('content')
    <section id="intro" style="padding-bottom: 0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
                    <div class="intro animate-box">
                        <h2 style="margin-bottom: 6px">San Diego Laravel User Group</h2>
                        <p>Welcome fellow artisans!</p>
                    </div>
                </div>
            </div>
            <div>
    </section>

    <section id="work">
        <div class="container">
            <div class="row" style="height: 239">
                <div class="col-md-6">
                    <a target="__Blank" href="http://www.meetup.com/San-Diego-Laravel-Meetup/">
                        <h2 class="text-center animate-box"><img src="images/meetupicon.png">Join our meet up!</h2>
                    </a>
                    <div class="fh5co-grid animate-box" style="background-image: url(images/meetup.jpeg);">
                        <meetup></meetup>
                    </div>
                </div>

                <div class="col-md-6">
                    <h2 class="text-center animate-box">Latest Blog Post</h2>
                    <div class="fh5co-grid animate-box" style="background-image: url(images/blogpic.png);">
                        <div class="image-popup text-center">
                            <div class="post animate-box">
                                <img src="images/blogicon.png" alt="Product">
                                @if($latest_article)
                                <div>
                                    <h3><a href="/articles/{{ $latest_article->id }}">{{ $latest_article->title }}</a>
                                    </h3>
                                <!-- <p>{{ str_limit($latest_article->body, $limit = 25, $end = '...') }}</p> -->
                                    <p>Presented by: {{ $latest_article->presenter->name }}</p>
                                    <span><a href="/articles/{{ $latest_article->id }}">Read Article...</a></span>
                                </div>
                                <hr>
                                <a type="button" class="btn btn-primary" href="/articles">View Blog Archive</a>
                                @else
                                <div class="work-title">
                                    <h3>Sorry!!!</h3>
                                    <p>No blog posts at this time.</p>
                                    @if(!Auth::guest())
                                        <a type="button" class="btn btn-primary" href="/articles/create">Create Blog Post</a>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start Twitter feed-->

                <div class="col-md-12">
                     <h2 class="text-center animate-box"><strong>Tweets</strong> <small>by</small> <a href="http://www.twitter.com/sandiegolaravel">@sandiegolaravel</a></h2>
                     <hr>
                    @include('tweets.list')    
                </div>

               
                <!-- End Twitter feed-->
                <div class="col-md-12">
                    <h2 class="text-center animate-box">Our Sponsors</h2>
                    <div class="fh5co-grid animate-box"
                         style="background-image: url(images/diegodev.png); height:239px">
                        <a class="image-popup text-center" target="__Blank" href="https://www.diegodev.com/">
                            <div class="work-title">
                                <h3>DiegoDev Group, LLC</h3>
                                <span>A passionate development group dedicated to building secure, standards compliant, and maintainable solutions for our customers. From code to operations.</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="fh5co-grid animate-box"
                         style="background-image: url(images/carinet.png); height: 239px">
                        <a class="image-popup text-center" target="__Blank" href="https://www.cari.net/">
                            <div class="work-title">
                                <h3>CARI.net</h3>
                                <span>San Diego-based CARI.net owns and operates multiple data centers with critical system infrastructure that assures customers of continual uptime.</span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- <div class="col-md-4">
                    <div class="fh5co-grid animate-box" style="background-image: url(images/work-4.jpg);">
                        <a class="image-popup text-center" href="#">
                            <div class="work-title">
                                <h3>Don’t Just Stand There</h3>
                                <span>Illustration, Print</span>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="fh5co-grid animate-box" style="background-image: url(images/work-3.jpg);">
                        <a class="image-popup text-center" href="#">
                            <div class="work-title">
                                <h3>Ampersand</h3>
                                <span>Illustration, Print</span>
                            </div>
                        </a>
                    </div>
                </div> -->

            </div>
            <div>
    </section>

@endsection

