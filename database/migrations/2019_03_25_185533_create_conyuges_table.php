<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConyugesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conyuges', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('presolicitud_id');
            $table->foreign('presolicitud_id')->references('id')->on('presolicituds');
            // nombre
            $table->string('paterno');
            $table->string('materno')->nullable();
            $table->string('nombre');
            // fecha nacimiento
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento');
            $table->string('nacionalidad');
            // telefonos
            $table->string('tel_casa');
            $table->string('tel_oficina')->nullable();
            $table->string('tel_celular')->nullable();
            $table->string('email');
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
        Schema::dropIfExists('conyuges');
    }
}
