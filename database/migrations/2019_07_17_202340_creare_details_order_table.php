<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreareDetailsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
//            $table->engine = 'InnoDB';

            $table->increments('order_details_id');
            $table->integer('order_id')->index();
//            $table->foreign('order_id')->references('order_id')->on('order');
            $table->integer('Product_id')->index();
//            $table->foreign('Product_id')->references('Product_id')->on('product');
            $table->string('Product_name');
            $table->string('Product_price');
            $table->string('Product_sales_quantity');
            $table->integer('customer_id')->nullable();
            $table->integer('shipping_id')->nullable();
            $table->tinyInteger('state_fa')->nullable();
            $table->integer('time_fa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
