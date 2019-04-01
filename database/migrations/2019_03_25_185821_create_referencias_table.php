<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('presolicitud_id');
            $table->foreign('presolicitud_id')->references('id')->on('presolicituds');
            $table->string('paterno');
            $table->string('materno')->nullable();
            $table->string('nombre');
            $table->string('telefono');
            $table->string('parentesco');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referencias');
    }
}
