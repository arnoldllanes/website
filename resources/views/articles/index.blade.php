@extends('layouts.main')

@section('content')
	<section id="product">
			<div class="container">
				<div class="row animate-box">
					<div class="col-md-12 section-heading text-center">
						<h2>Blog Archive</h2>
						<div class="row">
							<div class="col-md-6 col-md-offset-3 subtext">
								<p>Check out the collection of blogs and/or presentations done at the San Diego Laravel Meet Up. Enjoy!</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="post-entry">
					@foreach($articles as $article)
						<div class="col-md-6">
							<div class="post animate-box">
								<a href="#"><img src="images/blogicon.png" alt="Product"></a>
								<div>
									<h3><a href="#">{{ $article->title }}</a></h3>
									<p>{{ str_limit($article->body, $limit = 25, $end = '...') }}</p>
									<p>Presented by: {{ $article->user->name }}</p>
									<p>Published on: {{ $article->published_at }}</p>
									<p>Tags: 
										@foreach($article->tags as $tag)
											{{ $tag->name }}
										@endforeach
									</p>
									<span><a href="/articles/{{ $article->id }}">Learn More...</a></span>
								</div>
							</div>
						</div>
					@endforeach
					</div>
				</div>
			</div>
		</section>

@endsection