<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Twitter;
use App\Models\Post;
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
        $this->middleware('admin', ['only' => ['needsApproval']]);
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
        $latestPosts = Post::published()->latest()->first();

        return view('pages.home')->with('latest_posts', $latestPosts)->with('tweets',
            $this->getTweets());
    }

    /**
     * Dashboard presentations view.
     */
    public function dashPresentations()
    {
        if(Auth::user()->isAdmin()){
            $presentations = Presentation::all();
        }

        if(!Auth::user()->isAdmin()){
            $presentations = Auth::user()->presentations()->get();
        }

        return view('dashboard.presentations')->with('presentations', $presentations);
    }

    /**
     * Dashboard posts view.
     */
    public function dashPosts()
    {
        if(Auth::user()->isAdmin()){
            $posts = Post::all();
        }

        if(!Auth::user()->isAdmin()){
            $posts = Auth::user()->posts()->get();
        }
        return view('dashboard.posts')->with('posts', $posts);
    }

    /**
     * Dashboard needs approval view.
     */
    public function needsApproval()
    {
        if(Auth::user()->isAdmin()){
            $presentationApprovals = Presentation::where('approved', false)->get();
            $blogApprovals = Post::where('approved', false)->get();

            $presentationCount = Presentation::where('approved', false)->count();
            $blogCount = Post::where('approved', false)->count();

            $approvalCount = $presentationCount + $blogCount;
        }

        if(Auth::user()->isGuest()){
            $presentationApprovals = Auth::user()->presentations()->where('approved', false)->get();
            $blogApprovals = Auth::user()->posts()->where('approved', false)->get();

            $presentationCount = Auth::user()->presentations()->where('approved', false)->count();
            $blogCount = Auth::user()->posts()->where('approved', false)->count();

            $approvalCount = $presentationCount + $blogCount;
        }

        return view('dashboard.needsapproval')
            ->with('presentationApprovals', $presentationApprovals)
            ->with('blogApprovals', $blogApprovals)
            ->with('approvalCount', $approvalCount);
    }

    public function getApprovalCount()
    {
        if(Auth::user()->isAdmin()){
            $presentationCount = Presentation::where('approved', false)->count();
            $blogCount = Post::where('approved', false)->count();

            return $this->approvalCount = $presentationCount + $blogCount;
        }

        if(Auth::user()->isGuest()){
            $presentationCount = Auth::user()->presentations()->where('approved', false)->count();
            $blogCount = Auth::user()->posts()->where('approved', false)->count();

            return $this->approvalCount = $presentationCount + $blogCount;
        }
       
    }
}
