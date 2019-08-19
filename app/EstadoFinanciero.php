<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoFinanciero extends Model
{

	protected $table = 'estado_financiero';

    protected $fillable=[
    	'contrato_id',
    	'adeudo',
    	'abono',
    	'recargo',
    	'saldo'
    ];
    protected $hidden =[
    	'created_at',
    	'updated_at'
    ];

    public function contrato()
    {
    	return $this->belongsTo('App\Contrato');
    }
}
