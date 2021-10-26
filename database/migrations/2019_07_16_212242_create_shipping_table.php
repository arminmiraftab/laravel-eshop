<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping', function (Blueprint $table) {
            $table->increments('shipping_id');
            $table->integer('customer_id')->nullable();
            $table->bigInteger('shipping_code_post');
            $table->string('shipping_adderss_map');
            $table->string('shipping_address');
            $table->string('House_number');
            $table->double('long')->nullable();
            $table->double('lat')->nullable();
            $table->string('shipping_unit');
            $table->softDeletes();
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
        Schema::dropIfExists('shipping');
    }
}
