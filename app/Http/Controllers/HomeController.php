<?php

namespace App\Http\Controllers;

use DB;
use Auth;
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
        // $toApprove = Presentation::where('approved', false)->get();
        if(Auth::user()->isAdmin()){
            $presentations = Presentation::all();
        } else if (Auth::user()->isMember()){
            $presentations = Presentation::where('user_id', Auth::user()->id)->get();
        } else if (Auth::user()->isGuest()){
            $presentations = Presentation::where('user_id', Auth::user()->id)->get();
        }

        return view('home')->with('presentations', $presentations);
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
