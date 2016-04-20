<?php

Route::group(['namespace' => 'Auth'], function() {

    Route::get('/login', 'LoginController@index')->middleware('guest');
    Route::get('/logout', 'LoginController@logout')->middleware('auth');
    Route::post('/login', 'LoginController@login')->middleware('throttle:5,1');

    Route::get('/register', 'RegisterController@index')->middleware('guest');
    Route::post('/register', 'RegisterController@register')->middleware('guest');

});

Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleare' => 'auth'], function() {
    Route::get('/', 'BillsController@index');
    Route::get('/bills', 'BillsController@index');
    Route::get('/bills/suggest-clients', 'BillsController@suggestClients');

    // User SettingsPage
    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function() {
        Route::get('/', 'ProfileController@index');

        // Update profile information, email in this case
        Route::get('/profile', 'ProfileController@index');

        // Update account security
        Route::get('/security', 'SecurityController@index');

        // Update displayed settings
        Route::group(['prefix' => 'displayed'], function() {
            Route::get('/', 'DisplayedController@index');
            Route::get('/get-number-of-clients', 'DisplayedController@getNumberOfClients');
            Route::get('/get-number-of-bills', 'DisplayedController@getNumberOfBills');
            Route::post('/update-clients', 'DisplayedController@updateNumberOfClients');
            Route::post('/update-bills', 'DisplayedController@updateNumberOfBills');
        });
        //
        // //
        //
        // // Set number of bills displayed
        // Route::get('/bills', 'NumberOfBillsController@index');
        // Route::get('/bills/get', 'NumberOfBillsController@get');
        // Route::post('/bills/update', 'NumberOfBillsController@update');
        //
        // // Set number of clients displayed
        // Route::get('/clients', 'NumberOfClientsController@index');
        // Route::get('/clients/get', 'NumberOfClientsController@get');
        // Route::post('/clients/update', 'NumberOfClientsController@update');
    });

});

Route::get('/home', 'HomeController@index');
