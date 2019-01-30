<?php

use App\Empleado;
use Illuminate\Database\Seeder;

class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $empleado = [
            'tipo' => 'Admin',
        	'nombre' => 'Dummy',
            'paterno' => 'Dummy',
            'email' => 'admin@planea.com',
        ];

        Empleado::create($empleado);

    }
}
