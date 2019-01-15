<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentSelectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('component_selection', function (Blueprint $table) {
          $table->increments('id');
          $table->string('uuid');
          $table->string('name')->nullable();
          $table->string('submitter_name');
          $table->string('submitter_role');
          $table->string('submitter_email');
          $table->json('data')->nullable();
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
      Schema::dropIfExists('component_selection');
    }
}
