<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('abreviatura')->nullable();
            $table->unsignedInteger('plazo')->nullable();
            $table->unsignedInteger('mes_aportacion_adjudicado')->nullable();
            $table->unsignedInteger('mes_adjudicado')->nullable();
            $table->unsignedInteger('mes_s_d')->nullable();
            $table->unsignedInteger('plan_meses')->nullable();
            $table->unsignedInteger('actualizaciones')->nullable()->default(0);
            $table->decimal('aportacion_1',5,2)->nullable()->default(0.00);
            $table->unsignedInteger('mes_1')->nullable();
            $table->decimal('aportacion_2',5,2)->nullable()->default(0.00);
            $table->unsignedInteger('mes_2')->nullable();
            $table->decimal('aportacion_3',5,2)->nullable()->default(0.00);
            $table->unsignedInteger('mes_3')->nullable();
            $table->decimal('aportacion_liquidacion',5,2)->nullable()->default(0.00);
            $table->unsignedInteger('mes_liquidacion')->nullable();
            $table->decimal('semestral',5,2)->nullable()->default(0.00);
            $table->decimal('anual',5,2)->nullable()->default(0.00);
            $table->decimal('inscripcion',5,2)->nullable()->default(0.00);
            $table->decimal('cuota_admon',5,2)->nullable()->default(0.00);
            $table->decimal('s_v',5,2)->nullable()->default(0.00);
            $table->decimal('s_d',5,2)->nullable()->default(0.00);
            $table->boolean('baja')->nullable()->default(0);
            $table->boolean('clasica')->nullable()->default(0);
            $table->string('tipo');
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
        Schema::dropIfExists('plans');
    }
}
