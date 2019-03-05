<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilInmueblePretendidoClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_inmueble_pretendido_clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perfil_id');
            $table->foreign('perfil_id')->references('id')->on('perfil_datos_personal_clientes');
            $table->string('tipo_inmueble');
            $table->unsignedDecimal('precio_aprox',10,2);
            $table->unsignedDecimal('area_inmueble',8,2);
            $table->string('estado');
            $table->string('colonia');
            $table->unsignedInteger('recamara');
            $table->unsignedDecimal('baño',3,1);
            $table->unsignedInteger('estacionamiento')->default(0);
            $table->unsignedInteger('jardin')->default(0);
            $table->string('gastos_notariales')->nullable();
            $table->unsignedDecimal('monto_contratar',10,2);
            $table->string('tiempo_decision');
            $table->string('prioridad');
            $table->boolean('desicion_propia');
            $table->text('toma_desicion')->nullable();
            $table->text('lograr_meta')->nullable();
            $table->boolean('tomaria_desicion');
            $table->text('motivo_tomaria_desicion')->nullable();
            $table->string('medio_entero');
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('perfil_inmueble_pretendido_clientes');
    }
}
