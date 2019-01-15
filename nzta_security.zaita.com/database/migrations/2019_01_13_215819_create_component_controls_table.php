<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_control', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('component_id');
            $table->string('name');
            $table->longText('description');
            $table->timestamps();
                        
            $table->foreign('component_id')->references('id')->on('component');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_control');
    }
}
