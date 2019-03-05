<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilHistorialCrediticioClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_historial_crediticio_clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('perfil_id');
            $table->foreign('perfil_id')->references('id')->on('perfil_datos_personal_clientes');
            $table->boolean('tarjeta_debito')->default(false);
            $table->boolean('tarjeta_credito')->default(false);
            $table->string('numero_tarjeta_debito')->default('0');
            $table->string('numero_tarjeta_credito')->default('0');
            // TARJETAS
            $table->boolean('td_bancomer')->default(false);
            $table->boolean('tc_bancomer')->default(false);
            $table->boolean('td_santander')->default(false);
            $table->boolean('tc_santander')->default(false);
            $table->boolean('td_hsbc')->default(false);
            $table->boolean('tc_hsbc')->default(false);
            $table->boolean('tc_amex')->default(false);
            $table->boolean('td_scotiabank')->default(false);
            $table->boolean('tc_scotiabank')->default(false);
            $table->boolean('td_banamex')->default(false);
            $table->boolean('tc_banamex')->default(false);
            $table->boolean('td_banorte')->default(false);
            $table->boolean('tc_banorte')->default(false);

            $table->boolean('en_buro_credito');
            $table->string('buro_credito')->nullable();
            $table->decimal('limite_credito',10,2)->nullable();
            $table->string('destino_1');
            $table->string('tipo_destino_1');
            $table->decimal('monto_destino_1',10,2);
            $table->string('destino_2')->nullable();
            $table->string('tipo_destino_2')->nullable();
            $table->decimal('monto_destino_2',10,2)->nullable();
            $table->string('destino_3')->nullable();
            $table->string('tipo_destino_3')->nullable();
            $table->decimal('monto_destino_3',10,2)->nullable();
            $table->string('calificacion_credito');
            $table->text('descripcion_calificacion')->nullable();
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
        Schema::dropIfExists('perfil_historial_crediticio_clientes');
    }
}
