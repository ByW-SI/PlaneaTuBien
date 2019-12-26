<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoProspectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_prospecto', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('prospecto_id')->index();
            $table->unsignedInteger('empleado_id')->index();
            $table->foreign('prospecto_id')->references('id')->on('prospectos');
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->boolean('temporal')->default(0);
            $table->boolean('activo')->default(1);
            $table->date('fechaInicioTemporal')->nullable();
            $table->date('fechaFinTemporal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleado_prospecto', function (Blueprint $table) {
            $table->dropForeign(['prospecto_id']);
            $table->dropForeign(['empleado_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('empleado_prospecto');
    }
}
