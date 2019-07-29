<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyReportoToEmpleadoFaltaAdministrativaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleado_falta_administrativas', function (Blueprint $table) {
            $table->dropColumn('reporto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleado_falta_administrativas', function (Blueprint $table) {
            $table->string('reporto')->nullable();
        });
    }
}
