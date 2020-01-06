<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitaAgendadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cita_agendadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cita_id')->unsigned()->nullable();
            $table->foreign('cita_id')->references('id')->on('citas');
            $table->date('fechaSiguienteContacto');
            $table->time('HoraSiguienteContacto');
            $table->date('fechaSiguienteCita');
            $table->time('HoraSiguienteCita');
            $table->text('comentarios')->nullable();
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
        Schema::dropIfExists('cita_agendadas');
    }
}
