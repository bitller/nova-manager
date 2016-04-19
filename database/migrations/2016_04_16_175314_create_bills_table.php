<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create bills table.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class CreateBillsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bills', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('client_id')->unsigned();
            $table->tinyInteger('campaign_order')->default(1);
            $table->date('payment_term');
            $table->text('other_details');
            $table->enum('paid', [0, 1])->default(0);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('bills');
    }
}
