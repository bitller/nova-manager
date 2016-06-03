<?php

use Illuminate\Database\Seeder;
use App\Client;
use App\Announcement;
use App\InitialProduct;
use App\Product;

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
     * Number of info announces to attach at each user.
     *
     * @var integer
     */
    protected $infoAnnouncementsPerUser = 2;

    /**
     * Number of warning announcements to attach at each user.
     *
     * @var integer
     */
    protected $warningAnnouncementsPerUser = 2;

    /**
     * Number of clients to attach at each user.
     *
     * @var integer
     */
    protected $clientsPerUser = 1500;

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

            info('Generated user ' . $user->email);
            $this->command->info('Creating user with email ' . $user->email);

            // User settings
            $user->settings()->save(factory(App\Setting::class)->make());
            info('Generated settings for user ' . $user->email);

            // Attach clients
            for ($i = 1; $i <= $this->clientsPerUser; $i++) {

                $client = $user->clients()->save(factory(App\Client::class)->make());

                // Now attach bills to each client
                for ($j = 1; $j <= $this->billsPerClient; $j++) {
                    $client->bills()->save(factory(App\Bill::class)->make());
                }
            }

            // Attach info announcements
            $infoAnnouncements = App\Announcement::where('type', 'info')->get();
            $counter = 0;
            foreach ($infoAnnouncements as $infoAnnouncement) {
                $user->announcements()->attach($infoAnnouncement);
                info('Attached info annoucement to user ' . $user->email);
                $counter++;
                if ($counter >= $this->infoAnnouncementsPerUser) {
                    break;
                }
            }

            // Attach warning announcements
            $warningAnnouncements = App\Announcement::where('type', 'warning')->get();
            $counter = 0;
            foreach ($warningAnnouncements as $warningAnnouncement) {
                $user->announcements()->attach($warningAnnouncement);
                info('Attached warning annoucement to user ' . $user->email);
                $counter++;
                if ($counter >= $this->warningAnnouncementsPerUser) {
                    break;
                }
            }

            // Attach products to the user
            $this->command->info('Populating products table.');
            $initialProducts = InitialProduct::all();
            foreach ($initialProducts as $product) {
                Product::create([
                    'user_id' => $user->id,
                    'name' => $product->name,
                    'code' => $product->code
                ]);
            }
            $this->command->info('Products table populated.');
        });
    }
}
