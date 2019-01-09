<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftwareAsAServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software_as_a_service', function (Blueprint $table) {
          $table->increments('id');
          $table->string('uuid');
          $table->string('submitter_name');
          $table->string('submitter_role');
          $table->string('submitter_email');
          $table->json('data')->nullable();
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
        Schema::dropIfExists('software_as_a_service');
    }
}
