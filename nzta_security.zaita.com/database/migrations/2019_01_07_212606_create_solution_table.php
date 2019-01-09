<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solution', function (Blueprint $table) {
          $table->increments('id');
          $table->string('uuid');
          $table->string('submitter_name');
          $table->string('submitter_role');
          $table->string('submitter_email');
          $table->json('data')->nullable();
          $table->json('ciso_approval')->nullable();
          $table->json('business_owner_approval')->nullable();
          $table->json('security_architect_approval')->nullable();
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
        Schema::dropIfExists('solution');
    }
}
