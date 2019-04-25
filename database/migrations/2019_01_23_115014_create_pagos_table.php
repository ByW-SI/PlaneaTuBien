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
            $table->integer('cotizacion_id')->unsigned();
            $table->foreign('cotizacion_id')->references('id')->on('cotizacions');
            $table->string('status')->default('registrado');
            $table->decimal('monto',8,2);
            $table->decimal('adeudo',8,2)->default(0);
            $table->decimal('total',8,2);
            $table->string('identificacion');
            $table->string('comprobante');
            $table->string('forma');
            $table->string('banco')->nullable();
            $table->string('cheque')->nullable();
            $table->string('deposito')->nullable();
            $table->string('tarjeta')->nullable();
            $table->string('tarjeta_habiente')->nullable();
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
