<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pago_inscripcion_id');
            $table->foreign('pago_inscripcion_id')->references('id')->on('pago_inscripcions');
            $table->string('sucursal');
            $table->string('asesor');
            $table->decimal('monto',10,2);
            $table->string('clave');
            $table->string('tipo_pago');
            $table->string('tipo_tarjeta')->nullable();
            $table->string('numero')->nullable();
            $table->string('banco')->nullable();
            $table->decimal('insc_inicial',10,2);
            $table->decimal('iva',8,2);
            $table->decimal('subtotal',8,2);
            $table->decimal('cuota_periodica',8,2);
            $table->decimal('total',10,2);
            $table->string('total_letra')->nullable();
            // $table->string('numero_contrato');
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
        Schema::dropIfExists('recibos');
    }
}
