<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seguimientoLlamada_id')->unsigned()->nullable();
            $table->foreign('seguimientoLlamada_id')->references('id')->on('seguimiento_llamadas');
            $table->date('fechaSiguienteContacto');
            $table->time('HoraSiguienteContacto');
            $table->date('fechaSiguienteCita');
            $table->time('HoraSiguienteCita');
            $table->text('comentarios')->nullable();
            $table->string('estatusLlamada');
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
        Schema::dropIfExists('citas');
    }
}
