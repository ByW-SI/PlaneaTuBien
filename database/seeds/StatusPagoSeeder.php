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
        $status = array(
            array('nombre'=>'Aprobado'),
            array('nombre'=>'Revision'),
            array('nombre'=>'Rechazado')
        );
        StatusPago::insert($status);
    }
}
