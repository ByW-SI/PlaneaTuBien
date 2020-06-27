<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Contrato extends Model
{
    //

    protected $fillable=[
        'monto',
        'numero_contrato',
        'estado',
        'grupo_id',
        'presolicitud_id',
    ];
    protected $hidden =[
    	'created_at',
    	'deleted_at',
    	'updated_at'
    ];
    protected $date=[
    	'created_at',
    	'deleted_at',
    	'updated_at'
    ];

    public function grupo()
    {
    	return $this->belongsTo('App\Grupo');
    }

    public function presolicitud()
    {
    	return $this->belongsTo('App\Presolicitud');
    }

    public function domiciliacion()
    {
        return $this->hasOne('App\Domiciliacion');
    }
    public function checklist()
    {
        return $this->hasOne('App\ChecklistFolder');
    }

    public function pagos()
    {
        return $this->hasMany('App\Pagos');
    }

    public function mensualidades(){
        return $this->hasMany('App\Mensualidad');
    }
     public function gestiones()
    {
        return $this->hasMany('App\Gestion');
    }


    /**
     * Validation methods
     */

    public function getFechaPago()
    {
        $siguientePago = new Carbon('first day of this month');
        $siguientePago = $siguientePago->addMonth();
        $siguientePago = $siguientePago->addDays(6);

        while ($siguientePago->englishDayOfWeek === "Saturday" || $siguientePago->englishDayOfWeek === "Sunday") {
            /*
            Aqui ira la condicion de la precarga de dias feriados
            */
            $siguientePago->addDay();
        }

        return $siguientePago->format('Y-m-d');
    }

    /**
     * Scope methods
     */

    public function scopeRegistrados($query){
        return $query->where('estado','registrado');
    }

    public function getReferenciaAttribute($tipo_pago)
    {
        //$ref_inicio = $this->numero_contrato.$tipo_pago;
        $ref_inicio = "161231";
        $fecha = Carbon::now();
        $importe = 1500.00;
        settype($importe, "float");
        $J4 = $importe * 100;
        $importe_string = str_pad($J4, 7, "0", STR_PAD_RIGHT);
        //return "0". 453;
        //return $fecha->diffInDays(Carbon::create(1900,1,1,0,0,0));
        //return  $fecha->lessThan(new Carbon($this->exceldate2timestringphp(41962)));


        //K4
        //I4  Es el valor seriado de la fecha (dias desde 1, enero de 1900)
        if ( $fecha->lessThan(new Carbon($this->exceldate2timestringphp(41962))) )  {
            $k4 =  (($fecha->year -1988)*372) + (($fecha->month - 1)*31) + ($fecha->day - 1);
        }
        else{
            $k4 = (($fecha->year -2014)*372) + (($fecha->month - 1)*31) + ($fecha->day - 1);   
        }

        //M4
        if($k4 < 1000){
            $M4 = "0". $k4;
        }
        else
            $M4 = $k4;
        //X4
        $X4 = $this->W4($importe_string, $J4) % 10;
        
        $Y4 = $ref_inicio . $M4 . $X4 . "2";    

        //return $Y4;
        $AR4 = "";
        for ($i=0; $i < 18; $i++) {
            if ("{$this->ext($Y4, $i,1)}" != "") {
                $AR4 .= "{$this->ext($Y4, $i,1)}";
            }
            else
                $AR4 .= " ";
        }
        $blancos = strlen(substr($AR4, stripos($AR4, " ")));
        
        $BE4 = 0;
        switch ($blancos) {
            case 0:
                $BE4 = ((11 * intval($this->ext($Y4, 17, 1))) + (13 * intval($this->ext($Y4, 16, 1))) + (17 * intval($this->ext($Y4, 15, 1))) + (19 * intval($this->ext($Y4, 14, 1))) + (23 * intval($this->ext($Y4, 13, 1))) + (11 * intval($this->ext($Y4, 12, 1))) + (13 * intval($this->ext($Y4, 11, 1))) + (17 * intval($this->ext($Y4, 10, 1))) + (19 * intval($this->ext($Y4, 9, 1))) + (23 * intval($this->ext($Y4, 8, 1))) + (11 * intval($this->ext($Y4, 7, 1))) + (13 * intval($this->ext($Y4, 6, 1))) + (17 * intval($this->ext($Y4, 5, 1))) + (19 * intval($this->ext($Y4, 4, 1))) + (23 * intval($this->ext($Y4, 3, 1))) + (11 * intval($this->ext($Y4, 2, 1))) + (13* intval($this->ext($Y4, 1, 1))) + (17 * intval($this->ext($Y4, 0, 1))) );
                break;
            case 1:
                $BE4 = ((11 * intval($this->ext($Y4, 16, 1))) + (13 * intval($this->ext($Y4, 15, 1))) + (17 * intval($this->ext($Y4, 14, 1))) + (19 * intval($this->ext($Y4, 13, 1))) + (23 * intval($this->ext($Y4, 12, 1))) + (11 * intval($this->ext($Y4, 11, 1))) + (13 * intval($this->ext($Y4, 10, 1))) + (17 * intval($this->ext($Y4, 9, 1))) + (19 * intval($this->ext($Y4, 8, 1))) + (23 * intval($this->ext($Y4, 7, 1))) + (11 * intval($this->ext($Y4, 6, 1))) + (13 * intval($this->ext($Y4, 5, 1))) + (17 * intval($this->ext($Y4, 4, 1))) + (19 * intval($this->ext($Y4, 3, 1))) + (23 * intval($this->ext($Y4, 2, 1))) + (11 * intval($this->ext($Y4, 1, 1))) + (13 * intval($this->ext($Y4, 0, 1))) ); 
                break;
            case 2:
                $BE4 = ((11 * intval($this->ext($Y4, 15, 1))) + (13 * intval($this->ext($Y4, 14, 1))) + (17 * intval($this->ext($Y4, 13, 1))) + (19 * intval($this->ext($Y4, 12, 1))) + (23 * intval($this->ext($Y4, 11, 1))) + (11 * intval($this->ext($Y4, 10, 1))) + (13 * intval($this->ext($Y4, 9, 1))) + (17 * intval($this->ext($Y4, 8, 1))) + (19 * intval($this->ext($Y4, 7, 1))) + (23 * intval($this->ext($Y4, 6, 1))) + (11 * intval($this->ext($Y4, 5, 1))) + (13 * intval($this->ext($Y4, 4, 1))) + (17 * intval($this->ext($Y4, 3, 1))) + (19 * intval($this->ext($Y4, 2, 1))) + (23* intval($this->ext($Y4, 1, 1))) + (11 * intval($this->ext($Y4, 0, 1))) ); 
                break;
            case 3:
                $BE4 = ((11 * intval($this->ext($Y4, 14, 1))) + (13 * intval($this->ext($Y4, 13, 1))) + (17 * intval($this->ext($Y4, 12, 1))) + (19 * intval($this->ext($Y4, 11, 1))) + (23 * intval($this->ext($Y4, 10, 1))) + (11 * intval($this->ext($Y4, 9, 1))) + (13 * intval($this->ext($Y4, 8, 1))) + (17 * intval($this->ext($Y4, 7, 1))) + (19 * intval($this->ext($Y4, 6, 1))) + (23 * intval($this->ext($Y4, 5, 1))) + (11 * intval($this->ext($Y4, 4, 1))) + (13 * intval($this->ext($Y4, 3, 1))) + (17 * intval($this->ext($Y4, 2, 1))) + (19 * intval($this->ext($Y4, 1, 1))) + (23 * intval($this->ext($Y4, 0, 1))) ); 
                break;
            case 4:
                $BE4 = ((11 * intval($this->ext($Y4, 13, 1))) + (13 * intval($this->ext($Y4, 12, 1))) + (17 * intval($this->ext($Y4, 11, 1))) + (19 * intval($this->ext($Y4, 10, 1))) + (23 * intval($this->ext($Y4, 9, 1))) + (11 * intval($this->ext($Y4, 8, 1))) + (13 * intval($this->ext($Y4, 7, 1))) + (17 * intval($this->ext($Y4, 6, 1))) + (19 * intval($this->ext($Y4, 5, 1))) + (23 * intval($this->ext($Y4, 4, 1))) + (11 * intval($this->ext($Y4, 3, 1))) + (13 * intval($this->ext($Y4, 2, 1))) + (17 * intval($this->ext($Y4, 1, 1))) + (19 * intval($this->ext($Y4, 0, 1))) ); 
                break;
            case 5:
                $BE4 = ((11 * intval($this->ext($Y4, 12, 1))) + (13 * intval($this->ext($Y4, 11, 1))) + (17 * intval($this->ext($Y4, 10, 1))) + (19 * intval($this->ext($Y4, 9, 1))) + (23 * intval($this->ext($Y4, 8, 1))) + (11 * intval($this->ext($Y4, 7, 1))) + (13 * intval($this->ext($Y4, 6, 1))) + (17 * intval($this->ext($Y4, 5, 1))) + (19 * intval($this->ext($Y4, 4, 1))) + (23 * intval($this->ext($Y4, 3, 1))) + (11 * intval($this->ext($Y4, 2, 1))) + (13* intval($this->ext($Y4, 1, 1))) + (17 * intval($this->ext($Y4, 0, 1))) ); 
                break;
            case 6:
                $BE4 = ((11 * intval($this->ext($Y4, 11, 1))) + (13 * intval($this->ext($Y4, 10, 1))) + (17 * intval($this->ext($Y4, 9, 1))) + (19 * intval($this->ext($Y4, 8, 1))) + (23 * intval($this->ext($Y4, 7, 1))) + (11 * intval($this->ext($Y4, 6, 1))) + (13 * intval($this->ext($Y4, 5, 1))) + (17 * intval($this->ext($Y4, 4, 1))) + (19 * intval($this->ext($Y4, 3, 1))) + (23 * intval($this->ext($Y4, 2, 1))) + (11 * intval($this->ext($Y4, 1, 1))) + (13 * intval($this->ext($Y4, 0, 1))) ); 
                break;
            case 7:
                $BE4 = ((11 * intval($this->ext($Y4, 10, 1))) + (13 * intval($this->ext($Y4, 9, 1))) + (17 * intval($this->ext($Y4, 8, 1))) + (19 * intval($this->ext($Y4, 7, 1))) + (23 * intval($this->ext($Y4, 6, 1))) + (11 * intval($this->ext($Y4, 5, 1))) + (13 * intval($this->ext($Y4, 4, 1))) + (17 * intval($this->ext($Y4, 3, 1))) + (19 * intval($this->ext($Y4, 2, 1))) + (23* intval($this->ext($Y4, 1, 1))) + (11 * intval($this->ext($Y4, 0, 1))) ); 
                break;
            case 8:
                $BE4 = ((11 * intval($this->ext($Y4, 9, 1))) + (13 * intval($this->ext($Y4, 8, 1))) + (17 * intval($this->ext($Y4, 7, 1))) + (19 * intval($this->ext($Y4, 6, 1))) + (23 * intval($this->ext($Y4, 5, 1))) + (11 * intval($this->ext($Y4, 4, 1))) + (13 * intval($this->ext($Y4, 3, 1))) + (17 * intval($this->ext($Y4, 2, 1))) + (19* intval($this->ext($Y4, 1, 1))) + (23 * intval($this->ext($Y4, 0, 1))) ); 
                break;
            case 9:
                $BE4 = ((11 * intval($this->ext($Y4, 8, 1))) + (13 * intval($this->ext($Y4, 7, 1))) + (17 * intval($this->ext($Y4, 6, 1))) + (19 * intval($this->ext($Y4, 5, 1))) + (23 * intval($this->ext($Y4, 4, 1))) + (11 * intval($this->ext($Y4, 3, 1))) + (13 * intval($this->ext($Y4, 2, 1))) + (17* intval($this->ext($Y4, 1, 1))) + (19 * intval($this->ext($Y4, 0, 1))) ); 
                break;
            case 10:
                $BE4 = ((11 * intval($this->ext($Y4, 7, 1))) + (13 * intval($this->ext($Y4, 6, 1))) + (17 * intval($this->ext($Y4, 5, 1))) + (19 * intval($this->ext($Y4, 4, 1))) + (23 * intval($this->ext($Y4, 3, 1))) + (11 * intval($this->ext($Y4, 2, 1))) + (13* intval($this->ext($Y4, 1, 1))) + (17 * intval($this->ext($Y4, 0, 1))) ); 
                break;
            case 11:
                $BE4 = ((11 * intval($this->ext($Y4, 6, 1))) + (13 * intval($this->ext($Y4, 5, 1))) + (17 * intval($this->ext($Y4, 4, 1))) + (19 * intval($this->ext($Y4, 3, 1))) + (23 * intval($this->ext($Y4, 2, 1))) + (11* intval($this->ext($Y4, 1, 1))) + (13 * intval($this->ext($Y4, 0, 1))) ); 
                break;
            
            default:
                $BE4 = -1;
                break;
        }

        //return $BE4;
        $BF4 = ($BE4 % 97) + 1;
        //return $BF4;

        if ($BF4 < 10) {
            return $ref_inicio . $M4 . $X4 . "20" . $BF4; 
        }
        else
            return $ref_inicio . $M4 . $X4 . "2" . $BF4;

    }

    public function W4($J4, $importe)
    {
        if (7 - strlen("{$importe}") == 2) { 
            return ((7 * intval(substr("{$J4}",4,1)) ) + (3*intval(substr("{$J4}",3,1))) + intval(substr("{$J4}",2,1)) + (7*intval(substr("{$J4}",1,1))) + (3*intval(substr("{$J4}",0,1))));
        }
        elseif (7 - strlen("{$importe}") == 1) {
            return ( (7*  intval(substr("{$J4}",5,1)) ) + (3* intval(substr("{$J4}",4,1)) ) + intval(substr("{$J4}",3,1)) + (7* intval(substr("{$J4}",2,1)) ) + (3* intval(substr("{$J4}",1,1)) ) + intval(substr("{$J4}",0,1)) );
        }
    }

    function exceldate2timestringphp($int_exceldate){
        return date("Y-m-d",mktime(null, null, null, null, $int_exceldate - '36495', null));
    }

    public function ext($cadena, $inicio, $tam)
    {
        return substr($cadena, $inicio, $tam);
    }
}
