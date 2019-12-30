<?php

use Illuminate\Database\Seeder;
use App\TipoResultadoConfirmacionCita;

class TipoResultadoConfirmacionCitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposResultadoCita = array (
        	array('nombre' => 'No puede asistir llamar para una nueva cita', 'codigo' => 'NPA/LLPNC'),
            array('nombre' => 'No puede asistir', 	'codigo' => 'NPA'),
            array('nombre' => 'Posible asistencia', 'codigo' => 'PA'),
            array('nombre' => 'Cita reprogramada', 	'codigo' => 'CTR'),
            array('nombre' => 'Confirmo',    		'codigo' => 'CONF'),
        );

        TipoResultadoConfirmacionCita::insert($tiposResultadoCita);
    }
}
