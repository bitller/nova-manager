<?php

Route::group(['namespace' => 'Auth'], function() {

    Route::get('/login', 'LoginController@index')->middleware('guest');
    Route::get('/logout', 'LoginController@logout')->middleware('auth');
    Route::post('/login', 'LoginController@login')->middleware('throttle:5,1');

    Route::get('/register', 'RegisterController@index')->middleware('guest');
    Route::post('/register', 'RegisterController@register')->middleware('guest');

});

Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard'], function() {
    Route::get('/', 'BillsController@index');
    Route::get('/bills', 'BillsController@index');
});

Route::get('/home', 'HomeController@index');
