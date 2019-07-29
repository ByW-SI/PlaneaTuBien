<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_permisos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empleado_id')->unsigned();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->string('tipopermiso');
            $table->string('permiso');
            $table->date('fecha');
            $table->date('fechainicio')->nullable();
            $table->date('fechafin')->nullable();
            $table->time('horainicio')->nullable();
            $table->time('horafin')->nullable();
            $table->unsignedInteger('diastotales')->nullable();
            $table->unsignedDecimal('horastotales',4,2)->nullable();
            $table->text('motivo');
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
        Schema::dropIfExists('empleado_permisos');
    }
}
