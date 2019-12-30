<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositosEfectivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depositos_efectivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dia');
            $table->text('concepto')->nullable();
            $table->decimal('cargo',9,2)->nullable();
            $table->decimal('abono',9,2)->nullable();
            $table->decimal('saldo',9,2)->nullable();
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
        Schema::dropIfExists('depositos_efectivos');
    }
}
