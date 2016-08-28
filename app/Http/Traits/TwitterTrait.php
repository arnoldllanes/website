<?php

namespace App\Http\Traits;

use Twitter;

trait TwitterTrait
{
  public function getTweets($handle="sandiegolaravel", $count=3)
  {
    if (cache($handle.'-'.$count)) {
      return cache($handle.'-'.$count);
    }
    
    $tweets = Twitter::getUserTimeline([
      'screen_name' => $handle,
      'count' => $count,
      'format' => 'object'
    ]);

    cache([$handle.'-'.$count => $tweets], 60);

    return $tweets;
  }
}
