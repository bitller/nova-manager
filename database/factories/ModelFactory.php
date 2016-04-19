<?php

use Carbon\Carbon;
use Faker\Generator;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'password' => bcrypt('123456'),
        'remember_token' => str_random(10),
        'trial_ends_at' => Carbon::now()->addDays(10)
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone_number' => $faker->phoneNumber
    ];
});

$factory->define(App\Bill::class, function (Faker\Generator $faker) {
    return [
        'payment_term' => date('Y-m-d'),
        'other_details' => 'Bitller S.R.L.'
    ];
});

$factory->define(App\Setting::class, function () {
    return [
        'number_of_clients' => rand(1, 100),
        'number_of_bills' => rand(1, 100)
    ];
});
