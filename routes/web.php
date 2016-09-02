<?php

Route::get('/', 'HomeController@home');

Auth::routes();

Route::get('home', 'HomeController@index');
Route::get('about', 'PageController@about');
Route::get('resources', 'PageController@resources');
Route::resource('presentations', 'PresentationController');
Route::resource('tags', 'TagController', ['only' => ['index', 'show', 'store']]);
Route::resource('presenters', 'PresenterController', ['only' => ['index', 'show']]);

Route::post('comment/{presentationId}', 'CommentController@postComment');
Route::post('comment/{presentationId}/{commentId}/reply', 'CommentController@postReply');
Route::get('comment/{commentId}/like', 'CommentController@getLike');
