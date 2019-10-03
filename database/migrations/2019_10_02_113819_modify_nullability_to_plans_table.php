<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyNullabilityToPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->boolean('clasica')->nullable()->change();
            $table->boolean('baja')->nullable()->change();
            $table->decimal('s_d')->nullable()->change();
            $table->decimal('s_v')->nullable()->change();
            $table->decimal('cuota_admon')->nullable()->change();
            $table->decimal('inscripcion')->nullable()->change();
            $table->decimal('anual')->nullable()->change();
            $table->decimal('semestral')->nullable()->change();
            $table->integer('mes_liquidacion')->nullable()->change();
            $table->decimal('aportacion_liquidacion')->nullable()->change();
            $table->integer('mes_3')->nullable()->change();
            $table->integer('aportacion_3')->nullable()->change();
            $table->integer('mes_2')->nullable()->change();
            $table->integer('aportacion_2')->nullable()->change();
            $table->integer('mes_1')->nullable()->change();
            $table->integer('aportacion_1')->nullable()->change();
            $table->integer('actualizaciones')->nullable()->change();
            $table->integer('plan_meses')->nullable()->change();
            $table->integer('mes_s_d')->nullable()->change();
            $table->integer('mes_adjudicado')->nullable()->change();
            $table->integer('mes_aportacion_adjudicado')->nullable()->change();
            $table->integer('plazo')->nullable()->change();
            $table->string('abreviatura')->nullable()->change();
            $table->string('nombre')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            //
        });
    }
}
