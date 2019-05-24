<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodigoPostalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_postals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_postal');
            $table->string('cestado')->nullable();
            $table->string('poblacion')->nullable();
            $table->string('municipio')->nullable();
            $table->string('estado')->nullable();
            $table->unsignedInteger('codigo_municipio');
            $table->string('ciudad')->nullable();
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
        Schema::dropIfExists('codigo_postals');
    }
}
