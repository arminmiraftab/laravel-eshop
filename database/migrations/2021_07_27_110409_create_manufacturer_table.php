<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManufacturerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacture', function (Blueprint $table) {
            $table->increments('manufacture_id');
            $table->string('manufacture_name');
            $table->string('manufacture_description')->nullable();
            $table->tinyInteger('manufacture_status')->nullable();
            $table->softDeletes();
            $table->timestamps();
                    //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manufacture');

    }
}
