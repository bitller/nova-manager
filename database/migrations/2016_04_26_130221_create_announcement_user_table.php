<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create announcement_user table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class CreateAnnouncementUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('announcement_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('announcement_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('read')->default(false);
            $table->timestamps();

            $table->foreign('announcement_id')->references('id')->on('announcements')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('announcement_user');
    }
}
