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
        Schema::enableForeignKeyConstraints();
        Schema::table('empleado_dato_labs', function (Blueprint $table) {
            $table->unsignedInteger('tipo_jornada_id');
            // $table->foreign('tipo_jornada_id')->references('id')->on('tipo_jornada')->onDelete('set null');
            $table->string('riesgo_puesto')->nullable();

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
