<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoTable extends Migration
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
            $table->string('materno');
            $table->integer('edad');
            $table->string('sexo');

            $table->integer('id_sucursal')->unsigned();
            $table->foreign('id_sucursal')->references('id')->on('sucursals');

            $table->string('cargo');
                
            $table->integer('id_supervisor')->unsigned()->nullable();
            $table->foreign('id_supervisor')->references('id')->on('empleados');

            $table->integer('id_gerente')->unsigned()->nullable();
            $table->foreign('id_gerente')->references('id')->on('empleados');

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
