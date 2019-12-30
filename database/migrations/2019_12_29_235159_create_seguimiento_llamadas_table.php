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
            $table->integer('prospecto_id')->unsigned()->nullable();
            $table->foreign('prospecto_id')->references('id')->on('prospectos');
            $table->integer('resultado_llamada_id')->unsigned()->nullable();
            $table->foreign('resultado_llamada_id')->references('id')->on('resultado_llamadas');
            $table->date('fecha_siguiente_contacto');
            $table->date('fecha_contacto');
            $table->text('comentario');
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
