<?php

Route::group(['namespace' => 'Auth'], function() {

    Route::get('/login', 'LoginController@index')->middleware('guest');
    Route::get('/logout', 'LoginController@logout')->middleware('auth');
    Route::post('/login', 'LoginController@login')->middleware('throttle:5,1');

    Route::get('/register', 'RegisterController@index')->middleware('guest');
    Route::post('/register', 'RegisterController@register')->middleware('guest');

});

// Dashboard
Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => 'auth'], function() {

    Route::get('/', 'BillsController@index');
    Route::get('/bills', 'BillsController@index');
    Route::get('/bills/suggest-clients', 'BillsController@suggestClients');

    // User clients
    Route::group(['prefix' => 'clients'], function() {
        Route::get('/', 'ClientsController@index');
        Route::get('/get', 'ClientsController@paginateClients');
        Route::post('/', 'ClientsController@addClient');

        Route::get('/{clientId}', 'ClientsController@client');
        Route::delete('/{clientId}', 'ClientsController@deleteClient');
    });

    // Annoucnements
    Route::group(['prefix' => 'announcements'], function() {
        Route::get('/', 'AnnouncementsController@get');
        Route::post('/make-read', 'AnnouncementsController@makeNotificationsRead');
    });

    // User SettingsPage
    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function() {
        Route::get('/', 'ProfileController@index');

        // Update profile information, email in this case
        Route::group(['prefix' => 'profile'], function() {
            Route::get('/', 'ProfileController@index');
            Route::get('/get-email', 'ProfileController@getEmail');
            Route::post('/change-email', 'ProfileController@changeEmail');
        });

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

// Admin Center
Route::group(['prefix' => 'admin-center', 'namespace' => 'AdminCenter', 'middleware' => ['auth', 'role:admin']], function() {

    // Users section
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UsersController@index');
        Route::get('/{userId}', 'UsersController@user');
        Route::post('/search', 'UsersController@search');
        Route::get('/{userId}/get', 'UsersController@getUser');
        Route::get('/{userId}/disable-account', 'UsersController@disableAccount');
        Route::get('/{userId}/enable-account', 'UsersController@enableAccount');
        Route::get('/{userId}/delete-account', 'UsersController@deleteAccount');
        Route::post('/{userId}/change-password', 'UsersController@changePassword');
    });

    // Announcements section
    Route::group(['prefix' => 'announcements'], function() {
        Route::get('/', 'AnnouncementsController@index');
        Route::get('/types', 'AnnouncementsController@getAnnouncementTypes');
        Route::post('/', 'AnnouncementsController@postAnnouncement');
    });

    // Application settings section
    Route::group(['prefix' => 'application-settings'], function() {
        Route::get('/', 'ApplicationSettingsController@index');
    });

    // Users metrics
    Route::group(['prefix' => 'users-metrics'], function() {
        Route::get('/', 'UsersMetricsController@index');
    });

    // Products metrics
    Route::group(['prefix' => 'products-metrics'], function() {
        Route::get('/', 'ProductsMetricsController@index');
    });

    // Subscriptions metrics
    Route::group(['prefix' => 'subscriptions-metrics'], function() {
        Route::get('/', 'SubscriptionsMetricsController@index');
    });

});

Route::get('/home', 'HomeController@index');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
