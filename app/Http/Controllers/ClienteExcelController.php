<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Cotizacion;
use App\Grupo;
use App\PagoInscripcion;
use App\PerfilDatosPersonalCliente;
use App\PerfilReferenciaPersonalCliente;
use App\Presolicitud;
use App\Prospecto;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date as Dater;

class ClienteExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clienteexcel');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        Las tablas a llenar son las de 
        * [*] prospectos  -> primeros datos del cliente
        * [*] presolicitud -> datos del cliente de acuerdo a lo que pidio
        * [*] pago_inscripcions ->el pago de la incsripcion de acuerdo a la cotizacion (se tendria que quedar sin cotizacion)
        * [*] perfil_datos_personal_clientes -> datos redundantes del prospectos ya cuando se tiene su pago de inscripcion
        * [ ] perfil_historial_crediticio_clientes -> datos crediticios del cliente (creo que estos no vienen en el excel)
        * [ ] perfil_inmueble_pretendido_cleintes -> datos del inmueble que pretende comprar (creo que no vienen en el excel)
        * [*] perfil_referencia_personal_clientes -> datos de las referencias del cliente estas si vienen 
        */
        if ($request->hasFile('excel_file')) {
            ini_set('memory_limit', '-1');
            $rows = \Excel::toArray(null, request()->file('excel_file'))[0];
            // dd($rows);
            foreach ($rows as $key => $row) {
                if ($key >= 2) {

                    $prospecto = $this->createProspecto($row);
                    $perfil_dato_personal_cliente = $this->createPerfilDatoPersonalCliente($row, $prospecto);
                    $presolicitud = $this->createPresolicitud($row);
                    // dd($presolicitud);
                    $inscripcion = $this->createPagosInscripcion($row, $prospecto);
                    $this->createPerfilReferenciaPersonalCliente($row, $perfil_dato_personal_cliente);
                    $grupo = $this->createGrupo($row);
                    $this->createContrato($row,$grupo,$presolicitud);

                }
            }
            dd('PDPC CREADO');
        }
        return "Fallo";
        //return redirect()->route('excelpagos')->with('status', "Se cargo correctamente el archivo.");
    }

    public function createProspecto($row)
    {
        $apellidos = explode(" ", $row[3]);

        $nombre = strtolower(explode(" ", $row[3])[0]);
        $nombre = DB::connection()->getPdo()->quote(utf8_encode($nombre));
        $appaterno = strtolower($apellidos[count($apellidos) - 2]);
        $appaterno = DB::connection()->getPdo()->quote(utf8_encode($appaterno));
        $apmaterno = strtolower($apellidos[count($apellidos) - 1]);
        $apmaterno = $apmaterno = DB::connection()->getPdo()->quote(utf8_encode($apmaterno));
        $sexo = $row[65] ? $row[65] : "-";
        $email = $row[61] ? $row[61] : "-";
        $monto = $row[37] ? $row[37] : 0;
        $plan = $row[0] ? $row[0] : '-';
        $sueldo = $row[72] ? $row[72] : 0;
        $gastos = 0; // no se encuentra
        $ahorro = 0; // no se encuentra


        // dd($email);
        // dd( explode(" ",$row[3])[0] );
        $prospecto = Prospecto::firstOrCreate([
            "nombre" => $nombre,
            "appaterno" => $appaterno,
            "apmaterno" => $apmaterno,
            "sexo" => $sexo,
            "email" => $email,
            "monto" => $monto,
            "plan" => $plan,
            "sueldo" => $sueldo,
            "gastos" => $gastos,
            "ahorro" => $ahorro
        ]);

        return $prospecto;
    }

    public function createPresolicitud($row, $perfil_dato_personal_cliente)
    {

        $apellidos = explode(" ", $row[3]);

        $perfil_id = $perfil_dato_personal_cliente->id;
        $folio = $row[12] ? $row[12] : '-';
        $precio_inicial = 0; // No aparece en el excel (monto total contratado)
        $plazo_contratado = $row[9] ? $row[9] : '-';
        $plan = $row[0] ? $row[0] : '-';
        $paterno = strtolower($apellidos[count($apellidos) - 2]);
        $paterno = DB::connection()->getPdo()->quote(utf8_encode($paterno));
        $materno = strtolower($apellidos[count($apellidos) - 1]);
        $materno = $materno = DB::connection()->getPdo()->quote(utf8_encode($materno));
        $nombre = strtolower(explode(" ", $row[3])[0]);
        $nombre = DB::connection()->getPdo()->quote(utf8_encode($nombre));
        $calle = $row[49] ? $row[49] : '-';
        $numero_ext = $row[50] ? $row[50] : '-';
        $numero_int = "-"; // No se encuentra en el excel
        $colonia = $row[51] ? $row[51] : '-';
        $municipio = $row[53] ? $row[53] : '-';
        $estado = $row[52] ? $row[52] : '-';
        $cp = $row[54] ? $row[54] : '-';
        $rfc = $row[57] ? $row[57] : '-';
        $tel_casa = $row[58] ? $row[58] : '-';
        $tel_celular = $row[60] ? $row[60] : '-';
        $email = $row[61] ? $row[61] : '-';
        // dd(Dater::excelToDateTimeObject($row[62]));
        $fecha_nacimiento =  $row[62] ? Dater::excelToDateTimeObject($row[62]) : Carbon::now();
        $fecha_nacimiento = $fecha_nacimiento->format('Y-m-d');

        $lugar_nacimiento = $row[63] ? $row[63] : '-';
        $nacionalidad = $row[64] ? $row[64] : '-';
        $sexo = $row[65] ? $row[65] : '-';
        $estado_civil = $row[66] ? $row[66] : '-';
        $profesion = $row[67] ? $row[67] : '-';
        $antiguedad_actual = $row[70] ? $row[70] : '-';
        $antiguedad_anterior = $row[71] ? $row[71] : "-";
        $ingreso_mensual = $row[72] ? $row[72] : '-';
        $enterarse = "-"; // No viene en excel

        $presolicitud = Presolicitud::firstOrCreate([
            'perfil_id' => $perfil_id,
            'folio' => strval((int)$folio),
            'precio_inicial' => $precio_inicial,
            'plazo_contratado' => $plazo_contratado,
            'plan' => $plan,
            'paterno' => $paterno,
            'paterno' => $paterno,
            'materno' => $materno,
            'nombre' => $nombre,
            'calle' => $calle,
            'numero_ext' => $numero_ext,
            'numero_int' => $numero_int,
            'colonia' => $colonia,
            'municipio' => $municipio,
            'estado' => $estado,
            'cp' => $cp,
            'rfc' => $rfc,
            'tel_casa' => $tel_casa,
            'tel_celular' => $tel_celular,
            'email' => $email,
            'fecha_nacimiento' => $fecha_nacimiento,
            'lugar_nacimiento' => $lugar_nacimiento,
            'nacionalidad' => $nacionalidad,
            'sexo' => $sexo,
            'estado_civil' => $estado_civil,
            'profesion' => $profesion,
            'antiguedad_actual' => $antiguedad_actual,
            'antiguedad_anterior' => $antiguedad_anterior,
            'ingreso_mensual' => $ingreso_mensual,
            'enterarse' => $enterarse,
        ]);
        return $presolicitud;
    }

    public function createPagosInscripcion($row, $prospecto)
    {

        $apellidos = explode(" ", $row[3]);
        $nombre = strtolower(explode(" ", $row[3])[0]);
        $nombre = DB::connection()->getPdo()->quote(utf8_encode($nombre));
        $appaterno = strtolower($apellidos[count($apellidos) - 2]);
        $appaterno = DB::connection()->getPdo()->quote(utf8_encode($appaterno));
        $apmaterno = strtolower($apellidos[count($apellidos) - 1]);
        $apmaterno = $apmaterno = DB::connection()->getPdo()->quote(utf8_encode($apmaterno));

        // dd($prospecto);
        // dd($cotizacion);

        $pagoInscripcion = PagoInscripcion::firstOrCreate([
            'prospecto_id' => $prospecto->id,
            'cotizacion_id' => null,
            'status' => 'aprobado',
            'monto' => $row[37] ? $row[37] : 0,
            'identificacion' => '-',
            'comprobante' => '-',
            'forma' => $row[40] ? $row[40] : '-',
            'banco' => '-',
            'referencia' => '-',
            'folio' => '-'
        ]);
    }

    public function createPerfilDatoPersonalCliente($row, $prospecto)
    {
        // if(strval((int)$row[12])){
        //     dd(strval((int)$row[12]));
        // }

        $perfil_dato_personal_cliente = PerfilDatosPersonalCliente::create([
            'prospecto_id' => $prospecto->id,
            'folio' => '-', //strval((int)$row[12]),
            'fecha' => $row[13] ? $row[13] : Carbon::now(),
            'plan' => $row[0],
            'paterno_1' => $row[46],
            'materno_1' => $row[47],
            'nombre_1' => $row[48],
            'ocupacion_1' => $row[67],
            'empresa_1' => $row[68],
            'antiguedad_1' => $row[70],
            'salario_1' => $row[72],
            'rfc_1' => $row[57],
            'nacionalidad_1' => $row[64],
            'estado_civil' => $row[66],
            'regimen_matrimonial' => null,
            'calle' => $row[49],
            'numero_ext' => $row[50],
            'numero_int' => null,
            'colonia' => $row[51],
            'municipio' => $row[53],
            'estado' => $row[52],
            'cp' =>  $row[54],
            'telefono_casa' => $row[58],
            'telefono_celular' => $row[60],
            'telefono_oficina' => $row[59],
            'email' => $row[61],
            'tipo_residencia' => null,
            'habitantes' => null,
            'duenio_residencia' => null,
            'costo_residencia' => null,
            'tiempo_viviendo' => null,
            'hijos' => null,
            'numero_hijos' => null,
            'dependientes_economicos' => null,
            'numero_dependientes' => null,
            'ingresos_extras' => null,
            'ingreso_total' => $row[72],
            'ahorro_inicial' => null,
            'forma_ahorro' => null,
            'ahorra' => null,
            'ahorros' => null,
            'tipo_ahorro' => null,
            'otro_participante' => null,
            'participante' => null,
        ]);

        return $perfil_dato_personal_cliente;
    }

    public function createPerfilReferenciaPersonalCliente($row, $perfil_dato_personal_cliente)
    {
        // dd($row[106]);
        $nombres = explode(" ", $row[104]);
        $perfilReferenciaPersonalCliente = PerfilReferenciaPersonalCliente::create([
            "perfil_id" => $perfil_dato_personal_cliente->id,
            "paterno" => count($nombres) >= 3 ? $nombres[0] : null,
            "materno" => count($nombres) >= 3 ? $nombres[1] : null,
            "nombre" => count($nombres) >= 3 ? $nombres[count($nombres) - 1] : null,
            "parentesco" => $row[106],
            "telefono" => $row[105],
            "celular" => null,
        ]);

        $nombres = explode(" ", $row[107]);
        $perfilReferenciaPersonalCliente = PerfilReferenciaPersonalCliente::create([
            "perfil_id" => $perfil_dato_personal_cliente->id,
            "paterno" => count($nombres) >= 3 ? $nombres[0] : null,
            "materno" => count($nombres) >= 3 ? $nombres[1] : null,
            "nombre" => count($nombres) >= 3 ? $nombres[count($nombres) - 1] : null,
            "parentesco" => $row[109],
            "telefono" => $row[108],
            "celular" => null,
        ]);

        $nombres = explode(" ", $row[110]);
        $perfilReferenciaPersonalCliente = PerfilReferenciaPersonalCliente::create([
            "perfil_id" => $perfil_dato_personal_cliente->id,
            "paterno" => count($nombres) >= 3 ? $nombres[0] : null,
            "materno" => count($nombres) >= 3 ? $nombres[1] : null,
            "nombre" => count($nombres) >= 3 ? $nombres[count($nombres) - 1] : null,
            "parentesco" => $row[112],
            "telefono" => $row[111],
            "celular" => null,
        ]);
    }

    public function createGrupo($row)
    { 
        $grupo = Grupo::firstOrCreate([
            'id'=>16,
            'fecha_inicio' =>'2019-05-23', 
            'fecha_fin' =>'2034-05-22',
            'vigencia' =>180,
            'contratos' =>500,
        ]);

        // dd($grupo);
        return $grupo;
    }

    public function createContrato($row, $grupo,$presolicitud){

        // $grupo = Grupo::firstOrCreate([
        //     'id'=>16,
        // ]);

        // dd($grupo->id.str_pad($row[1],3,"0",STR_PAD_LEFT));
            // dd(strval($grupo->id));
            // dd(strval($grupo->id).str_pad(strval($row[1]),3,"0",STR_PAD_LEFT));
            // dd(strval($row[1]));

            $num_con = strval($grupo->id).str_pad(strval($row[1]),3,"0",STR_PAD_LEFT);

            // dd($num_con);

        $contrato = Contrato::firstOrCreate([
            // echo str_pad($input, 10, "-=", STR_PAD_LEFT);  // produce "-=-=-Alien"
            "numero_contrato"=>$num_con,
            "monto"=>$row[8] ? $row[8] : 0,
            "estado"=>'-',
            "grupo_id"=>$grupo->id,
            "presolicitud_id"=>$presolicitud->id,
        ]);

            // dd($contrato);

        return $contrato;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
