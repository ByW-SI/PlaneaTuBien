<?php

use Illuminate\Database\Seeder;
use App\TipoSituacionInmobiliaria;

class TipoSituacionInmobiliariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposSituacionInmobiliaria = array (
        	array('nombre' => 'Propia',     'codigo' => 'PR'),
            array('nombre' => 'Renta',      'codigo' => 'RNT'),
            array('nombre' => 'Familiares', 'codigo' => 'FAM'),
        );

        TipoSituacionInmobiliaria::insert($tiposSituacionInmobiliaria);
    }
}
