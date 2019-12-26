<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PerfilsTableSeeder::class,
            ModulosTableSeeder::class,
            ComponentesTableSeeder::class,
            ComponentePerfilTableSeeder::class,
            EmpleadosTableSeeder::class,
            UsersTableSeeder::class,
            SucursalsTableSeeder::class,
            TipoContratoSeeder::class,
            TipoJornadaSeeder::class,
            BancosSeeder::class,
            EstatusProspectoSeeder::class
        ]);
    }
}
