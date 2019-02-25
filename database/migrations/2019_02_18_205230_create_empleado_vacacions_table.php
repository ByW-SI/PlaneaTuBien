<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoVacacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado_vacacions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('empleado_id')->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('set null');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('dias_tomados')->nullable();
            $table->string('dias_restantes')->nullable();
            $table->string('periodo1')->nullable();
            $table->string('periodo2')->nullable();
            $table->string('dias_total')->nullable();
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
        Schema::dropIfExists('empleado_vacacions');
    }
}
