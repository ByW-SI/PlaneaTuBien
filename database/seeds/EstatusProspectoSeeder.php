<?php

use Illuminate\Database\Seeder;
use App\EstatusProspecto;

class EstatusProspectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estatusProspectos = array (
        	array('nombre' => 'Seguimiento Llamada'),
        	array('nombre' => 'Pendiente'),
        	array('nombre' => 'Cita'),
        	array('nombre' => 'Cita Confirmada'),
        	array('nombre' => 'No calificado'),
        	array('nombre' => 'Reagendar cita'),
        	array('nombre' => 'No califica'),
        	array('nombre' => 'Cotizando'),
        	array('nombre' => 'Pagos'),
        	array('nombre' => 'Cita Cancelada'),
        	array('nombre' => 'Volver A Llamar'),
        	array('nombre' => 'Cita Pendiente Reprogramar'),
        );

        EstatusProspecto::insert($estatusProspectos);
    }
}
