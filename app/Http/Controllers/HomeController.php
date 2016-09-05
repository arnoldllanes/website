<?php

namespace App\Http\Controllers;

use DB;
use Twitter;
use App\Http\Requests;
use App\Models\Presentation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  use \App\Http\Traits\TwitterTrait;
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
        $toApprove = Presentation::where('approved', false)->get();

        return view('home')->with('toApprove', $toApprove);
    }

    /**
     * Display the home page in resources/pages/home.blade.php
     *
     * @return Response
     */
    public function home()
    {
        $latestPresentations = Presentation::published()->latest()->first();

        return view('pages.home')->with('latest_article', $latestPresentations)->with('tweets', $this->getTweets());
    }
}
