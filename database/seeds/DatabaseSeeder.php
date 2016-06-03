<?php

use Illuminate\Database\Seeder;
use App\InitialProduct;
use App\ApplicationSetting;

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
        $this->call(ApplicationSettingsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CampaignsTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        $this->call(InitialProductsTableSeeder::class);
        $this->call(AnnouncementsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
