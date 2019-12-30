<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status_pagos');
            $table->integer('tipopago_id')->unsigned();
            $table->foreign('tipopago_id')->references('id')->on('tipo_pagos');
            $table->integer('mensualidad_id')->unsigned()->nullable();
            $table->foreign('mensualidad_id')->references('id')->on('mensualidades');
            $table->decimal('monto',8,2);
            $table->date('fecha_pago');
            $table->string('folio');
            $table->string('referencia');
            $table->string('spei')->nullable();
            $table->text('file_comprobante')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_mensuals');
    }
}
