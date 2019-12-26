<?php

use Illuminate\Database\Seeder;
use App\Banco;

class BancosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bancos = array (
        	array('nombre' => 'Banamex', 'etiqueta' => 'BNX'),
        	array('nombre' => 'Bancomer', 'etiqueta' => 'BC'),
        	array('nombre' => 'Santander', 'etiqueta' => 'STD'),
        	array('nombre' => 'American Express', 'etiqueta' => 'AMEX'),
        	array('nombre' => 'Scotia Bank', 'etiqueta' => 'SCB'),
        );

        Banco::insert($bancos);
    }
}
