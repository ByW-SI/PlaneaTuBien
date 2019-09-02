<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyNullabilityToPerfilDatosPersonalClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perfil_datos_personal_clientes', function (Blueprint $table) {
            $table->integer('cotizacion_id')->unsigned()->nullable()->change();
            $table->integer('empleado_id')->unsigned()->nullable()->change();
            $table->string('folio')->nullable()->change();
            $table->date('fecha')->nullable()->change();
            $table->string('clave')->nullable()->change();
            $table->string('plan')->nullable()->change();
            $table->string('prefijo_1')->nullable()->change();
            $table->string('paterno_1')->nullable()->change();
            $table->string('materno_1')->nullable()->change();
            $table->string('nombre_1')->nullable()->change();
            $table->string('ocupacion_1')->nullable()->change();
            $table->string('empresa_1')->nullable()->change();
            $table->string('antiguedad_1')->nullable()->change();
            $table->string('salario_1')->nullable()->change();
            $table->string('rfc_1')->nullable()->change();
            $table->string('nacionalidad_1')->nullable()->change();
            $table->string('estado_civil')->nullable()->change();
            $table->string('calle')->nullable()->change();
            $table->string('numero_ext')->nullable()->change();
            $table->string('colonia')->nullable()->change();
            $table->string('municipio')->nullable()->change();
            $table->string('estado')->nullable()->change();
            $table->string('cp')->nullable()->change();
            $table->string('telefono_casa')->nullable()->change();
            $table->string('telefono_celular')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('tipo_residencia')->nullable()->change();
            $table->integer('habitantes')->nullable()->change();
            $table->string('duenio_residencia')->nullable()->change();
            $table->decimal('costo_residencia',10,2)->nullable()->change();
            $table->string('tiempo_viviendo')->nullable()->change();
            $table->integer('hijos')->nullable()->change();
            $table->integer('dependientes_economicos')->nullable()->change();
            $table->decimal('ingreso_total',10,2)->nullable()->change();
            $table->integer('ahorro_inicial')->nullable()->change();
            $table->integer('ahorra')->nullable()->change();
            $table->decimal('otro_participante')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perfil_datos_personal_clientes', function (Blueprint $table) {
            //
        });
    }
}
