<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table = 'pagos';

	protected $fillable = [
		'id',
		'contrato_id',
		'status',
		'monto',
		'fecha_pago',
		'adeudo',
		'total',
		'folio',
		'status_id',
		'tipopago_id',
		'tipocarga_id',
		'empleado_id',
		'referencia',
		'spei',
		'file_comprobante'
	];

	protected $hidden =[
    	'created_at',
    	'updated_at',
    ];

	public function contrato() {
		return $this->belongsTo('App\Contrato');
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

	/**
	 * Scope methods
	 */

	public function ScopeAprobados($query){
		$status_aprobado = StatusPago::where('nombre','Aprobado')->first();
		return $query->where('status_id',$status_aprobado->id);
	}
}
