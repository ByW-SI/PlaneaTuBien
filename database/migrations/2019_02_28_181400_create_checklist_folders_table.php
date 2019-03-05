<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChecklistFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_folders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('prospecto_id');
            $table->foreign('prospecto_id')->references('id')->on('prospectos');
            $table->string('ficha_deposito_path')->nullable();
            $table->string('perfil_path')->nullable();
            $table->string('presolicitud_path')->nullable();
            $table->string('contrato_path')->nullable();
            $table->string('hoja_aceptacion_path')->nullable();
            $table->string('manual_consumidor_path')->nullable();
            $table->string('calidad_path')->nullable();
            $table->string('privacidad_path')->nullable();
            $table->string('copia_ficha_deposito_path')->nullable();
            $table->string('identificacion_path')->nullable();
            $table->string('comprobante_domicilio_path')->nullable();
            $table->string('croquis_ubicacion_path')->nullable();
            $table->string('carta_bienvenida_path')->nullable();
            $table->string('anexos_path')->nullable();
            $table->boolean('firmas')->default(false);
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
        Schema::dropIfExists('checklist_folders');
    }
}
