<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoDatoLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_dato_labs', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('empleado_id')->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('set null');

            $table->unsignedInteger('contrato_id')->nullable();
            $table->foreign('contrato_id')->references('id')->on('tipo_contratos')->onDelete('set null');

            $table->unsignedInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('tipo_areas')->onDelete('set null');

            $table->unsignedInteger('puesto_id')->nullable();
            $table->foreign('puesto_id')->references('id')->on('tipo_puestos')->onDelete('set null');

            $table->unsignedInteger('baja_id')->nullable();
            $table->foreign('baja_id')->references('id')->on('tipo_bajas')->onDelete('set null');

            $table->unsignedInteger('tipo_jornada_id')->nullable();
            $table->foreign('tipo_jornada_id')->references('id')->on('tipo_jornada')->onDelete('set null');

            $table->string('periodo_paga')->nullable();
            $table->string('regimen')->nullable();
            $table->string('lugar_trabajo')->nullable();
            $table->decimal('salario_nomina',8,2)->nullable();
            $table->decimal('salario_dia',8,2)->nullable();
            $table->string('prestaciones')->nullable();
            $table->time('hora_entrada')->nullable();
            $table->time('hora_comida')->nullable();
            $table->time('hora_salida')->nullable();
            $table->date('fecha_contrato')->nullable();
            $table->string('banco')->nullable();
            $table->string('cuenta')->nullable();
            $table->string('clabe')->nullable();
            $table->date('fecha_baja')->nullable();
            $table->text('comentario_baja')->nullable();
            $table->boolean('puntualidad')->default(false);
            $table->string('riesgo_puesto')->nullable();
            $table->date('fecha_fin_contrato')->nullable();
            $table->integer('porcentaje_vales_despensa')->nullable()->default(0);
            $table->timestampsTz();
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
        Schema::dropIfExists('empleado_dato_labs');
    }
}
