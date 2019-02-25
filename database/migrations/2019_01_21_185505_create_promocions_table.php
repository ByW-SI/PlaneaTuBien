<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->decimal('monto',8,2);
            $table->string('tipo_monto');
            $table->string('tipo_promo');
            $table->date('valido_inicio');
            $table->date('valido_fin');
            $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('promocions');
    }
}
