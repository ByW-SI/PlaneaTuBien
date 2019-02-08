<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prospecto_id')->unsigned();
            $table->foreign('prospecto_id')->references('id')->on('prospectos');
            $table->string('propiedad');
            $table->string('ahorro')->nullable();
            $table->string('plan');
            $table->string('adjudicar');
            $table->string('plazo');
            $table->string('mensualidad');
            $table->string('porc1');
            $table->string('porc2');
            $table->string('porc3');
            $table->string('porc4');
            $table->string('monto1');
            $table->string('monto2');
            $table->string('monto3');
            $table->string('monto4');
            $table->string('mes1');
            $table->string('mes2');
            $table->string('mes3');
            $table->string('total');
            $table->string('anual');
            $table->string('inscripcion');
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
        Schema::dropIfExists('cotizacions');
    }
}
