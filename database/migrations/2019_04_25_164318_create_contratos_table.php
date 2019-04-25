<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('numero_contrato');
            $table->unsignedDecimal('monto',8,2);
            $table->string('estado');
            $table->unsignedInteger('grupo_id');
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->unsignedInteger('recibo_id');
            $table->foreign('recibo_id')->references('id')->on('recibos');
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
        Schema::dropIfExists('contratos');
    }
}
