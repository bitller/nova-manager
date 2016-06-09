<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create settings table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class CreateSettingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('settings', function(Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned();

            $table->tinyInteger('number_of_bills')->unsigned()->default(10);
            $table->tinyInteger('number_of_clients')->unsigned()->default(10);

            $table->enum('displayed_bills_filter', ['all', 'current_campaign', 'custom_campaign'])->default('all');
            $table->integer('bills_filter_campaign_id')->unsigned()->nullable();
            $table->enum('bills_status', ['all', 'paid', 'unpaid'])->default('all');

            $table->enum('products_displayed', ['12', '24', '36'])->default(12);
            $table->enum('order_products_by', ['created_at', 'code'])->default('created_at');
            $table->enum('order_products_type', ['asc', 'desc'])->default('asc');
            $table->enum('order_clients_by', ['name', 'email', 'phone_number', 'created_at'])->default('created_at');
            $table->enum('order_clients_type', ['asc', 'desc'])->default('desc');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('bills_filter_campaign_id')->references('id')->on('campaigns')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('settings');
    }
}
