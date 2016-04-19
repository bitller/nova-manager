<?php

use Illuminate\Database\Seeder;
use App\Client;

/**
 * Seeds users table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class UsersTableSeeder extends Seeder {

    /**
     * Number of users to create.
     *
     * @var integer
     */
    protected $usersToCreate = 2;

    /**
     * Number of clients to attach at each user.
     *
     * @var integer
     */
    protected $clientsPerUser = 5;

    /**
     * Number of bills to attach at each client.
     *
     * @var integer
     */
    protected $billsPerClient = 3;

    /**
     * Seeds table.
     */
    public function run() {
        // Create users and for each one attach required data
        factory(App\User::class, $this->usersToCreate)->create()->each(function($user) {

            // User settings
            $user->settings()->save(factory(App\Setting::class)->make());

            // Attach clients
            for ($i = 1; $i <= $this->clientsPerUser; $i++) {

                $client = $user->clients()->save(factory(App\Client::class)->make());

                // Now attach bills to each client
                for ($j = 1; $j <= $this->billsPerClient; $j++) {
                    $client->bills()->save(factory(App\Bill::class)->make());
                }
            }
        });
    }
}
