<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPorcentajeValesDespensaToEmpleadoDatoLabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleado_dato_labs', function (Blueprint $table) {
            $table->integer('porcentaje_vales_despensa')->nullable()->default(0);
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
            $table->dropColumn('porcentaje_vales_despensa');
        });
    }
}
