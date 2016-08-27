<div class="media">
    <div class="media-left">
        <img class="img-thumbnail media-object" src="{{ $tweet->user->profile_image_url }}" alt="Avatar">
    </div>
    <div class="media-body">
        <a style="font-size: 18px" href="http://www.twitter.com/{{ $tweet->user->screen_name }}"><h4 class="media-heading">{{ $tweet->user->name }}</a> {{ Carbon\Carbon::parse($tweet->created_at)->diffForHumans() }}</h4>
        <p style="font-size: 37px">{{ $tweet->text }}</p>
            <a type="button" class="btn btn-primary" target="__Blank" href="http://www.twitter.com/{{ $tweet->user->screen_name }}">View on Twitter</a>
    </div>
</div>
<hr>