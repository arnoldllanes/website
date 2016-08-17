<?php

namespace App\Http\Controllers;

use App\Tag;

class TagController extends Controller
{
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

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     **/
    public function show($id)
    {
    	$tag = Tag::where('id', $id)->firstOrfail();
    	$tag->load('articles');
    	
    	return view('tags.show')->with('tag', $tag);
    }
}
