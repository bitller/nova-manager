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

    // Bills
    Route::get('/', 'BillsController@index');
    Route::group(['prefix' => 'bills'], function() {
        Route::get('/', 'BillsController@index');
        Route::get('/suggest-clients', 'BillsController@suggestClients');
        Route::get('/{billId}', 'BillsController@bill');
    });

    // User clients
    Route::group(['prefix' => 'clients'], function() {
        Route::get('/', 'ClientsController@index');
        Route::get('/get', 'ClientsController@paginateClients');
        Route::post('/', 'ClientsController@addClient');

        Route::get('/{clientId}', 'ClientsController@client');
        Route::get('/{clientId}/basic-informations', 'ClientsController@getBasicInformations');
        Route::get('/{clientId}/personal-informations', 'ClientsController@getPersonalInformations');
        Route::group(['prefix' => '{clientId}'], function() {
            Route::post('/update-name', 'ClientsController@updateName');
        });
        Route::delete('/{clientId}', 'ClientsController@deleteClient');
    });

    // Products
    Route::group(['prefix' => 'products'], function() {
        Route::get('/', 'ProductsController@index');
        Route::get('/sort-details', 'ProductsController@getSortDetails');
        Route::get('/paginate', 'ProductsController@paginate');
        Route::post('/add', 'ProductsController@add');
        Route::post('/update-order-by', 'ProductsController@updateOrderBy');
        Route::post('/update-order-type', 'ProductsController@updateOrderType');
        Route::post('/update-products-displayed', 'ProductsController@updateProductsDisplayed');
    });

    // Statistics
    Route::group(['prefix' => 'statistics', 'namespace' => 'Statistics'], function() {

        // General statistics
        Route::group(['prefix' => 'general'], function() {

            // Clients
            Route::group(['prefix' => 'clients'], function() {
                Route::get('/', 'ClientsStatisticsController@general');
            });

            // Earnings
            Route::group(['prefix' => 'earnings'], function() {
                Route::get('/', 'EarningsStatisticsController@general');
            });

            // Products
            Route::group(['prefix' => 'products'], function() {
                Route::get('/', 'ProductsStatisticsController@general');
            });
        });

        // Campaign statistics
        Route::group(['prefix' => 'campaign'], function() {

            // Clients
            Route::group(['prefix' => 'clients'], function() {
                Route::get('/', 'ClientsStatisticsController@campaign');
            });

            // Earnings
            Route::group(['prefix' => 'earnings'], function() {
                Route::get('/', 'EarningsStatisticsController@campaign');
            });

            // Products
            Route::group(['prefix' => 'products'], function() {
                Route::get('/', 'ProductsStatisticsController@campaign');
            });
        });
    });

    // Support
    Route::group(['prefix' => 'support'], function() {
        Route::get('/', 'SupportController@index');
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
            Route::get('/generate-client-token', 'SubscriptionDetailsController@generateClientToken');
            Route::get('/get-current-subscription', 'SubscriptionDetailsController@currentSubscription');
            Route::get('/cancel', 'SubscriptionDetailsController@cancelSubscription');
            Route::get('/resume', 'SubscriptionDetailsController@resumeSubscription');
            Route::post('/new', 'SubscriptionDetailsController@createNewSubscription');
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
