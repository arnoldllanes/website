<header role="banner" id="fh5co-header">
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="row">
                <div class="col-md-3">
                    <div class="fh5co-navbar-brand">
                        @if(!Auth::guest())
                            <a class="fh5co-logo" href="/home">
                                <img src="/images/logo.png" style="background-color:black" alt="SDLUG Logo">
                            </a>
                        @else
                            <a class="fh5co-logo" href="/">
                                <img src="/images/logo.png" style="background-color:black" alt="SDLUG Logo">
                            </a>
                        @endif

                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="nav text-center">
                        <li class="{{ Menu::activeMenu('/') }}">
                            <a href="/">Home</a>
                        </li>
                        <li class="{{ Menu::activeMenu('about') }}">
                        <a href="/about">About Us</a></li>
                        <li class="{{ Menu::activeMenu('presentations') }}">
                            <a href="/presentations">Presentations</a>
                        </li>
                        <li class="{{ Menu::activeMenu('postss') }}">
                            <a href="/posts">Blogs</a>
                        </li>
                        <li>
                        <a target="__Blank" href="https://trello.com/b/H7RSRe8m/public-laravel-sdug-board">Trello Board</a>
                        </li>
                        <li>
                            <a target="__Blank" href="http://www.sdphp.org/">SDPHP</a></li>
                        <li class="{{ Menu::activeMenu('resources') }}">
                            <a href="/resources">Resources</a>
                        </li>
                        <li>
                            <a href="">Search SDLUG</a>
                        </li>
                        
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