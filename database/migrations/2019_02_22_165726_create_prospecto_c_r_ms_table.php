<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectoCRMsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospecto_c_r_ms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('prospecto_id');
            $table->foreign('prospecto_id')->references('id')->on('prospectos');
            $table->date('fecha_act');
            $table->date('fecha_contacto');
            $table->date('fecha_aviso');
            $table->time('hora_contacto');
            $table->string('status');
            $table->text('comentarios')->nullable();
            $table->text('acuerdos')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('tipo_contacto');
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
        Schema::dropIfExists('prospecto_c_r_ms');
    }
}
