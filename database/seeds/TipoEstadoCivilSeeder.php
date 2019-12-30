<?php

use Illuminate\Database\Seeder;
use App\TipoEstadoCivil;

class TipoEstadoCivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposEstadoCivil = array (
        	array('nombre' => 'Casado',     	'codigo' => 'CS'),
            array('nombre' => 'Soltero',      	'codigo' => 'SL'),
            array('nombre' => 'Divorciado (a)', 'codigo' => 'DIV'),
            array('nombre' => 'Viudo (a)', 		'codigo' => 'VID'),
            array('nombre' => 'Union Libre',    'codigo' => 'UL'),
        );

        TipoEstadoCivil::insert($tiposEstadoCivil);
    }
}
