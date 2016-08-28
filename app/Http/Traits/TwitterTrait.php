<?php

namespace App\Http\Traits;

use Twitter;

trait TwitterTrait
{
    public function getTweets($handle="sandiegolaravel", $count=3)
    {
        return Twitter::getUserTimeline([
        'screen_name' => $handle,
        'count' => $count,
        'format' => 'object'
    ]);
  }
}
