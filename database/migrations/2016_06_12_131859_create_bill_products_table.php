<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bill_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bill_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->smallInteger('quantity')->unsigned()->default(1);
            $table->double('price');
            $table->smallInteger('page');
            $table->double('price_without_discount');
            $table->tinyInteger('discount')->unsigned()->default(0);
            $table->boolean('available_now')->unsigned()->default(false);
            $table->timestamps();

            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('bill_products');
    }
}
