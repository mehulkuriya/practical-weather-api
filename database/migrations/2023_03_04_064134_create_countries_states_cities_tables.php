<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->string("short_code");
            $table->string('name');
            $table->string("country_code");
            $table->timestamps();
        });
  
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->string('name');
            $table->string('country_uuid');
            $table->timestamps();
        });
  
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string("uuid");
            $table->string('name');
            $table->string('state_uuid'); 
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
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
    }
};
