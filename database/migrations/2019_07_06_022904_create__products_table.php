<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('Product_id');
            $table->string('Product_name');
            $table->integer('category_id');
            $table->integer('manufacture_id');
            $table->longText('Product_short_description');
            $table->longText('Product_long_description');
            $table->float('Product_price');
            $table->string('Product_image')->nullable();
            $table->string('Product_size');
            $table->integer('color_id')->nullable();
            $table->string('recommended')->nullable();
            $table->tinyInteger('Product_status')->nullable();
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
        Schema::dropIfExists('Product');
    }
}
