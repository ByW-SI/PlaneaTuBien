<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCelularOtroTelefonoToEmpleadoBeneficiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleado_beneficiarios', function (Blueprint $table) {
            $table->string('celular')->nullable();
            $table->string('telefono_2')->nullable();
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
