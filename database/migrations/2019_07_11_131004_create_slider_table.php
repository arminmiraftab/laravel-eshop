<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->increments('slider_id');
            $table->string('slider_image')->nullable();
            $table->string('sub_category_slider')->nullable();
            $table->string('category_slider')->nullable();
            $table->string('detal_slider')->nullable();
            $table->string('submit_slider')->nullable();
            $table->string('submit_link')->nullable();
            $table->string('slider_status')->nullable();

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
        Schema::dropIfExists('slider');
    }
}
