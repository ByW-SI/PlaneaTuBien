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
            $table->unsignedInteger('cotizacion_id')->nullable();
            $table->foreign('cotizacion_id')->references('id')->on('cotizacions');

            // ASESOR
            $table->unsignedInteger('empleado_id')->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados');
            $table->string('folio')->nullable();
            $table->date('fecha')->nullable();
            $table->string('clave')->nullable();
            $table->string('plan')->nullable();

            // 1.- PROSPECTO
            $table->string('prefijo_1')->nullable();
            $table->string('paterno_1')->nullable();
            $table->string('materno_1')->nullable();
            $table->string('nombre_1')->nullable();
            $table->string('ocupacion_1')->nullable();
            $table->string('empresa_1')->nullable();
            $table->string('antiguedad_1')->nullable();
            $table->string('salario_1')->nullable();
            $table->string('rfc_1')->nullable();
            $table->string('nacionalidad_1')->nullable();

            // 2.- PAREJA (SI ES QUE TIENE)
            $table->string('prefijo_2')->nullable();
            $table->string('paterno_2')->nullable();
            $table->string('materno_2')->nullable();
            $table->string('nombre_2')->nullable();
            $table->string('ocupacion_2')->nullable();
            $table->string('empresa_2')->nullable();
            $table->string('antiguedad_2')->nullable();
            $table->string('salario_2')->nullable();
            $table->string('rfc_2')->nullable();
            $table->string('nacionalidad_2')->nullable();

            // DATOS DEL PROSPECTO
            $table->string('estado_civil')->nullable();
            // Regimen matrimonial solo si estado civil == casado
            $table->string('regimen_matrimonial')->nullable();

            // DIRECCION
            $table->string('calle')->nullable();
            $table->string('numero_ext')->nullable();
            $table->string('numero_int')->nullable();
            $table->string('colonia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('estado')->nullable();
            $table->string('cp')->nullable();

            // TELEFONOS
            $table->string('telefono_casa')->nullable();
            $table->string('telefono_celular')->nullable();
            $table->string('telefono_oficina')->nullable();
            // EMAILL
            $table->string('email')->nullable();
            
            $table->string('tipo_residencia')->nullable();
            $table->unsignedInteger('habitantes')->nullable();
            $table->string('duenio_residencia')->nullable();
            $table->decimal('costo_residencia',10,2)->nullable();
            $table->string('tiempo_viviendo')->nullable();
            $table->boolean('hijos')->nullable();
            $table->unsignedInteger('numero_hijos')->nullable();
            $table->boolean('dependientes_economicos')->nullable();
            $table->unsignedInteger('numero_dependientes')->nullable();
            $table->decimal('ingresos_extras',10,2)->nullable();
            $table->decimal('ingreso_total',10,2)->nullable();
            $table->boolean('ahorro_inicial')->nullable();
            $table->string('forma_ahorro')->nullable();
            $table->boolean('ahorra')->nullable();
            $table->decimal('ahorros')->nullable();
            $table->string('tipo_ahorro')->nullable();
            $table->boolean('otro_participante')->nullable();
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
