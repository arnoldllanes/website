<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
	/**
	 * Returns the about static page.
	 */
    public function about()
    {
    	return view('pages.about');
    }

    /**
     * Returns the resources static page.
     */
    public function resources()
    {
    	return view('pages.resources');
    }
}
