<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_estudios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empleado_id')->unsigned()->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('set null');
            $table->string('escolaridad1');
            $table->string('institucion1')->nullable();
            $table->string('cedula1')->nullable();
            $table->string('escolaridad2')->nullable();
            $table->string('institucion2')->nullable();
            $table->string('cedula2')->nullable();
            $table->string('idioma1')->nullable();
            $table->string('nivel1')->nullable();
            $table->string('idioma2')->nullable();
            $table->string('nivel2')->nullable();
            $table->string('idioma3')->nullable();
            $table->string('nivel3')->nullable();
            $table->string('curso1')->nullable();
            $table->boolean('certificado1')->nullable();
            $table->string('curso2')->nullable();
            $table->boolean('certificado2')->nullable();
            $table->string('curso3')->nullable();
            $table->boolean('certificado3')->nullable();
            $table->timestampsTz();
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
        Schema::dropIfExists('empleado_estudios');
    }
}
