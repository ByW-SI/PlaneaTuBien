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
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->string('sexo')->nullable();
            $table->string('email')->nullable();
            $table->integer('sucursal_id')->unsigned()->nullable();
            $table->foreign('sucursal_id')->references('id')->on('sucursals');
            $table->string('cargo')->nullable();
            // $table->integer('id_jefe')->unsigned()->nullable();
            // $table->foreign('id_jefe')->references('id')->on('empleados');
            $table->string('status')->nullable();
            $table->string('rfc')->nullable();
            $table->string('telefono')->nullable();
            $table->string('movil')->nullable();
            $table->string('nss')->nullable();
            $table->string('curp')->nullable();
            $table->string('infonavit')->nullable();
            $table->string('cp')->nullable();
            $table->string('calle')->nullable();
            $table->string('num_ext')->nullable();
            $table->string('num_int')->nullable();
            $table->string('colonia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('estado')->nullable();
            $table->string('calles')->nullable();
            $table->string('referencia')->nullable();
            $table->string('fecha_baja')->nullable();
            $table->text('motivo_baja')->nullable();
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
        Schema::dropIfExists('empleados');
    }
}
