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
            // Datos basicos para dar de alta
            $table->integer('empleado_id')->unsigned()->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->string('nombre');
            $table->string('appaterno');
            $table->string('apmaterno')->nullable();
            $table->string('sexo')->nullable();
            $table->string('email');
            $table->string('telefono')->nullable();
            $table->string('celular');
            // Datos para el seguimiento de llamadas
            $table->decimal('sueldo',10,2)->default(0.00);
            $table->string('estado_civil')->nullable();
            $table->integer('edad')->nullable();
            $table->string('nombreConyuge')->nullable();
            $table->integer('edadConyuge')->nullable();
            $table->decimal('montoProyecto',10,2)->nullable();
            $table->string('celular_2')->nullable();
            $table->string('telefonoOficina')->nullable();
            $table->string('telefonoConyugue')->nullable();
            $table->string('telefonoCasa')->nullable();
            $table->string('email_2')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
