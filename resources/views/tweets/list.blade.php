@foreach($tweets as $tweet)
    <div class="animate-box">
        @include('tweets.tweet')
    </div>
@endforeach