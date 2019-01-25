<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno')->nullable();
            $table->string('email')->nullable();
            $table->integer('edad')->nullable();
            $table->string('sexo')->nullable();
            $table->integer('sucursal_id')->unsigned()->nullable();
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->string('cargo')->nullable();
            $table->integer('id_jefe')->unsigned()->nullable();
            $table->foreign('id_jefe')->references('id')->on('empleados');
            $table->string('status')->nullable();
            $table->string('fechabaja')->nullable();
            $table->string('motivobaja')->nullable();
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
        Schema::dropIfExists('empleados');
    }
}
