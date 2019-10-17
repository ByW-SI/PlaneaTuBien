<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechaFinContratoToEmpleadoDatoLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleado_dato_labs', function (Blueprint $table) {
            $table->date('fecha_fin_contrato')->nullable();
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
            $table->dropColumn('fecha_fin_contrato');
        });
    }
}
