<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoBeneficiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_beneficiarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empleado_id')->unsigned();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->string('nombre');
            $table->string('appaterno');
            $table->string('apmaterno')->nullable();
            $table->string('parentesco');
            $table->string('rfc')->nullable();
            $table->string('calle');
            $table->string('num_ext');
            $table->string('num_int')->nullable();
            $table->string('colonia');
            $table->string('municipio');
            $table->string('estado');
            $table->string('telefono');
            $table->string('unidad_medica');
            $table->string('turno_atencion');
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
        Schema::dropIfExists('empleado_beneficiarios');
    }
}
