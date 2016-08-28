<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    use \App\Http\Traits\TwitterTrait;
	/**
	 * Returns the about static page.
	 */
    public function about()
    {
      $ericTweet = $this->getTweets('shocm', 1);
      // dd($ericTweet);
    	return view('pages.about', ['ericTweets' => $ericTweet]);
    }

    /**
     * Returns the resources static page.
     */
    public function resources()
    {
    	return view('pages.resources');
    }
}
