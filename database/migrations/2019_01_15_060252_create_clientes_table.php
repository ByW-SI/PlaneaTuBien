<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('appaterno');
            $table->string('apmaterno')->nullable();
            $table->integer('empleado_id')->unsigned()->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->string('rfc')->nullable();
            $table->string('telefono')->nullable();
            $table->string('oficina')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('lugar_nacimiento')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('sexo')->nullable();
            $table->string('edad')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('profesion')->nullable();
            $table->string('empresa')->nullable();
            $table->string('puesto_actual')->nullable();
            $table->string('puesto_anterior')->nullable();
            $table->string('antiguo')->nullable();
            $table->string('ingreso')->nullable();
            $table->string('calle');
            $table->string('numext');
            $table->string('numint')->nullable();
            $table->string('colonia');
            $table->string('delegacion');
            $table->string('estado');
            $table->string('cp');
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
        Schema::dropIfExists('clientes');
    }
}
