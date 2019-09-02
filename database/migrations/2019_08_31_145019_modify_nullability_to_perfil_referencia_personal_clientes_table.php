<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyNullabilityToPerfilReferenciaPersonalClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perfil_referencia_personal_clientes', function (Blueprint $table) {
            $table->string('paterno')->nullable()->change();
            $table->string('nombre')->nullable()->change();
            $table->string('parentesco')->nullable()->change();
            $table->string('telefono')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perfil_referencia_personal_clientes', function (Blueprint $table) {
            //
        });
    }
}
