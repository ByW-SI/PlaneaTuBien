<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskSendMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_send_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('crm_id');
            $table->foreign('crm_id')->references('id')->on('prospecto_c_r_ms');
            $table->unsignedInteger('cotizacion_id');
            $table->foreign('cotizacion_id')->references('id')->on('cotizacions');
            $table->string('nombre')->default('Enviar cotización por correo');
            $table->boolean('hecho')->default(false);
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
        Schema::dropIfExists('task_send_mails');
    }
}
