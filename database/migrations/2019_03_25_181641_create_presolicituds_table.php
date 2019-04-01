<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presolicituds', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perfil_id');
            $table->foreign('perfil_id')->references('id')->on('perfil_datos_personal_clientes');
            $table->string('folio');
            $table->decimal('precio_inicial',11,2);
            $table->string('plazo_contratado');
            $table->decimal('precio_nolose',11,2);
            // SOLICITANTE NOMBRE
            $table->string('paterno');
            $table->string('materno')->nullable();
            $table->string('nombre');
            // DOMICILIO
            $table->string('calle');
            $table->string('numero_ext');
            $table->string('numero_int')->nullable();
            $table->string('colonia');
            $table->string('municipio');
            $table->string('estado');
            $table->string('cp');
            // RFC
            $table->string('rfc');
            // TELEFONOS
            $table->string('tel_casa');
            $table->string('tel_oficina')->nullable();
            $table->string('tel_celular');
            // EMAIL
            $table->string('email');
            // NACIMIENTO
            $table->date('fecha_nacimiento');
            $table->string('lugar_nacimiento');
            $table->string('nacionalidad');
            $table->string('sexo');
            $table->unsignedInteger('edad');
            // ESTADO CIVIL
            $table->string('estado_civil');
            $table->string('profesion');
            $table->string('empresa')->nullable();
            $table->string('puesto')->nullable();
            $table->string('antiguedad_actual');
            $table->string('antiguedad_anterior');
            $table->string('ingreso_mensual');
            $table->string('enterarse');
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
        Schema::dropIfExists('presolicituds');
    }
}
