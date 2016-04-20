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

        // Update displayed settings
        Route::group(['prefix' => 'displayed'], function() {
            Route::get('/', 'DisplayedController@index');
            Route::get('/get-number-of-clients', 'DisplayedController@getNumberOfClients');
            Route::get('/get-number-of-bills', 'DisplayedController@getNumberOfBills');
            Route::post('/update-clients', 'DisplayedController@updateNumberOfClients');
            Route::post('/update-bills', 'DisplayedController@updateNumberOfBills');
        });

        // Security settings
        Route::group(['prefix' => 'security'], function() {
            Route::get('/', 'SecurityController@index');
            Route::post('/update-account-password', 'SecurityController@updateAccountPassword');
        });

        // Subscription details and settings
        Route::group(['prefix' => 'subscription-details'], function() {
            Route::get('/', 'SubscriptionDetailsController@index');
        });

        // Payments history and extra billing information
        Route::group(['prefix' => 'payments'], function() {
            Route::get('/', 'PaymentsController@index');
        });

        // Credit card
        Route::group(['prefix' => 'credit-card'], function() {
            Route::get('/', 'CreditCardController@index');
        });
    });

});

Route::get('/home', 'HomeController@index');
