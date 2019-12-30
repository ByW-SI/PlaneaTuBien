<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilReferenciaPersonalClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_referencia_personal_clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perfil_id');
            $table->foreign('perfil_id')->references('id')->on('perfil_datos_personal_clientes');
            $table->string('paterno')->nullable();
            $table->string('materno')->nullable();
            $table->string('nombre')->nullable();
            $table->string('parentesco')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
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
        Schema::dropIfExists('perfil_referencia_personal_clientes');
    }
}
