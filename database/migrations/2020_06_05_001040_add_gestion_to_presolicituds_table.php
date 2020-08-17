<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGestionToPresolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presolicituds', function (Blueprint $table) {
            //
            $table->string('gestion')->nullable();
            $table->date('fecha_gestion')->nullable();
            $table->date('fecha_gestion_sig')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('presolicituds', function (Blueprint $table) {
            //
        });
    }
}
