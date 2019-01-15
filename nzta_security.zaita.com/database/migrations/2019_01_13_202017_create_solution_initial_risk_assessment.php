<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolutionInitialRiskAssessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('solution_initial_risk_assessment', function (Blueprint $table) {
          $table->increments('id');
          $table->string('uuid');
          $table->string('name')->nullable();
          $table->string('submitter_name');
          $table->string('submitter_role');
          $table->string('submitter_email');
          $table->json('data')->nullable();
          $table->string('result')->nullable();
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
      Schema::dropIfExists('solution_initial_risk_assessment');
    }
}
