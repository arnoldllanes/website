<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Response;
use App\Http\Requests;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('tags.index')->with('tags', $tags);
    }

    public function getTags()
    {
        $tags = Tag::all();

        return Response::json([
            'tags' => $tags
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::where('id', $id)->firstOrfail();
        $tag->load('presentations');

        return view('tags.show')->with('tag', $tag);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $tag = Tag::where('name', $request->name)->first();
        if($tag){ 
            return back()->with([
                'flash_message' => $request->name . ' has been added to tags list',
                'flash_message_important' => true
            ]);
        }

        Tag::create($request->all());

        return back()->with([
            'flash_message' => $request->name . ' has been added to tags list',
            'flash_message_important' => true
        ]);

    }
}
