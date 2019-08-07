<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorridasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corridas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cotizacion_id')->unsigned();
            $table->foreign('cotizacion_id')->references('id')->on('cotizacions');
            $table->string('mes');  //campo informativo para numeracion de los meses
            $table->decimal('aportacion');  // aportacion que se debe de dar (integrante o adjudicado)
            $table->decimal('cuota_administracion');  // Cuota quie por la parte de la adminisrtacion
            $table->decimal('iva');  // IVA de la cuota de administracion.
            $table->decimal('seguro_vida');  // monto del seguro de vida.
            $table->decimal('seguro_desastres');  // monto del seguro de desastres, este se pagara en un determinado mes, al principio sera 0.
            $table->decimal('total');  // Total a pagar en el mes es lo que se tiene que registrar.
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
        Schema::dropIfExists('corridas');
    }
}
