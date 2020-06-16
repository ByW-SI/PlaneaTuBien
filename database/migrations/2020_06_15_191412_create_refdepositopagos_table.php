<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefdepositopagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refdepositopagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('depositos_efectivo_id')->unsigned();
            $table->foreign('depositos_efectivo_id')->references('id')->on('depositos_efectivos');
            $table->integer('pago_id')->unsigned();
            $table->foreign('pago_id')->references('id')->on('pagos');
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
        Schema::dropIfExists('refdepositopagos');
    }
}
