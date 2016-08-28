<?php

namespace App\Http\Controllers;

use DB;
use Twitter;
use App\Article;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['home']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display the home page in resources/pages/home.blade.php
     *
     * @return Response
     */
    public function home()
    {
        $latestArticle = Article::published()->latest()->first();

        $tweets = Twitter::getUserTimeline(['screen_name' => config('sdlug.twitterHandle'), 'count' => 3, 'format' => 'object']);

        return view('pages.home')->with('latest_article', $latestArticle)->with('tweets', $tweets);
    }
}
