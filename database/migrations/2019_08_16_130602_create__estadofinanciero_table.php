<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadofinancieroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_financiero', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->decimal('adeudo', 10,2)->nullable();
            $table->decimal('abono', 10,2)->nullable();
            $table->decimal('recargo', 10,2)->nullable();
            $table->decimal('saldo', 10,2)->nullable();
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
        Schema::dropIfExists('estado_financiero');
    }
}
