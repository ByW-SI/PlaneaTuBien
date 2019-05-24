<?php

namespace App\Http\Controllers\Prospecto\Cliente\Presolicitud;

use App\Banco;
use App\Http\Controllers\Controller;
use App\Presolicitud;
use App\Prospecto;
use App\Recibo;
use App\Contrato;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PresolicitudReciboController extends Controller
{

     private $UNIDADES = array(
        '',
        'UN ',
        'DOS ',
        'TRES ',
        'CUATRO ',
        'CINCO ',
        'SEIS ',
        'SIETE ',
        'OCHO ',
        'NUEVE ',
        'DIEZ ',
        'ONCE ',
        'DOCE ',
        'TRECE ',
        'CATORCE ',
        'QUINCE ',
        'DIECISEIS ',
        'DIECISIETE ',
        'DIECIOCHO ',
        'DIECINUEVE ',
        'VEINTE '
  );
  private $DECENAS = array(
        'VEINTI',
        'TREINTA ',
        'CUARENTA ',
        'CINCUENTA ',
        'SESENTA ',
        'SETENTA ',
        'OCHENTA ',
        'NOVENTA ',
        'CIEN '
  );
  private $CENTENAS = array(
        'CIENTO ',
        'DOSCIENTOS ',
        'TRESCIENTOS ',
        'CUATROCIENTOS ',
        'QUINIENTOS ',
        'SEISCIENTOS ',
        'SETECIENTOS ',
        'OCHOCIENTOS ',
        'NOVECIENTOS '
  );
  private $MONEDAS = array(
    array('country' => 'Colombia', 'currency' => 'COP', 'singular' => 'PESO COLOMBIANO', 'plural' => 'PESOS COLOMBIANOS', 'symbol', '$'),
    array('country' => 'Estados Unidos', 'currency' => 'USD', 'singular' => 'DÓLAR', 'plural' => 'DÓLARES', 'symbol', 'US$'),
    array('country' => 'El Salvador', 'currency' => 'USD', 'singular' => 'DÓLAR', 'plural' => 'DÓLARES', 'symbol', 'US$'),
    array('country' => 'Europa', 'currency' => 'EUR', 'singular' => 'EURO', 'plural' => 'EUROS', 'symbol', '€'),
    array('country' => 'México', 'currency' => 'MXN', 'singular' => 'PESO MEXICANO', 'plural' => 'PESOS MEXICANOS', 'symbol', '$'),
    array('country' => 'Perú', 'currency' => 'PEN', 'singular' => 'NUEVO SOL', 'plural' => 'NUEVOS SOLES', 'symbol', 'S/'),
    array('country' => 'Reino Unido', 'currency' => 'GBP', 'singular' => 'LIBRA', 'plural' => 'LIBRAS', 'symbol', '£'),
    array('country' => 'Argentina', 'currency' => 'ARS', 'singular' => 'PESO', 'plural' => 'PESOS', 'symbol', '$')
  );
    private $separator = ',';
    private $decimal_mark = '.';
    private $glue = ' CON ';
    /**
     * Evalua si el número contiene separadores o decimales
     * formatea y ejecuta la función conversora
     * @param $number número a convertir
     * @param $miMoneda clave de la moneda
     * @return string completo
     */
    public function to_word($number, $miMoneda = null) {
        if (strpos($number, $this->decimal_mark) === FALSE) {
          $convertedNumber = array(
            $this->convertNumber($number, $miMoneda, 'entero')
          );
        } else {
          $number = explode($this->decimal_mark, str_replace($this->separator, '', trim($number)));
          $convertedNumber = array(
            $this->convertNumber($number[0], $miMoneda, 'entero'),
            $this->convertNumber($number[1], $miMoneda, 'decimal'),
          );
        }
        return implode($this->glue, array_filter($convertedNumber));
    }
    /**
     * Convierte número a letras
     * @param $number
     * @param $miMoneda
     * @param $type tipo de dígito (entero/decimal)
     * @return $converted string convertido
     */
    private function convertNumber($number, $miMoneda = null, $type) {   
        
        $converted = '';
        if ($miMoneda !== null) {
            try {
                
                $moneda = array_filter($this->MONEDAS, function($m) use ($miMoneda) {
                    return ($m['currency'] == $miMoneda);
                });
                $moneda = array_values($moneda);
                if (count($moneda) <= 0) {
                    throw new Exception("Tipo de moneda inválido");
                    return;
                }
                ($number < 2 ? $moneda = $moneda[0]['singular'] : $moneda = $moneda[0]['plural']);
            } catch (Exception $e) {
                echo $e->getMessage();
                return;
            }
        }else{
            $moneda = '';
        }
        if (($number < 0) || ($number > 999999999)) {
            return false;
        }
        $numberStr = (string) $number;
        $numberStrFill = str_pad($numberStr, 9, '0', STR_PAD_LEFT);
        $millones = substr($numberStrFill, 0, 3);
        $miles = substr($numberStrFill, 3, 3);
        $cientos = substr($numberStrFill, 6);
        if (intval($millones) > 0) {
            if ($millones == '001') {
                $converted .= 'UN MILLON ';
            } else if (intval($millones) > 0) {
                $converted .= sprintf('%sMILLONES ', $this->convertGroup($millones));
            }
        }
        
        if (intval($miles) > 0) {
            if ($miles == '001') {
                $converted .= 'MIL ';
            } else if (intval($miles) > 0) {
                $converted .= sprintf('%sMIL ', $this->convertGroup($miles));
            }
        }
        if (intval($cientos) > 0) {
            if ($cientos == '001') {
                $converted .= 'UN ';
            } else if (intval($cientos) > 0) {
                $converted .= sprintf('%s ', $this->convertGroup($cientos));
            }
        }
        
        if($type == "decimal"){
            return $converted."CENTAVOS";

        }
        else{
            $converted .= $moneda;
            return $converted;
        }
    }
    /**
     * Define el tipo de representación decimal (centenas/millares/millones)
     * @param $n
     * @return $output
     */
    private function convertGroup($n) {
        $output = '';
        if ($n == '100') {
            $output = "CIEN ";
        } else if ($n[0] !== '0') {
            $output = $this->CENTENAS[$n[0] - 1];   
        }
        $k = intval(substr($n,1));
        if ($k <= 20) {
            $output .= $this->UNIDADES[$k];
        } else {
            if(($k > 30) && ($n[2] !== '0')) {
                $output .= sprintf('%sY %s', $this->DECENAS[intval($n[1]) - 2], $this->UNIDADES[intval($n[2])]);
            } else {
                $output .= sprintf('%s%s', $this->DECENAS[intval($n[1]) - 2], $this->UNIDADES[intval($n[2])]);
            }
        }
        return $output;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Prospecto $prospecto, Presolicitud $presolicitud)
    {
        //
        $cotizacion = $presolicitud->cotizacion();
        // dd($cotizacion->contratos());
        if($presolicitud->recibo){
          return view('prospectos.presolicitud.recibo.index',['presolicitud'=>$presolicitud,'prospecto'=>$prospecto,'cotizacion'=>$cotizacion]);

        }else{
          return redirect()->route('prospectos.presolicitud.recibos.create',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Prospecto $prospecto, Presolicitud $presolicitud)
    {
        //
        $cotizacion = $presolicitud->perfil->cotizacion;
        $plan = $cotizacion->plan;
        $monto = $cotizacion->monto;
        $cuota_inscripcion = $monto*($plan->inscripcion/100)-($monto*($plan->inscripcion/100)*($cotizacion->descuento/100));
        $iva_inscripcion= $cuota_inscripcion*0.16;
        $aportacion_periodica = $monto/$plan->plazo;
        $cuota_administracion = $monto*($plan->cuota_admon/100);
        $iva_cuota_admon = $cuota_administracion*0.16;
        $seguro_vida = $monto*($plan->s_v/100);
        $primera_cuota_periodica_total = $aportacion_periodica+$cuota_administracion+$iva_cuota_admon+$seguro_vida;
        $suma_incripcion_y_cuota = $cuota_inscripcion+$iva_inscripcion+$primera_cuota_periodica_total;
        // $recibos = $presolicitud->recibos;
        // $contratos = $cotizacion->contratos();
        // // dd($recibos);
        // foreach ($contratos as $key=>$monto) {
        //     foreach ($recibos as $recibo) {
        //         if($recibo->contrato->monto  == $monto){
        //             array_splice($contratos,$key,1);
        //         }
        //     }
        // }
        // dd($contratos);
        $bancos = Banco::orderBy('nombre','asc')->get();
       return view('prospectos.presolicitud.recibo.form',['presolicitud'=>$presolicitud,'prospecto'=>$prospecto,'cotizacion'=>$cotizacion,'bancos'=>$bancos,'monto'=>$monto,'inscripcion_inicial' => $cuota_inscripcion,'iva' => $iva_inscripcion,'monto_inscripcion_con_iva' => $cuota_inscripcion+$iva_inscripcion,'cuota_periodica' => $primera_cuota_periodica_total]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Prospecto $prospecto, Presolicitud $presolicitud,Request $request)
    {
        //
        // dd($this->to_word((float)100584.99,"MXN")." ".$request->total);
        $cotizacion = $presolicitud->perfil->cotizacion;
        $grupos = $presolicitud->cotizacion()->plan->grupos;
        // dd($cotizacion->contratos());
        foreach ($grupos as $grupo) {
            if($grupo->contratos > 0 && $grupo->activo == 1){
                $rules=[
                    'monto'=>"required|numeric",
                    'sucursal'=>"required|max:190",
                    'tipo_pago'=>"required|in:Tarjeta de crédito,Cheque",
                    'tipo_tarjeta'=>"required_if:tipo_pago,Tarjeta de crédito",
                    'numero'=>"required|max:190",
                    'banco'=>"required|max:190",
                    'insc_inicial'=>"required|numeric",
                    'iva'=>"required|numeric",
                    'subtotal'=>"required|numeric",
                    'cuota_periodica'=>"required|numeric",
                    'total'=>"required|numeric"
                ];
                $this->validate($request,$rules);
                // dd($request->all());
                $recibo = new Recibo($request->all());
                $recibo->asesor = $prospecto->asesor->nombre." ".$prospecto->asesor->paterno." ".$prospecto->asesor->materno;
                $recibo->numero_contrato = Recibo::get()->count()+1;
                $recibo->clave = substr(md5($presolicitud->id),0,5);
                $recibo->total_letra = $this->to_word($recibo->total,"MXN");
                $presolicitud->recibo()->save($recibo);
                foreach ($cotizacion->contratos() as $value) {
                  $contrato = new Contrato;
                  $contrato->monto = $value;
                  $contrato->grupo()->associate($grupo->id);
                  $grupo->contratos -= 1;
                  $grupo->save();
                  $contrato->numero_contrato = 500-$grupo->contratos;
                  $contrato->estado = "registrado";
                  $recibo->contratos()->save($contrato);
                }
                return redirect()->route('prospectos.presolicitud.recibos.index',['prospecto'=>$prospecto,'presolicitud'=>$presolicitud]);
            }
        }




    }

    /**
     * Descarga la presolicitud rellenada.
     *
     * @param  \App\Prospecto  $prospecto
     * @param  \App\Presolicitud  $presolicitud
     * @return \Illuminate\Http\Response
     */
    public function pdf(Prospecto $prospecto,Presolicitud $presolicitud,Recibo $recibo,Request $request)
    {
        // dd($presolicitud);
        $pdf = PDF::loadView('prospectos.presolicitud.pdf',['presolicitud'=>$presolicitud,'recibo'=>$recibo,'contrato'=>$request->contrato]);
        // return $pdf->stream();
        return $pdf->download('presolicitud'.$prospecto->nombre.$prospecto->appaterno.$prospecto->apmaterno."_contrato_".$request->contrato.".pdf");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function show(Recibo $recibo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function edit(Recibo $recibo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recibo $recibo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recibo $recibo)
    {
        //
    }
}
