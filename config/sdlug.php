<?php
  return [
    'twitterHandle' => function_exists('env') ? env('TWITTER_HANDLE', 'sandiegolaravel') : 'sandiegolaravel',
  ];
