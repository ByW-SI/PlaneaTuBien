<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NulableTurnoAtencionUnidadMedicaToEmpleadoBeneficiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleado_beneficiarios', function (Blueprint $table) {
            $table->string('unidad_medica')->nullable()->change();
            $table->string('turno_atencion')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleado_beneficiarios', function (Blueprint $table) {
            //
        });
    }
}
