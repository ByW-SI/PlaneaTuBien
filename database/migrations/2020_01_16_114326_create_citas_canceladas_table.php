<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasCanceladasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas_canceladas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cita_id')->nullable();
            $table->text('comentario')->nullable();
            $table->unsignedInteger('asesor_confirmador_id')->nullable();
            $table->string('tipo_cancelacion')->nullable();
            $table->timestamps();

            $table->foreign('cita_id')->references('id')->on('citas');
            $table->foreign('asesor_confirmador_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas_canceladas');
    }
}
