<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResponsableToSeguimientoLlamadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seguimiento_llamadas', function (Blueprint $table) {
            $table->unsignedInteger('responsable_id')->nullable();
            $table->foreign('responsable_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seguimiento_llamadas', function (Blueprint $table) {
            $table->dropColumn('responsable_id');
        });
    }
}
