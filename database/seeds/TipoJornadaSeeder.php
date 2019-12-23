<?php

use Illuminate\Database\Seeder;
use App\TipoJornada;

class TipoJornadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jornadas = array (
        	array('nombre' => 'Diurna', 'codigo' => '01'),
        	array('nombre' => 'Nocturna', 'codigo' => '02'),
        	array('nombre' => 'Mixta', 'codigo' => '03'),
        	array('nombre' => 'Por hora', 'codigo' => '04'),
        	array('nombre' => 'Reducida', 'codigo' => '05'),
        	array('nombre' => 'Continuada', 'codigo' => '06'),
        	array('nombre' => 'Partida', 'codigo' => '07'),
        	array('nombre' => 'Por turnos', 'codigo' => '08'),
        	array('nombre' => 'Otra jornada', 'codigo' => '99'),
        );

        TipoJornada::insert($jornadas);
    }
}
