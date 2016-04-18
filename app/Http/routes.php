<?php

Route::group(['namespace' => 'Auth'], function() {
    Route::get('/register', 'RegisterController@index');
    Route::post('/register', 'RegisterController@register');
});

Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard'], function() {
    Route::get('/', 'BillsController@index');
    Route::get('/bills', 'BillsController@index');
});

Route::get('/home', 'HomeController@index');
