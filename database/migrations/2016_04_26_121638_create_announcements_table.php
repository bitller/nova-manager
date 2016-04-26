<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create announcements table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class CreateAnnouncementsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('announcements', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->enum('type', ['info', 'warning']);
            $table->string('title');
            $table->text('content');
            $table->string('action_button_text')->default(null)->nullable();
            $table->string('action_button_url')->default(NULL)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('announcements');
    }
}
