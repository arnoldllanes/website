<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>San Diego Laravel Meet Up Group</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="San Diego Laravel MeetUp"/>
    <meta name="keywords"
          content="Laravel, San Diego Laravel, San Diego Laravel Meet Up, San Diego Laravel Meet Up Group, Laravel Meet Up Group"/>
    <meta name="author" content="sdlug"/>


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
    <meta name="twitter:title" content=""/>
    <meta name="twitter:image" content=""/>
    <meta name="twitter:url" content=""/>
    <meta name="twitter:card" content=""/>
    <meta id="_token" content="{{ csrf_token() }}">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700|Roboto:300,400' rel='stylesheet'
          type='text/css'>

    <!-- Animate.css -->
    <link rel="stylesheet" href="/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="/css/bootstrap.css">

    <link rel="stylesheet" href="/css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>


    <!-- Modernizr JS -->
    <script src="/js/modernizr-2.6.2.min.js"></script>
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
            color: black;
        }

        a:hover {
            text-decoration: none;
        }

        a:visited {
            text-decoration: none;
        }

    </style>
</head>
<body>
<div class="box-wrap">
    @include('layouts.navigation')
    @include('partials.flash')

    @yield('content')

    <footer id="footer" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center ">
                    <div class="footer-widget border">
                        <p class="pull-left">
                            <small>&copy; Sdlug <?php echo date('Y'); ?></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- END: box-wrap -->

<!-- jQuery -->
<script src="/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="/js/jquery.easing.1.3.js"></script>
<!-- Waypoints -->
<script src="/js/jquery.waypoints.min.js"></script>
<!-- Main JS (Do not remove) -->
<script src="/js/main.js"></script>
<!-- App.js -->
<script src="/js/app.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script>
    $('#tag_list').select2({
        placeholder: 'Choose a tag',
        tags: true,
        multiple: true,
        tokenSeparators: [',']
    });
</script>

</body>

</html>


