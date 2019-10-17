<?php

namespace App\Http\Controllers;

use App\Classes\Services\PruebaService;
use App\Contrato;
use App\Mensualidad;
use App\Pagos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Console\Commands\UpdateMensualidades;
use App\Empleado;
use App\TipoContrato;
use App\TipoJornada;

class PruebasController extends Controller
{
    public function index()
    {
        TipoContrato::truncate();

        TipoContrato::create([
            'nombre' => 'Contrato de trabajo por tiempo indeterminado',
            'codigo' => '01'
        ]);

        TipoContrato::create([
            'nombre' => 'Contrato de trabajo para obra determinada',
            'codigo' => '02'
        ]);

        TipoContrato::create([
            'nombre' => 'Contrato de trabajo por tiempo determinado',
            'codigo' => '03'
        ]);

        TipoContrato::create([
            'nombre' => 'Contrato de trabajo por temporada',
            'codigo' => '04'
        ]);

        TipoContrato::create([
            'nombre' => 'Contrato de trabajo sujeto a prueba',
            'codigo' => '05'
        ]);

        TipoContrato::create([
            'nombre' => 'Contrato de trabajo con capacitación inicial',
            'codigo' => '06'
        ]);

        TipoContrato::create([
            'nombre' => 'Modalidad de contratación por pago de hora laborada',
            'codigo' => '07'
        ]);

        TipoContrato::create([
            'nombre' => 'Modalidad de trabajo por comisión laboral',
            'codigo' => '08'
        ]);

        TipoContrato::create([
            'nombre' => 'Modalidades de contratación donde no existe relación de trabajo',
            'codigo' => '09'
        ]);

        TipoContrato::create([
            'nombre' => 'Jubilación, pensión, retiro',
            'codigo' => '10'
        ]);

        TipoContrato::create([
            'nombre' => 'Otro contrato',
            'codigo' => '99'
        ]);


        // JORNADAS

        TipoJornada::truncate();

        TipoJornada::create([
            'nombre' => 'Diurna',
            'codigo' => '01',
        ]);

        TipoJornada::create([
            'nombre' => 'Nocturna',
            'codigo' => '02',
        ]);

        TipoJornada::create([
            'nombre' => 'Mixta',
            'codigo' => '03',
        ]);

        TipoJornada::create([
            'nombre' => 'Por hora',
            'codigo' => '04',
        ]);
        
        TipoJornada::create([
            'nombre' => 'Reducida',
            'codigo' => '05',
        ]);

        TipoJornada::create([
            'nombre' => 'Continuada',
            'codigo' => '06',
        ]);

        TipoJornada::create([
            'nombre' => 'Partida',
            'codigo' => '07',
        ]);

        TipoJornada::create([
            'nombre' => 'Por turnos',
            'codigo' => '08',
        ]);

        TipoJornada::create([
            'nombre' => 'Otra jornada',
            'codigo' => '09',
        ]);

        return TipoJornada::get();

    }
}
