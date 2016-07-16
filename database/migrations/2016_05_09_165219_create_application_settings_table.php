<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create application_settings table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class CreateApplicationSettingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('application_settings', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->boolean('allow_new_accounts')->defalt(true);
            $table->string('name')->default('Nova');
            $table->string('landing_index_title')->default('Aplicația dedicată reprezentanților Avon.');
            $table->tinyInteger('trial_days')->unsigned()->default(30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('application_settings');
    }
}
