<?php

use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    dd($request->user());
});


