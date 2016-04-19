<?php

use Illuminate\Database\Seeder;

/**
 * Seeds the database.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(RolesTableSeeder::class);
        $this->call(CampaignsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
