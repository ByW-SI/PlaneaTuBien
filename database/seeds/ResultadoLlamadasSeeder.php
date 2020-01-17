<?php

use Illuminate\Database\Seeder;
use App\ResultadoLlamada;

class ResultadoLlamadasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resultadoLlamadas = array (
        	array('nombre' => 'No contesta',     	'codigo' => 'NC'),
            array('nombre' => 'Dato Falso',      	'codigo' => 'DF'),
            array('nombre' => 'Deje Recado',     	'codigo' => 'DR'),
            array('nombre' => 'Volver a llamar', 	'codigo' => 'VLL'),
            array('nombre' => 'Contestadora',    	'codigo' => 'DRC'),
            array('nombre' => 'Ocupado', 		 	'codigo' => 'OC'),
            array('nombre' => 'No interesa', 	 	'codigo' => 'NI'),
            array('nombre' => 'Dato repetido', 	 	'codigo' => 'REP'),
            array('nombre' => 'Cita Calificada', 	'codigo' => 'CTQ'),
            array('nombre' => 'Cita No Calificada', 'codigo' => 'CTNQ'),
            array('nombre' => 'No cubre con perfil','codigo' => 'NQ'),
            array('nombre' => 'Cita pendiente',     'codigo' => 'CP'),
        );

        ResultadoLlamada::insert($resultadoLlamadas);
    }
}
