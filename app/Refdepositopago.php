<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refdepositopago extends Model
{
    //
    protected $table = 'refdepositopagos';

	protected $fillable = [
        'id',
        'deposito_efectivo_id',
        'pago_id'
    ];
    
    protected $hidden=[
        'created_at',
        'updated_at'
    ];
    public function depositoEfectivo() {
		return $this->belongsTo('App\DepositoEfectivo');
	}
	public function pago() {
		return $this->belongsTo('App\Pagos');
	}
}
