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

        Empleado::create([
            'tipo' => 'Admin',
            'nombre' => 'Dummy',
            'paterno' => 'Dummy',
            'email' => 'admin@planea.com',
        ]);

        // Empleado::create([
        //     'tipo' => 'Asesor',
        //     'cargo' => 'Asesor',
        //     'puesto' => 'Asesor',
        //     'nombre' => 'Sandra',
        //     'paterno' => 'Gutierrez',
        //     'materno' => 'Campuzano',
        //     'fecha_nacimiento' => '1989/02/20',
        //     'sexo' => 'Mujer',
        //     'email' => 'sandy@planea.com',
        //     'sucursal_id' => 1,
        //     'id_jefe' => 1,
        //     'edad' => 29,
        // ]);
    }
}
