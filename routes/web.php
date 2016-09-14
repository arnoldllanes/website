<?php

Route::get('/', 'HomeController@home');

// Auth
Auth::routes();

// Pages
Route::get('home', 'HomeController@index');
Route::get('about', 'PageController@about');
Route::get('resources', 'PageController@resources');

// Posts
Route::resource('posts', 'PostController');

// Presentations
Route::resource('presentations', 'PresentationController');
Route::post('presentations/approve/{presentation}', 'PresentationController@approve');
Route::post('presentations/reject/{presentation}', 'PresentationController@reject');

// Tags
Route::resource('tags', 'TagController', ['only' => ['index', 'show', 'store']]);

// Presenters
Route::resource('presenters', 'PresenterController', ['only' => ['index', 'show']]);

// Comments
Route::post('comment/{presentationId}', 'CommentController@postComment');
Route::post('comment/{presentationId}/{commentId}/reply', 'CommentController@postReply');
Route::get('comment/{commentId}/like', 'CommentController@like');
Route::post('comment/{presentaitonId}/flag', 'CommentController@flag');
