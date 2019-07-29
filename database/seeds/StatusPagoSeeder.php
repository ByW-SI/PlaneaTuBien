<?php

use App\StatusPago;
use Illuminate\Database\Seeder;

class StatusPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ['nombre'=>'Aprobado', 'nombre'=>'Revisión', 'nombre'=>'Rechazado'];

        StatusPago::create($perfiles);
    }
}
