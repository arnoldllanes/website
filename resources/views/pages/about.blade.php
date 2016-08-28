@extends('layouts.main')
@section('content')

<section id="intro" style="padding-bottom: 0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
                <div class="intro animate-box">
                    <h2 style="margin-bottom: 6px">About Us</h2>
                    <p>We are 210+ Laravel Artisans in San Diego and continue to grow. Artisans of any skill level are welcome! <a target="__Blank" href="http://www.meetup.com/San-Diego-Laravel-Meetup/">Check us out!</a></p>
                </div>
            </div>
        </div>
        <div>
</section>

<div class="row">
	<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
		<div class="intro animate-box">
			<h1>Laravel User Group Organizers</h1>
		</div>
	</div>
</div>

<div class="media animate-box">
    <a class="pull-left" href="">
        <img class="media-object" alt="" src="images/eric.png">
    </a>
    <div class="media-body">
        <h2 class="media-heading"><a href="">Eric Van Johnson</a></h2>
        <p>Open Source Enthusiast, Advocate, and general FOSS Maniac who enjoys web architecture, technology, and solutions. A hacker and developer who fell down the slippery slope of a “Systems Architect” job. Over 15 years of professional experience in the IT industry, including as Systems Architect for an industry-leading Fortune 100 company. Big on Cloud Strategies and Solutions (IaaS, PaaS, and SaaS).</p>

		<p>Has lived in San Diego for over 20 years and became a Co-Organizer of San Diego PHP Group in 2012. Somewhat of a scripting language and framework junkie. Ruby, Rails, Python, Django, Go, and even BASH but with a main strength are around PHP and the CakePHP framework. Also enjoy playing around with Zend Framework, CodeIgniter, Symfony, F3, and FuelPHP.</p>

		<p>A husband and father x2 with an abiding love of Scotch and Baseball.</p>
        <div class="col-md-12">
            <h3 class="text-center animate-box"><strong>Latest Tweet</strong> <small>by</small> <a href="http://www.twitter.com/shocm">@shocm</a></h3>
            <hr>
            @foreach($ericTweets as $tweet)
                <div class="animate-box">
                    <div class="media">
                        <div class="media-left">
                            <img class="img-thumbnail media-object" src="{{ $tweet->user->profile_image_url }}" alt="Avatar">
                        </div>
                        <div class="media-body">
                            <a href="http://www.twitter.com/{{ $tweet->user->screen_name }}"><h4 class="media-heading">{{ $tweet->user->name }}</a>
                              <a href="https://twitter.com/{{ $tweet->user->screen_name }}/status/{{ $tweet->id}}">{{ Carbon\Carbon::parse($tweet->created_at)->diffForHumans() }}</a></h4>
                            <p>{{ $tweet->text }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
		<div class="col-xs-12 col-sm-4 col-md-12">
	        <div class="nav navbar-nav">
	            <a class="btn btn-social-icon btn-github" target="__Blank" href="https://github.com/ericvanjohnson"><i class="fa fa-github" aria-hidden="true"></i></a>
	            <a class="btn btn-social-icon btn-linkedin" target="__Blank" href="https://www.linkedin.com/in/vanjohnson"><i class="fa fa-linkedin"></i></a>
	            <a class="btn btn-social-icon" target="__Blank" href="http://www.shocm.com/"><i class="fa fa-user" aria-hidden="true"></i></a>
	            <a class="btn btn-social-icon btn-twitter" target="__Blank" href="https://twitter.com/shocm"><i class="fa fa-twitter"></i></a>
	            <a class="btn btn-social-icon" target="__Blank" href="mailto:eric@sdphp.org"><i class="fa fa-envelope-o"></i></a>
	        </div>
	    </div>
    </div>
</div>

<hr class="animate-box">

<div class="media animate-box">
    <a class="pull-left" href="">
        <img class="media-object" alt="" src="images/john.png">
    </a>
    <div class="media-body">
        <h2 class="media-heading"><a href="">John Congdon</a></h2>
        <p>I am a mostly self taught programmer with a BS in Aviation Computer Science from Embry-Riddle Aeronautical University.  I started coding at 10 years old in BASIC, and I grew from there. PASCAL was my language of choice before college, then PERL until 2003, and mainly PHP after that. While PHP is my main weapon of choice, any language can and will be yielded when necessary. </p>

		<p>PHP UserGroups and conferences have had a very important role in my development.  I looked for a PHP Group when I learned I was moving, but there was not one running any longer. So I listened to the great Cal Evans, “if you look around for a user group, and there isn’t one, then you’re the new organizer”. And so I started it up after moving from Daytona Beach, FL to San Diego, CA.</p>
		<div class="col-xs-12 col-sm-4 col-md-12">
	        <div class="nav navbar-nav">
	            <a class="btn btn-social-icon btn-github" target="__Blank" href="https://github.com/johncongdon"><i class="fa fa-github" aria-hidden="true"></i></a>
	            <a class="btn btn-social-icon btn-linkedin" target="__Blank" href="https://www.linkedin.com/in/johncongdon"><i class="fa fa-linkedin"></i></a>
	            <a class="btn btn-social-icon" target="__Blank" href="http://www.johncongdon.com/"><i class="fa fa-user" aria-hidden="true"></i></a>
	            <a class="btn btn-social-icon btn-twitter" target="__Blank" href="https://twitter.com/johncongdon"><i class="fa fa-twitter"></i></a>
	            <a class="btn btn-social-icon" target="__Blank" href="mailto:john@sdphp.org"><i class="fa fa-envelope-o"></i></a>
	        </div>
	    </div>
    </div>
</div>

<hr class="animate-box">

<div class="media animate-box">
    <a class="pull-left" href="">
        <img class="media-object" alt="" src="images/avatar.png">
    </a>
    <div class="media-body">
        <h2 class="media-heading"><a href="">Thomas Rideout</a></h2>
        <p></p>
		<div class="col-xs-12 col-sm-4 col-md-12">
	        <div class="nav navbar-nav">
	            <a class="btn btn-social-icon btn-linkedin" target="__Blank" href="https://www.linkedin.com/in/therideout"><i class="fa fa-linkedin"></i></a>
	        </div>
	    </div>
    </div>
</div>
@endsection
