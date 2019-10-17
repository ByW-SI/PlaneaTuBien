<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToEmpleadoDatoLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleado_dato_labs', function (Blueprint $table) {
            $table->integer('tipo_jornada_id')->unsigned()->nullable();
            $table->string('riesgo_puesto')->nullable();

            $table->foreign('tipo_jornada_id')->references('id')->on('tipo_jornada')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleado_dato_labs', function (Blueprint $table) {
            $table->dropColumn('tipo_jornada_id');
            $table->dropColumn('riesgo_puesto');
        });
    }
}
