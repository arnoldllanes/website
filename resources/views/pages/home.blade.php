
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>San Diego Laravel Meet Up Group</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!-- 
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE 
	DESIGNED & DEVELOPED by FREEHTML5.CO
		
	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700|Roboto:300,400' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<link rel="stylesheet" href="css/style.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style>
		#meetup-component {
			padding-top: 75px;
		}
		#meetup-component img {
			padding-bottom: 35px;
		}
		#meetup-component ul {
			list-style-type: none;
			padding-right: 40px;
		}
		.meetup-title-display {
			font-size: 28px;
			line-height: 1.25;
		}
		.meetup-list-display li {
			font-size: 20px;
			letter-spacing: -.02em;
		}
		
		a {
			text-decoration: none !important;
			color:black;
		}
		a:hover{
			text-decoration: none;
		}
		a:visited{
			text-decoration: none;
		}

	</style>
	</head>
	<body>
	<div class="box-wrap">
		<header role="banner" id="fh5co-header">
			<div class="container">
				@include('layouts.navigation')	
		 	</div>
		</header>
		<!-- END: header -->
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
						<a target="__Blank" href="http://www.meetup.com/San-Diego-Laravel-Meetup/"><h2 class="text-center animate-box"><img src="images/meetupicon.png">Join our meet up!</h2></a>
						<div class="fh5co-grid animate-box" style="background-image: url(images/meetup.jpeg);">
							<meetup></meetup>
						</div>
					</div>
					<div class="col-md-6">
						<h2 class="text-center animate-box">Our latest blog post</h2>
						<div class="fh5co-grid animate-box" style="background-image: url(images/work-2.jpg);">
							<div class="image-popup text-center">
								<div class="post animate-box">
								<a href="#"><img src="images/blogicon.png" alt="Product"></a>
								<div>
									<h3><a href="#">Camera Lenses</a></h3>
									<p>Far far away, behind the word, far from the countries Vokalia</p>
									<span><a href="#">Learn More...</a></span>
								</div>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<h2 class="text-center animate-box">Our Sponsors</h2>
						<div class="fh5co-grid animate-box" style="background-image: url(images/diegodev.png); height:239px">
							<a class="image-popup text-center" target="__Blank" href="https://www.diegodev.com/">
								<div class="work-title">
									<h3>DiegoDev Group, LLC</h3>
									<span>A passionate development group dedicated to building secure, standards compliant, and maintainable solutions for our customers. From code to operations.</span>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-12">
						<div class="fh5co-grid animate-box" style="background-image: url(images/carinet.png); height: 239px">
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

		<!-- <section id="services">
			<div class="container">
				<div class="row">
					<div class="col-md-4 animate-box">
						<div class="service">
							<div class="service-icon">
								<i class="icon-command"></i>
							</div>
							<h2>Brand Identity</h2>	
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
						</div>
					</div>
					<div class="col-md-4 animate-box">
						<div class="service">
							<div class="service-icon">
								<i class="icon-drop2"></i>
							</div>
							<h2>Web Design &amp; UI</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
						</div>
					</div>
					<div class="col-md-4 animate-box">
						<div class="service">
							<div class="service-icon">
								<i class="icon-anchor"></i>
							</div>
							<h2>Development &amp; CMS</h2>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
						</div>
					</div>
				</div>
			</div>
		</section> -->

		<footer id="footer" role="contentinfo">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center ">
						<div class="footer-widget border">
							<p class="pull-left"><small>&copy; Closest Free HTML5. All Rights Reserved.</small></p>
							<p class="pull-right"><small> Designed by  <a href="http://freehtml5.co/" ta>freehtml5.co</a>  Images: <a href="https://unsplash.com/">Unsplash</a></small></p>
							
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<!-- END: box-wrap -->
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Main JS (Do not remove) -->
	<script src="js/main.js"></script>
	<!-- App.js -->
	<script src="js/app.js"></script>
	</body>
</html>


