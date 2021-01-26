<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThingkindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thing_kinds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kind_name')->unique();
            $table->string('descr');
            $table->string('thumb_image');
            $table->string('marker_image_ok');
            $table->string('marker_image_medium');
            $table->string('marker_image_critical');
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
        Schema::dropIfExists('thing_kinds');
    }
}
