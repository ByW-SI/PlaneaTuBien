<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupoPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_plan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('grupo_id')->index();
            $table->unsignedInteger('plan_id')->index();
            $table->foreign('grupo_id')->references('id')->on('grupos');
            $table->foreign('plan_id')->references('id')->on('plans');
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
        Schema::table('grupo_plan', function (Blueprint $table) {
            $table->dropForeign(['grupo_id']);
            $table->dropForeign(['plan_id']);
        });
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('grupo_plan');
    }
}
