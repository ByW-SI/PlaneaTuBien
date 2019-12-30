<?php

use Illuminate\Database\Seeder;
use App\TipoMedio;

class TipoMedioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposMedios = array (
        	array('nombre' => 'Radio', 		   'codigo' => 'R'),
            array('nombre' => 'Prensa', 	   'codigo' => 'P'),
            array('nombre' => 'Television',    'codigo' => 'TV'),
            array('nombre' => 'Mail', 		   'codigo' => 'M'),
            array('nombre' => 'Stand', 		   'codigo' => 'S'),
            array('nombre' => 'Volante', 	   'codigo' => 'V'),
            array('nombre' => 'Exposición',    'codigo' => 'E'),
            array('nombre' => 'Referido',	   'codigo' => 'RF'),
            array('nombre' => 'Base de Datos', 'codigo' => 'BD'),
            array('nombre' => 'Pendones', 	   'codigo' => 'PD'),
            array('nombre' => 'Manta', 		   'codigo' => 'MT'),
            array('nombre' => 'Otro', 		   'codigo' => 'O'),
        );

        TipoMedio::insert($tiposMedios);
    }
}
