@extends('layouts.main')

@section('content')
	<section id="product">
			<div class="container">
				<div class="row animate-box">
					<div class="col-md-12 section-heading text-center">
						<h2>List of presenters for the San Diego Laravel meet ups</h2>
						<div class="row">
							<div class="col-md-6 col-md-offset-3 subtext">
								<p>Check out the cool stuff that our members have shared with us in our meet ups. Enjoy!</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="post-entry">
						<div class="col-md-6">
							<div class="post animate-box">
								<ol>
									@foreach($presenters as $presenter)
										<li><a href="/presenters/{{ $presenter->id }}">{{ $presenter->name }} ({{ $presenter->articleCount() }})</a></li>
									@endforeach
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection