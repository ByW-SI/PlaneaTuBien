<?php

use Illuminate\Database\Seeder;
use App\TipoContrato;

class TipoContratoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contratos = array (
        	array('nombre' => 'Contrato de trabajo por tiempo indeterminado', 'descripcion' => NULL, 'codigo' => '01'),
        	array('nombre' => 'Contrato de trabajo para obra determinada', 'descripcion' => NULL, 'codigo' => '02'),
        	array('nombre' => 'Contrato de trabajo por tiempo determinado', 'descripcion' => NULL, 'codigo' => '03'),
        	array('nombre' => 'Contrato de trabajo por temporada', 'descripcion' => NULL, 'codigo' => '04'),
        	array('nombre' => 'Contrato de trabajo sujeto a prueba', 'descripcion' => NULL, 'codigo' => '05'),
        	array('nombre' => 'Contrato de trabajo con capacitación inicial', 'descripcion' => NULL, 'codigo' => '06'),
        	array('nombre' => 'Modalidad de contratación por pago de hora laborada', 'descripcion' => NULL, 'codigo' => '07'),
        	array('nombre' => 'Modalidad de trabajo por comisión laboral', 'descripcion' => NULL, 'codigo' => '08'),
        	array('nombre' => 'Modalidades de contratación donde no existe relación de trabajo', 'descripcion' => NULL, 'codigo' => '09'),
        	array('nombre' => 'Jubilación, pensión, retiro', 'descripcion' => NULL, 'codigo' => '10'),
        	array('nombre' => 'Otro contrato', 'descripcion' => NULL, 'codigo' => '99'),
        );

        TipoContrato::insert($contratos);
    }
}
