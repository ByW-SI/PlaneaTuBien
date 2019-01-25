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
    	);

    	Modulo::insert($modulos);
    }
}
