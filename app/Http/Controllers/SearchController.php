<?php

namespace App\Http\Controllers;

use Response;
use App\Http\Requests;
use App\Models\Presenter;
use App\Models\Presentation;
use Illuminate\Http\Request;



class SearchController extends Controller
{
     public function getResults($query)
	{
		if (!$query) {
			return redirect()->route('welcome');
		}

		$presentations = Presentation::search($query)->get();
		
		$presenters = Presenter::search($query)->get();

		return Response::json([
			'presentations'  => $presentations,
			'presenters' => $presenters
		]);
	}
}
