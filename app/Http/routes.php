<?php

Route::group(['namespace' => 'Auth'], function() {
    Route::get('/register', 'RegisterController@index');
    Route::post('/register', 'RegisterController@register');
});

Route::get('/home', 'HomeController@index');
