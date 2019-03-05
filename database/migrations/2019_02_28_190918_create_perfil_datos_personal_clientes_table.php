<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilDatosPersonalClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_datos_personal_clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('prospecto_id');
            $table->foreign('prospecto_id')->references('id')->on('prospectos');
            $table->unsignedInteger('cotizacion_id');
            $table->foreign('cotizacion_id')->references('id')->on('cotizacions');

            // ASESOR
            $table->unsignedInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->string('folio');
            $table->date('fecha');
            $table->string('clave');
            $table->string('plan');
            // 1.- PROSPECTO 2.-SU PAREJA (CASADO O UNION LIBRE)
            $table->string('prefix_1');
            $table->string('prefix_2')->nullable();
            $table->string('nombre_completo_1');
            $table->string('nombre_completo_2')->nullable();
            $table->string('ocupacion_1');
            $table->string('ocupacion_2')->nullable();
            $table->string('empresa_1');
            $table->string('empresa_2')->nullable();
            $table->string('antiguedad_1');
            $table->string('antiguedad_2')->nullable();
            $table->string('salario_1');
            $table->string('salario_2')->nullable();
            $table->string('rfc_1');
            $table->string('rfc_2')->nullable();
            $table->string('nacionalidad_1');
            $table->string('nacionalidad_2')->nullable();

            // DATOS DEL PROSPECTO

            $table->string('estado_civil');
            // Regimen matrimonial solo si estado civil == casado
            $table->string('regimen_matrimonial')->nullable();
            $table->text('direccion');
            $table->string('telefono_casa');
            $table->string('telefono_celular');
            $table->string('telefono_oficina')->nullable();
            $table->string('email');
            $table->string('tipo_residencia');
            $table->unsignedInteger('habitantes');
            $table->string('duenio_residencia');
            $table->decimal('costo_residencia',10,2);
            $table->string('tiempo_viviendo');
            $table->boolean('hijos');
            $table->unsignedInteger('numero_hijos')->nullable();
            $table->boolean('dependientes_economicos');
            $table->unsignedInteger('numero_dependientes')->nullable();
            $table->decimal('ingresos_extras',10,2)->nullable();
            $table->decimal('ingreso_total',10,2);
            $table->boolean('ahorro_inicial');
            $table->string('forma_ahorro')->nullable();
            $table->boolean('ahorra');
            $table->decimal('ahorros')->nullable();
            $table->string('tipo_ahorro');
            $table->boolean('otro_participante');
            $table->string('participante')->nullable();
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
        Schema::dropIfExists('perfil_datos_personal_clientes');
    }
}
