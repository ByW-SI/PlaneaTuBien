<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoMensualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_mensuals', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->string('status')->default('registrado');
            $table->decimal('monto',8,2);
            $table->date('fecha_pago');
            $table->decimal('adeudo',8,2)->default(0);
            $table->decimal('total',8,2);
            $table->string('folio');
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
