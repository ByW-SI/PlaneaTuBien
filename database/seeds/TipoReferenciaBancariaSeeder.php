<?php

use Illuminate\Database\Seeder;
use App\TipoReferenciaBancaria;

class TipoReferenciaBancariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposReferenciaBancaria = array (
        	array('nombre' => 'Tarjeta de crédito', 'codigo' => 'TC'),
            array('nombre' => 'Tarjeta de debito', 	'codigo' => 'TD'),
            array('nombre' => 'Chequera',    		'codigo' => 'CH'),
        );

        TipoReferenciaBancaria::insert($tiposReferenciaBancaria);
    }
}
