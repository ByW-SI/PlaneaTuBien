<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoEmergenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_emergencias', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('empleado_id')->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->string('sangre');
            $table->text('enfermedades')->nullable();
            $table->text('alergias')->nullable();
            $table->text('operaciones')->nullable();
            $table->string('nombrecontac1')->nullable();
            $table->string('parentescocontac1')->nullable();
            $table->string('telefonocontac1')->nullable();
            $table->string('movilcontac1')->nullable();
            $table->string('nombrecontac2')->nullable();
            $table->string('parentescocontac2')->nullable();
            $table->string('telefonocontac2')->nullable();
            $table->string('movilcontac2')->nullable();
            $table->string('nombrecontac3')->nullable();
            $table->string('parentescocontac3')->nullable();
            $table->string('telefonocontac3')->nullable();
            $table->string('movilcontac3')->nullable();
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
        Schema::dropIfExists('empleado_emergencias');
    }
}
