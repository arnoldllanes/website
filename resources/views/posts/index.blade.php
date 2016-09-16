@extends('layouts.main')

@section('content')

	<section id="product">
			<div class="container">
				<div class="row animate-box">
					<div class="col-md-12 section-heading text-center">
						<h2>Blog Posts</h2>
						<div class="row">
							<div class="col-md-6 col-md-offset-3 subtext">
								<p>SDLUG Community Blogs</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					@foreach($posts as $post)
                    <div class="post-entry">
                        <div class="col-md-6">
                            <div class="post animate-box">
                                <a href="/posts/{{ $post->id }}"><img src="images/blogicon.png" alt="Product"></a>
                                <div>
                                    <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>
                                <!-- <p>{{ str_limit($post->body, $limit = 25, $end = '...') }}</p> -->
                                    <p>Posted: <a href="">{{ $post->owner->name }}</a> </p>
                                    <p>Published on: {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</p>
                                    <p>Tags:
                                        @foreach($post->tags->slice(0, 2) as $tag)
                                            {{ $tag->name }}
                                        @endforeach
                                        ...
                                    </p>
                                    <span><a href="/posts/{{ $post->id }}">Read post...</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
				</div>
			</div>
		</section>

@endsection