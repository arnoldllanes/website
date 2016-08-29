<?php

namespace App\Http\Controllers;

use App\Models\Presenter;

class PresenterController extends Controller
{
    /**
     * Display listing of the resource.
     *
     * @return response
     */
    public function index()
    {
        $presenters = Presenter::all();

        return view('presenters.index')->with('presenters', $presenters);
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
        $presenter = Presenter::where('id', $id)->firstOrfail();
        $presenter->load('myArticles');

        return view('presenters.show')->with('presenter', $presenter);
    }
}
