<?php

Route::group(['prefix' => 'api/v1'], function() {
	Route::get('gettags', 'TagController@getTags');
});

Route::get('/', 'HomeController@home');

Auth::routes();

Route::get('home', 'HomeController@index');
Route::get('about', 'PageController@about');
Route::get('resources', 'PageController@resources');
Route::resource('presentations', 'PresentationController');
Route::resource('tags', 'TagController', ['only' => ['index', 'show', 'store']]);
Route::resource('presenters', 'PresenterController', ['only' => ['index', 'show']]);
