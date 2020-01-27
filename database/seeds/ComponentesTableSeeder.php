<?php

use App\Componente;
use Illuminate\Database\Seeder;

class ComponentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$componentes = array (
            // seguridad
            array('nombre' => 'indice perfiles', 'modulo_id' => 1),
            array('nombre' => 'ver perfil', 'modulo_id' => 1),
            array('nombre' => 'crear perfil', 'modulo_id' => 1),
            array('nombre' => 'editar perfil', 'modulo_id' => 1),
            array('nombre' => 'eliminar perfil', 'modulo_id' => 1),
            array('nombre' => 'indice usuarios', 'modulo_id' => 1),
            array('nombre' => 'ver usuario', 'modulo_id' => 1),
            array('nombre' => 'crear usuario', 'modulo_id' => 1),
            array('nombre' => 'editar usuario', 'modulo_id' => 1),
            array('nombre' => 'eliminar usuario', 'modulo_id' => 1),
            // Prospectos
            array('nombre' => 'indice prospectos', 'modulo_id' => 2),
            array('nombre' => 'ver prospecto', 'modulo_id' => 2),
            array('nombre' => 'crear prospecto', 'modulo_id' => 2),
            array('nombre' => 'alta excel prospecto', 'modulo_id' => 2),
            array('nombre' => 'editar prospecto', 'modulo_id' => 2),
            array('nombre' => 'eliminar prospecto', 'modulo_id' => 2),
            array('nombre' => 'editar cita', 'modulo_id' => 2),
            // Agentes
            array('nombre' => 'indice agentes', 'modulo_id' => 3),
            array('nombre' => 'ver agente', 'modulo_id' => 3),
            array('nombre' => 'crear agente', 'modulo_id' => 3),
            array('nombre' => 'editar agente', 'modulo_id' => 3),
            array('nombre' => 'eliminar agente', 'modulo_id' => 3),
            // RH
            array('nombre' => 'indice recursos humanos', 'modulo_id' => 4),
            array('nombre' => 'ver rh', 'modulo_id' => 4),
            array('nombre' => 'crear rh', 'modulo_id' => 4),
            array('nombre' => 'editar rh', 'modulo_id' => 4),
            array('nombre' => 'eliminar rh', 'modulo_id' => 4),
            // CRM
            array('nombre' => 'indice CRM', 'modulo_id' => 5),
            array('nombre' => 'ver CRM', 'modulo_id' => 5),
            array('nombre' => 'crear CRM', 'modulo_id' => 5),
            array('nombre' => 'editar CRM', 'modulo_id' => 5),
            // sucursales
            array('nombre' => 'indice Sucursales', 'modulo_id' => 6),
            array('nombre' => 'ver sucursal', 'modulo_id' => 6),
            array('nombre' => 'crear sucursal', 'modulo_id' => 6),
            array('nombre' => 'editar sucursal', 'modulo_id' => 6),
            array('nombre' => 'eliminar sucursal', 'modulo_id' => 6),
            // Precargas
            array('nombre' => 'Bancos', 'modulo_id' => 7),
            array('nombre' => 'Tareas', 'modulo_id' => 7),
            array('nombre' => 'Tipo de Promociones', 'modulo_id' => 7),
            array('nombre' => 'Areas', 'modulo_id' => 7),
            array('nombre' => 'Bajas', 'modulo_id' => 7),
            array('nombre' => 'Contratos', 'modulo_id' => 7),
            array('nombre' => 'Puestos', 'modulo_id' => 7),
            // Promociones
            array('nombre' => 'indice promociones', 'modulo_id' => 8),
            array('nombre' => 'crear promocion', 'modulo_id' => 8),
            array('nombre' => 'editar promocion', 'modulo_id' => 8),
            array('nombre' => 'eliminar promocion', 'modulo_id' => 8),
             // Planes
            array('nombre' => 'indice planes', 'modulo_id' => 9),
            array('nombre' => 'ver plan', 'modulo_id' => 9),
            array('nombre' => 'crear plan', 'modulo_id' => 9),
            array('nombre' => 'editar plan', 'modulo_id' => 9),
             // Grupos
            array('nombre' => 'indice grupos', 'modulo_id' => 10),
            array('nombre' => 'ver grupo', 'modulo_id' => 10),
            array('nombre' => 'crear grupo', 'modulo_id' => 10),
            array('nombre' => 'agregar plan', 'modulo_id' => 10),
             // Pagos
            array('nombre' => 'indice pagos', 'modulo_id' => 11),
            array('nombre' => 'ver pago', 'modulo_id' => 11),
            array('nombre' => 'crear pago', 'modulo_id' => 11),
            array('nombre' => 'asignar pago', 'modulo_id' => 11),
            array('nombre' => 'pagos realizados', 'modulo_id' => 11),
            array('nombre' => 'excel pagos', 'modulo_id' => 11),
    	);

    	Componente::insert($componentes);
    }
}
