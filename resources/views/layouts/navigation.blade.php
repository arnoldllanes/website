<header role="banner" id="fh5co-header">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="row">
                <div class="col-md-3">
                    <div class="fh5co-navbar-brand">
                        @if(!Auth::guest())
                            <a class="fh5co-logo" href="/home">
                                <img src="/images/logo.png" style="background-color:black" alt="Closest Logo">
                            </a>
                        @else
                            <a class="fh5co-logo" href="/">
                                <img src="/images/logo.png" style="background-color:black" alt="Closest Logo">
                            </a>
                        @endif

                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="nav text-center">
                        <li><a href="/"><span>Home</span></a></li>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/articles">Blog</a></li>
                        <li><a target="__Blank" href="https://trello.com/b/H7RSRe8m/public-laravel-sdug-board">Trello
                                Board</a></li>
                        <li><a target="__Blank" href="http://www.sdphp.org/">SDPHP</a></li>
                        <li><a href="contact.html">Resources</a></li>
                        @if(!Auth::guest())
                            <li><a href="/home">>To Dashboard<</a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="social">
                        <li><a href="https://twitter.com/sandiegolaravel"><i class="icon-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>