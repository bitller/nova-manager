<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        \Validator::extend('not_exists', 'App\CustomValidationRules\NotExists@validate');
        \Validator::extend('current_user_password', 'App\CustomValidationRules\CurrentUserPassword@validate');
        \Validator::extend('not_belongs_to_another_client_of_same_user', 'App\CustomValidationRules\NotBelongsToAnotherClientOfSameUser@validate');
        \Validator::extend('unique_product_code_for_current_user', 'App\CustomValidationRules\UniqueProductCodeForCurrentUser@validate');
        \Validator::extend('unique_product_code_for_current_user_except', 'App\CustomValidationRules\UniqueProductCodeForCurrentUserExcept@validate');
        \Validator::extend('product_belongs_to_current_user', 'App\CustomValidationRules\ProductBelongsToCurrentUser@validate');

        \Braintree_Configuration::environment(env('BRAINTREE_ENV'));
        \Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        \Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        \Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
