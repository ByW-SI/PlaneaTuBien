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
        	array('nombre' => 'No calificadp'),
        	array('nombre' => 'Cita Confirmada'),
        	array('nombre' => 'Reagendar cita'),
        	array('nombre' => 'No califica'),
        	array('nombre' => 'Cotizando'),
        	array('nombre' => 'Pagos'),
        );

        EstatusProspecto::insert($estatusProspectos);
    }
}
