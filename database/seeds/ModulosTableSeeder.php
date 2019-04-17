<?php

use App\Modulo;
use Illuminate\Database\Seeder;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$modulos = array(                         // id
    		array('nombre' => 'seguridad'),       // 1
            array('nombre' => 'prospectos'),      // 2
            array('nombre' => 'agentes'),         // 3
            array('nombre' => 'rh'),              // 4
            array('nombre' => 'crm'),             // 5
            array('nombre' => 'sucursales'),      // 6
            array('nombre' => 'precargas'),       // 7
            array('nombre' => 'promociones'),     // 8
            array('nombre' => 'planes'),          // 9
            array('nombre' => 'grupos'),          // 10
    	);

    	Modulo::insert($modulos);
    }
}
