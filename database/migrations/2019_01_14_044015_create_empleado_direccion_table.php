<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoDireccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleadodireccions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('id_empleado')->unsigned();
            $table->foreign('id_empleado')->references('id')->on('empleados');

            $table->string('calle');
            $table->string('exterior');
            $table->string('interior');
            $table->string('colonia');
            $table->string('delegacion');
            $table->string('estado');
            $table->string('cp');

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
        Schema::dropIfExists('empleadodireccions');
    }
}
