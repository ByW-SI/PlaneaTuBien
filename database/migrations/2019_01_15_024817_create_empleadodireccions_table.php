<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadodireccionsTable extends Migration
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

            $table->integer('empleado_id')->unsigned();
            $table->foreign('empleado_id')->references('id')->on('empleados');

            $table->string('calle');
            $table->string('interior');
            $table->string('exterior');
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
