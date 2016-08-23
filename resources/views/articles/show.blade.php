@extends('layouts.main')
@section('content')
    <section id="intro">
        <div class="container">
            <div class="row" style="padding-top:50px">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 text-center">
                    <div class="intro animate-box">
                        <h1>{{ $article->title }}</h1>
                        <h2>Presented By: <a
                                    href="/presenters/{{ $article->presenter->id }}">{{ $article->presenter->name }}</a>
                        </h2>
                    </div>
                    <p class="animate-box" style="display:inline-block">
                        Tags:
                    @foreach($article->tags as $tag)
                        <li class="animate-box" style="display: inline-block"><a
                                    href="/tags/{{ $tag->id }}">{{ $tag->name }}</a></li>
                        @endforeach
                        </p>
                </div>
            </div>
            <div>
    </section>

    <main id="main">
        <div class="container">

            <div class="col-md-8 col-md-offset-2 animate-box">
            @if(!Auth::guest())
                <p>Edit article</p>
            @endif
                <h2>History</h2>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet
                    nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula
                    sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam
                    mollis. Ut justo. Suspendisse potenti.</p>

                <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue.
                    Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent
                    elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices
                    sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus
                    eu, fermentum et, dapibus sed, urna.</p>

                <p>Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus
                    arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus. Mauris nibh felis,
                    adipiscing varius, adipiscing in, lacinia vel, tellus. Suspendisse ac urna. Etiam pellentesque
                    mauris ut lectus. Nunc tellus ante, mattis eget, gravida vitae, ultricies ac, leo. Integer leo pede,
                    ornare a, lacinia eu, vulputate vel, nisl.</p>

                <p>Suspendisse mauris. Fusce accumsan mollis eros. Pellentesque a diam sit amet mi ullamcorper vehicula.
                    Integer adipiscing risus a sem. Nullam quis massa sit amet nibh viverra malesuada. Nunc sem lacus,
                    accumsan quis, faucibus non, congue vel, arcu. Ut scelerisque hendrerit tellus. Integer sagittis.
                    Vivamus a mauris eget arcu gravida tristique. Nunc iaculis mi in ante. Vivamus imperdiet nibh
                    feugiat est.</p>

                <p>Ut convallis, sem sit amet interdum consectetuer, odio augue aliquam leo, nec dapibus tortor nibh sed
                    augue. Integer eu magna sit amet metus fermentum posuere. Morbi sit amet nulla sed dolor elementum
                    imperdiet. Quisque fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                    ridiculus mus. Pellentesque adipiscing eros ut libero. Ut condimentum mi vel tellus. Suspendisse
                    laoreet. Fusce ut est sed dolor gravida convallis. Morbi vitae ante. Vivamus ultrices luctus nunc.
                    Suspendisse et dolor. Etiam dignissim. Proin malesuada adipiscing lacus. Donec metus. Curabitur
                    gravida.</p>
                <p>Published By: {{ $article->publisher->name }}</p>
            </div>
            <!-- <div class="col-md-4"></div> -->
        </div>
    </main>
@endsection