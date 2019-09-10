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

    public function getReferenciaAttribute($tipo_pago="1")
    {

        // $ref_inicio = $this->numero_contrato.$tipo_pago;
        // return $ref_inicio.strtoupper(substr(md5($this->presolicitud->id.$this->id),16));
        // // J23
        // if($H23 <41962){
        //     $result = ((D23 - 1988)*372) + ((C23 - 1)*31) + (B23 - 1);
        // }
        // else
        //     $result = ((D23 - 2014)*372) + ((C23 - 1)*31) + (B23 -1);
    }
}
