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
            $table->integer('prospecto_id')->unsigned();
            $table->foreign('prospecto_id')->references('id')->on('prospectos');
            $table->integer('prestamo_id')->unsigned();
            $table->foreign('prestamo_id')->references('id')->on('prestamos');
            $table->decimal('status');
            $table->decimal('total');
            $table->decimal('monto');
            $table->decimal('restante');
            $table->string('identificacion');
            $table->string('comprobante');
            $table->string('forma');
            $table->string('banco')->nullable();
            $table->string('cheque')->nullable();
            $table->string('deposito')->nullable();
            $table->string('tarjeta')->nullable();
            $table->string('tarjetaHabiente')->nullable();
            $table->string('referencia');
            $table->string('folio');
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
        Schema::dropIfExists('pagos');
    }
}
