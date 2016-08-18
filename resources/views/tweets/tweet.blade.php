<div class="media">
    <div class="media-left">
        <img class="img-thumbnail media-object" src="{{ $tweet->user->profile_image_url }}" alt="Avatar">
    </div>
    <div class="media-body">
        <h4 class="media-heading">{{ $tweet->user->name }}
            <span>@</span>{{ $tweet->user->screen_name }} {{ $tweet->created_at }}</h4>
        <p>{{ $tweet->text }}</p>
        <p><a target="_blank" href="http://www.twitter.com/{{ $tweet->user->screen_name }}">
                View on Twitter
            </a></p>
    </div>
</div>