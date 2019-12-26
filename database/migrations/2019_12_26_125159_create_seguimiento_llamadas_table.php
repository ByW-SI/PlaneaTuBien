<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientoLlamadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimiento_llamadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asesor_id')->unsigned()->nullable();
            $table->foreign('asesor_id')->references('empleado_id')->on('empleado_prospecto');
            $table->string('clavePreautorizacion');
            $table->date('fecha_cita');
            $table->string('numTarjetas');
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
        Schema::dropIfExists('seguimiento_llamadas');
    }
}
