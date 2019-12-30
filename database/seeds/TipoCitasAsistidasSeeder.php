<?php

use Illuminate\Database\Seeder;
use App\TipoCitasAsistidas;

class TipoCitasAsistidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposCitaAsistida = array (
        	array('nombre' => 'Las citas que asisten a la sucursal', 'codigo' => "UP'S"),
            array('nombre' => 'Cita que cubre todos los requisitos', 'codigo' => 'Q'),
            array('nombre' => 'Cita que no cubre los requisitos', 	 'codigo' => 'NQ'),
            array('nombre' => 'Cita que asistió a la sala y no recibio la Asesoría completa.', 'codigo' => 'NT'),
        );

        TipoCitasAsistidas::insert($tiposCitaAsistida);
    }
}
