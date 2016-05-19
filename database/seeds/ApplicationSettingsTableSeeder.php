<?php

use Illuminate\Database\Seeder;
use App\ApplicationSetting;

/**
 * Seeds applications_settings table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ApplicationSettingsTableSeeder extends Seeder {

    /**
     * Run the migrations.
     */
    public function run() {
        ApplicationSetting::create([
            'allow_new_accounts' => true,
            'name' => 'Nova',
            'trial_days' => '1',
        ]);
    }

}
