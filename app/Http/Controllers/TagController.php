<?php

namespace App\Http\Controllers;

use App\Tag;
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
     * Display listing of the resource.
     *
     * @return response
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
     * @param int $id
     *
     * @return Response
     **/
    public function show($id)
    {
        $tag = Tag::where('id', $id)->firstOrfail();
        $tag->load('articles');

        return view('tags.show')->with('tag', $tag);
    }

    /**
     * Store tag. 
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Tag::create($request->all());

        return back()->with([
            'flash_message' => $request->name . ' has been added to tags list',
            'flash_message_important' => true
        ]);

    }
}
