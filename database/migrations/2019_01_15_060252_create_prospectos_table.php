<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospectos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empleado_id')->unsigned()->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->string('nombre');
            $table->string('appaterno');
            $table->string('apmaterno')->nullable();
            $table->string('sexo');
            $table->string('rfc');
            $table->string('email');
            $table->string('telefono');
            $table->string('movil');
            $table->string('ingreso');
            $table->string('gasto');
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
