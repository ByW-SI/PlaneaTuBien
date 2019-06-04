<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomiciliacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domiciliacions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contrato_id');
            $table->foreign('contrato_id')->references('id')->on('contratos');
            $table->string('emisor');
            $table->string('referencia')->nullable();
            $table->string('titular');
            $table->string('banco')->nullable();
            $table->string('tipo');
            $table->string('numero');
            $table->decimal('monto',8,2)->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('domiciliacions');
    }
}
