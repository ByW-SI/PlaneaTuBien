<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegrantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrantes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('prospecto_id');
            $table->timestamps();
            
            $table->foreign('prospecto_id')->references('id')->on('prospectos');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integrantes');
    }
}
