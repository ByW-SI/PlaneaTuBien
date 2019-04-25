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
            $table->string('nombre');
            $table->string('abreviatura');
            $table->unsignedInteger('plazo');
            $table->unsignedInteger('mes_aportacion_adjudicado');
            $table->unsignedInteger('mes_adjudicado');
            $table->unsignedInteger('mes_completo_adjudicado');
            $table->unsignedInteger('plan_meses');
            $table->unsignedInteger('actualizaciones')->default(0);
            $table->decimal('aportacion_1',5,2)->default(0.00);
            $table->unsignedInteger('mes_1');
            $table->decimal('aportacion_2',5,2)->default(0.00);
            $table->unsignedInteger('mes_2');
            $table->decimal('aportacion_3',5,2)->default(0.00);
            $table->unsignedInteger('mes_3');
            $table->decimal('aportacion_liquidacion',5,2)->default(0.00);
            $table->unsignedInteger('mes_liquidacion');
            $table->decimal('semestral',5,2)->default(0.00);
            $table->decimal('anual',5,2)->default(0.00);
            $table->decimal('inscripcion',5,2)->default(0.00);
            $table->decimal('cuota_admon',5,2)->default(0.00);
            $table->decimal('s_v',5,2)->default(0.00);
            $table->decimal('s_d',5,2)->default(0.00);
            $table->boolean('baja')->default(0);
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
