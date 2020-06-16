<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table = 'pagos';

	protected $fillable = [
		'id',
		'contrato_id',
		'monto',
		'fecha_pago',
		'folio',
		'status_id',
		'tipopago_id',
		'referencia',
		'spei',
		'file_comprobante',
		'mensualidad_id'
	];

	protected $hidden =[
    	'created_at',
    	'updated_at',
    ];

	public function contrato() {
		return $this->belongsTo('App\Contrato');
	}
	public function refdepositopago()
    {
        return $this->hasMany('App\Refdepositopago');
    }

	public function plan(){

		$contrato = $this->contrato()->first();

        if($contrato){
            $presolicitud = $contrato->presolicitud()->first();

            if($presolicitud){
                $cotizacion = $presolicitud->cotizacion()->first();

                if($cotizacion){
                    $plan = $cotizacion->plan();
                }
            }
		}
		
		return $plan;
	}

	public function mensualidad() {
		return $this->belongsTo('App\Mensualidad');
	}
	/**
	 * Scope methods
	 */

	public function ScopeAprobados($query){
		$status_aprobado = StatusPago::where('nombre','Aprobado')->first();
		return $query->where('status_id',$status_aprobado->id);
	}
}
