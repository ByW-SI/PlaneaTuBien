<?php

namespace App\Http\Controllers\Pagos;

use App\Banco;
use App\Contrato;
use App\Http\Controllers\Controller;
use App\Mensualidad;
use App\PagoInscripcion;
use App\Recibo;
use Illuminate\Http\Request;

class ReciboProvisionalController extends Controller
{
    //
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


     public function formReciboProvisional(PagoInscripcion $pago)
    {
    	// dd($pago);
    	$cotizacion = $pago->cotizacion;
    	$prospecto = $cotizacion->prospecto;
    	$monto = $cotizacion->monto;
    	$inscripcion_solo = $cotizacion->monto*($cotizacion->plan->inscripcion/100);
    	$iva_solo_inscripcion = $inscripcion_solo*0.16;

    	$total_pagado = $pago->cotizacion->total_pagado-$pago->monto;
        $inscripcion_restante = $inscripcion_solo-$total_pagado;
    	$monto_pago = $pago->monto;
    	// si es mayor al monto de inscripcion
        if($monto_pago >=$inscripcion_restante){
        	$inscripcion = $inscripcion_restante;
        	$iva = $inscripcion*.16;
        	$sobra = $monto_pago -($inscripcion+$iva);
        	if(round($sobra,2) > 0){

        		$cuota_periodica = $sobra;
        	}
        	else{
        		$cuota_periodica = 0;
        	}
        	$inscripcion_inicial = $inscripcion;
       		$iva_inscripcion = $iva;
        }
        // si es menor al monto de inscripcion y no lo cubre;
        else{
        	$inscripcion_inicial = $monto_pago-($monto_pago*0.16);
        	$iva_inscripcion = $monto_pago*0.16;
        	$cuota_periodica = 0;
        }
        
        $monto_inscripcion_con_iva = $inscripcion_inicial+$iva_inscripcion;
        $primera_cuota_periodica_total = $cuota_periodica;
        $total = $monto_pago;
        $bancos = Banco::orderBy('nombre','asc')->get();
       return view('pagos.recibo.form',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion,'bancos'=>$bancos,'monto'=>$monto,'inscripcion_inicial' => $inscripcion_inicial,'iva' => $iva_inscripcion,'monto_inscripcion_con_iva' => $inscripcion_inicial+$iva_inscripcion,'cuota_periodica' => $primera_cuota_periodica_total, 'total'=> $total,'pago'=>$pago]);
    }
    public function submitReciboProvisional(Request $request, PagoInscripcion $pago)
    {
        // dd($request->input());
        $cotizacion = $pago->cotizacion;
    	$prospecto = $cotizacion->prospecto;
    	$presolicitud = $prospecto->perfil->presolicitud;
        $grupos = $cotizacion->plan->grupos;

        //dd($presolicitud->cotizacion()->plan);

        // dd($cotizacion->contratos());
        //dd($cotizacion->plan->grupos()->get());
        foreach ($grupos as $grupo) {
            // dd($grupo->contratos);
            //dd($grupo->contratos);
            if( $grupo->contratos > 0 && $grupo->activo == 1){
                $rules=[
                    'monto'=>"required|string",
                    'sucursal'=>"required|max:190",
                    'tipo_pago'=>"required",
                    'tipo_tarjeta'=>"required_if:tipo_pago,Tarjeta de Crédito,Tarjeta de Débito",
                    'numero'=>"nullable|max:190",
                    'banco'=>"nullable|max:190",
                    'insc_inicial'=>"required|string",
                    'iva'=>"required|string",
                    'subtotal'=>"required|string",
                    'cuota_periodica'=>"required|string",
                    'total'=>"required|string"
                ];
                // dd('aqui');
                $this->validate($request,$rules);
                // dd($request->all());
                $recibo = new Recibo($request->all());
                $recibo->monto = floatval(str_replace(',', '', str_replace('', '.', $recibo->monto)));
                $recibo->insc_inicial = floatval(str_replace(',', '', str_replace('', '.', $recibo->insc_inicial)));
                $recibo->iva = floatval(str_replace(',', '', str_replace('', '.', $recibo->iva)));
                $recibo->subtotal = floatval(str_replace(',', '', str_replace('', '.', $recibo->subtotal)));
                $recibo->cuota_periodica = floatval(str_replace(',', '', str_replace('', '.', $recibo->cuota_periodica)));
                $recibo->total = floatval(str_replace(',', '', str_replace('', '.', $recibo->total)));
                $recibo->asesor = $prospecto->asesor->nombre." ".$prospecto->asesor->paterno." ".$prospecto->asesor->materno;
                // $recibo->numero_contrato = Recibo::get()->count()+1;
                $recibo->clave = strtoupper(substr("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", mt_rand(0, 51), 1).substr(md5(time().$prospecto->id.$cotizacion->id), 1));
                $recibo->total_letra = $this->to_word($recibo->total,"MXN");
                $pago->recibo()->save($recibo);
                dd($cotizacion->contratos());

                if ($presolicitud->contratos->isEmpty()) {
                  foreach ($cotizacion->contratos() as $value) {

                    // dd($presolicitud->cotizacion());

                    //Actualizamos el pefil con usuario ala presolicitud 

                    $presolicitud->update(['prospecto'=>1]);
                    
                    $contrato = new Contrato;
                    $contrato->monto = $value;
                    $contrato->grupo()->associate($grupo->id);
                    $grupo->contratos -= 1;
                    $grupo->save();
                    $contrato->numero_contrato = 500-$grupo->contratos;
                    $contrato->estado = "registrado";
                    $presolicitud->contratos()->save($contrato);
                    
                    $mensualidad = Mensualidad::create([
                        "contrato_id"=>$contrato->id,
                        "cantidad"=>$presolicitud->cotizacion()->plan->corrida_meses_fijos($contrato->monto)['integrante']['total'],
                        "fecha"=>$contrato->getFechaPago(),
                        "recargo"=>0,
                        "pagado"=>0,
                        "abono"=>0
                    ]);
                  }
                }
                return redirect()->route('pagos.index');
            }else{
                return redirect()->back();
            }
        }
    }
    public function showReciboProvisional(PagoInscripcion $pago)
    {
    	$cotizacion = $pago->cotizacion;
    	$prospecto = $cotizacion->prospecto;
    	$recibo = $pago->recibo;
    	return view('pagos.recibo.show',['prospecto'=>$prospecto,'cotizacion'=>$cotizacion,'pago'=>$pago,'recibo'=>$recibo]);
    }
}
