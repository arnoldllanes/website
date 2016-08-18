<?php
Route::get('/', 'HomeController@home');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('articles', 'ArticleController');
Route::resource('tags', 'TagController', ['only' => ['index', 'show']]);
Route::resource('presenters', 'PresenterController', ['only' => ['index', 'show']]);
