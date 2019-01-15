<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadocontactoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleadocontactos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_empleado')->unsigned()->nullable();
            $table->foreign('id_empleado')->references('id')->on('empleados');

            $table->string('telefono');
            $table->string('celular');
            $table->string('correo');

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
        Schema::dropIfExists('empleadocontactos');
    }
}
