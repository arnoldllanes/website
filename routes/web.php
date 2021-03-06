<?php


Route::get('/', 'HomeController@home');

// Dashboard

Route::get('needsapproval', 'HomeController@needsApproval');
Route::get('dashboard/presentations', 'HomeController@dashPresentations');
Route::get('dashboard/posts', 'HomeController@dashPosts');

// Auth
Auth::routes();

// Pages
Route::get('home', 'HomeController@index');
Route::get('about', 'PageController@about');
Route::get('resources', 'PageController@resources');

// Posts
Route::resource('posts', 'PostController');
Route::post('posts/approve/{post}', 'PostController@approve');
Route::post('posts/reject/{post}', 'PostController@reject');

// Presentations
Route::resource('presentations', 'PresentationController');
Route::post('presentations/approve/{presentation}', 'PresentationController@approve');
Route::post('presentations/reject/{presentation}', 'PresentationController@reject');

// Tags
Route::resource('tags', 'TagController', ['only' => ['index', 'show', 'store']]);

// Presenters
Route::resource('presenters', 'PresenterController', ['only' => ['index', 'show']]);

// Comments
Route::post('comment/{id}/{type}', 'CommentController@postComment');
Route::post('comment/{id}/{commentId}/{type}/reply', 'CommentController@postReply');
Route::get('comment/{commentId}/like', 'CommentController@like');
Route::post('comment/{presentaitonId}/flag', 'CommentController@flag');

// Search
Route::get('/search/{query}', 'SearchController@getResults');
