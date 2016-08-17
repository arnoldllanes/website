<?php

namespace App\Http\Controllers;

use DB;
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

    public function home()
    {
        $latest_article = Article::published()->latest()->firstOrFail();

        return view('pages.home')->with('latest_article', $latest_article);
    }
}
