<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create clients table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class CreateClientsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('clients', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable()->default('');
            $table->string('phone_number')->nullable()->default('');
            $table->date('birth_date')->nullable();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('clients');
    }
}
