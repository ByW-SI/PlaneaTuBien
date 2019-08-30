<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\PagoInscripcion;
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
        * prospectos  -> primeros datos del cliente
        * presolicitud -> datos del cliente de acuerdo a lo que pidio
        * pago_inscripcions ->el pago de la incsripcion de acuerdo a la cotizacion (se tendria que quedar sin cotizacion)
        * perfil_datos_personal_clientes -> datos redundantes del prospectos ya cuando se tiene su pago de inscripcion
        * perfil_historial_crediticio_clientes -> datos crediticios del cliente (creo que estos no vienen en el excel)
        * perfil_inmueble_pretendido_cleintes -> datos del inmueble que pretende comprar (creo que no vienen en el excel)
        * perfil_referencia_personal_clientes -> datos de las referencias del cliente estas si vienen 
        */
        if ($request->hasFile('excel_file')) {
            ini_set('memory_limit', '-1');
            $rows = \Excel::toArray(null, request()->file('excel_file'))[0];
            // dd($rows);
            foreach ($rows as $key => $row) {
                if($key >= 2){
                    // dd($row);
                    // $this->createProspecto($row);
                    // $this->createPresolicitud($row);
                    $this->createPagosInscripcion($row);
                }
            }
            dd('Prospectos creados');
        }
        return "Fallo";
        //return redirect()->route('excelpagos')->with('status', "Se cargo correctamente el archivo.");
    }

    public function createProspecto($row){
        $apellidos = explode(" ",$row[3]);

        $nombre = strtolower(explode(" ",$row[3])[0]);
        $nombre= DB::connection()->getPdo()->quote(utf8_encode($nombre));
        $appaterno = strtolower($apellidos[count($apellidos)-2]);
        $appaterno= DB::connection()->getPdo()->quote(utf8_encode($appaterno));
        $apmaterno = strtolower($apellidos[count($apellidos)-1]);
        $apmaterno = $apmaterno= DB::connection()->getPdo()->quote(utf8_encode($apmaterno));
        $sexo = $row[65] ? $row[65] : "-";
        $email = $row[61] ? $row[61] : "-";
        $monto = $row[37] ? $row[37] : 0;
        $plan = $row[0] ? $row[0] : '-';
        $sueldo = 0;
        $gastos = 0;
        $ahorro = 0;


        // dd($email);
        // dd( explode(" ",$row[3])[0] );
        $prospecto = Prospecto::firstOrCreate([
            "nombre"=>$nombre,
            "appaterno"=>$appaterno,
            "apmaterno"=>$apmaterno,
            "sexo"=>$sexo,
            "email"=>$email,
            "monto"=>$monto,
            "plan"=>$plan,
            "sueldo"=>$sueldo,
            "gastos"=>$gastos,
            "ahorro"=>$ahorro
        ]);

        // dd($prospecto);
    }

    public function createPresolicitud($row){

        $apellidos = explode(" ",$row[3]);

        $perfil_id = 1;
        $folio = $row[12] ? $row[12] : '-';
        $precio_inicial = 0;
        $plazo_contratado = $row[9] ? $row[9] : '-';
        $plan = $row[0] ? $row[0] : '-';
        $paterno = strtolower($apellidos[count($apellidos)-2]);
        $paterno= DB::connection()->getPdo()->quote(utf8_encode($paterno));
        $materno = strtolower($apellidos[count($apellidos)-1]);
        $materno = $materno= DB::connection()->getPdo()->quote(utf8_encode($materno));
        $nombre = strtolower(explode(" ",$row[3])[0]);
        $nombre= DB::connection()->getPdo()->quote(utf8_encode($nombre));
        $calle = $row[49] ? $row[49] : '-';
        $numero_ext = $row[50] ? $row[50] : '-';
        $numero_int = "-";
        $colonia = explode(",",$row[4])[2];
        $municipio = explode(",",$row[4])[3];
        $estado = explode(",",$row[4])[4];
        $cp = explode(",",$row[4])[5];
        $rfc = $row[57] ? $row[57] : '-';
        $tel_casa = $row[58] ? $row[58] : '-';
        $tel_celular = $row[60] ? $row[60] : '-';
        $email = $row[61] ? $row[61] : '-';
        // dd(Dater::excelToDateTimeObject($row[62]));
        // $fecha_nacimiento =  $row[62] && !is_float($row[62]) ? Dater::excelToDateTimeObject($row[62]) : null;
        $fecha_nacimiento = null;
        $lugar_nacimiento = $row[63] ? $row[63] : '-';
        $nacionalidad = $row[64] ? $row[64] : '-';
        $sexo = $row[65] ? $row[65] : '-';
        $estado_civil = $row[66] ? $row[66] : '-';
        $profesion = $row[67] ? $row[67] : '-';
        $antiguedad_actual = $row[70] ? $row[70] : '-';
        $antiguedad_anterior = $row[71] ? $row[71] : "-";
        $ingreso_mensual = $row[72] ? $row[72] : '-';
        $enterarse = "-";

        $presolicitud = Presolicitud::firstOrCreate([
            // 'perfil_id'=>3,
            'folio'=>$folio,
            'precio_inicial'=>$precio_inicial,
            'plazo_contratado'=>$plazo_contratado,
            'plan'=>$plan,
            'paterno'=>$paterno,
            'paterno'=>$paterno,
            'materno'=>$materno,
            'nombre'=>$nombre,
            'calle'=>$calle,
            'numero_ext'=>$numero_ext,
            'numero_int'=>$numero_int,
            'colonia'=>$colonia,
            'municipio'=>$municipio,
            'estado'=>$estado,
            'cp'=>$cp,
            'rfc'=>$rfc,
            'tel_casa'=>$tel_casa,
            'tel_celular'=>$tel_celular,
            'email'=>$email,
            'fecha_nacimiento'=>$fecha_nacimiento,
            'lugar_nacimiento'=>$lugar_nacimiento,
            'nacionalidad'=>$nacionalidad,
            'sexo'=>$sexo,
            'estado_civil'=>$estado_civil,
            'profesion'=>$profesion,
            'antiguedad_actual'=>$antiguedad_actual,
            'antiguedad_anterior'=>$antiguedad_anterior,
            'ingreso_mensual'=>$ingreso_mensual,
            'enterarse'=>$enterarse,
        ]);

    }

    public function createPagosInscripcion($row){

        $apellidos = explode(" ",$row[3]);
        $nombre = strtolower(explode(" ",$row[3])[0]);
        $nombre= DB::connection()->getPdo()->quote(utf8_encode($nombre));
        $appaterno = strtolower($apellidos[count($apellidos)-2]);
        $appaterno= DB::connection()->getPdo()->quote(utf8_encode($appaterno));
        $apmaterno = strtolower($apellidos[count($apellidos)-1]);
        $apmaterno = $apmaterno= DB::connection()->getPdo()->quote(utf8_encode($apmaterno));

        $prospecto = Prospecto::where('nombre',$nombre)->where('appaterno',$appaterno)->where('apmaterno',$apmaterno)->first();
        // dd($prospecto);
        $cotizacion = Cotizacion::where('prospecto_id',$prospecto->id)->first();
        // dd($cotizacion);

        $pagoInscripcion = PagoInscripcion::firstOrCreate([
            'prospecto_id' => $prospecto->id,
            'cotizacion_id'=>null,
            'status' => $row[7] ? $row[7] : '-',
            'monto' => $row[41] && is_float($row[41]) ? $row[41] : 0,
            'identificacion'=>'-',
            'comprobante'=>'-',
            'forma'=>$row[40] ? $row[40] : '-',
            'banco'=>'-',
            'referencia'=>$row[104]?$row[104]:'-',
            'folio'=>$row[12]?$row[12]:'-'
        ]);
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
