<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationClassificationTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_classification_tasks', function (Blueprint $table) {
          $table->increments('id');
          $table->string('uuid');          
          $table->json('data')->nullable();
          $table->string('parent_table');
          $table->integer('parent_id');
          $table->string('parent_summary_url');
          $table->string('result');
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
        Schema::dropIfExists('information_classification_tasks');
    }
}
