<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prospecto_id')->unsigned();
            $table->foreign('prospecto_id')->references('id')->on('prospectos');
            $table->date('nacimiento')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('lugar')->nullable();
            $table->string('civil')->nullable();
            $table->string('profesion')->nullable();
            $table->string('empresa')->nullable();
            $table->string('actual')->nullable();
            $table->string('anterior')->nullable();
            $table->string('antiguo')->nullable();
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
        Schema::dropIfExists('documentos');
    }
}
