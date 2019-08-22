<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensualidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensualidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contrado_id')->unsigned();
            $table->integer('num_mes')->unsigned();
            $table->integer('cantidad');
            $table->date('fecha');
            $table->integer('recargo');
            $table->boolean('pagado')->default(0);
            $table->timestamps();

            $table->foreign('contrado_id')->references('id')->on('contratos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensualidades');
    }
}
