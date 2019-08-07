<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosDeCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_de__cotizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cotizacion_id')->unsigned();
            $table->foreign('cotizacion_id')->references('id')->on('cotizacions'); // llave foranea para asociarlo a una cotizacion
            $table->decimal('aportaciones_extraordinarias', 8, 2);  // porcentaje de aportaciones extraordinarias totales
            $table->decimal('monto_financiar', 10, 2);  // Monto que se va a financiar para el prestamo
            $table->decimal('anual_total', 8, 2);  // Porcentaje anual total
            $table->decimal('monto_adjudicar', 10, 2); // Monto que debe de adjudicarse
            $table->decimal('aportacion_integrante', 10, 2);  // Aportacion que se debera de dar mientras sea integrante
            $table->decimal('cuota_administracion_integrante', 8, 2); //Cuota que se debe de pagar mientras sea integrante
            $table->decimal('iva_integrante', 8, 2);  // IVA para cuando se es integrante
            $table->decimal('sv_integrante', 8, 2);  // Seguro de vida cuando se es integrante
            $table->decimal('sd_integrante', 8, 2);  // Seguro de desastres cuando se es integrante
            $table->decimal('aportacion_adjudicado', 8, 2);
            $table->decimal('cuota_administracion_adjudicado', 8, 2);
            $table->decimal('iva_adjudicado', 8, 2);
            $table->decimal('sv_adjudicado', 8, 2);
            $table->decimal('cuota_periodica_integrante', 8, 2);
            $table->decimal('cuota_periodica_adjudicado', 8, 2);
            $table->decimal('total_aportacion_en_mensualidades', 10, 2);
            $table->decimal('total_aportaciones_en_extraordin', 10, 2);
            $table->decimal('total_aportacion', 10, 2);
            $table->decimal('total_cuota_administracion', 8, 2);
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
        Schema::dropIfExists('datos_de__cotizacions');
    }
}
