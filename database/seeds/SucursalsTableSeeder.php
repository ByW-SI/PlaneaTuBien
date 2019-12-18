<?php

use Illuminate\Database\Seeder;
use App\Sucursal;

class SucursalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sucursal = [
        	'nombre' => 'Polanco',
            'abreviatura' => 'POL',
            'calle' => 'Av. Homero',
            'numext' => '229',
            'colonia' => 'Polanco, Polanco V Secc',
            'cp' => '11560',
            'estado' => 'CDMX',
            'delegacion' => 'Miguel Hidalgo'
        ];

        Sucursal::create($sucursal);
    }
}
