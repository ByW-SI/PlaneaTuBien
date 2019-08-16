<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositoEfectivo extends Model
{
    protected $table = "depositos_efectivos";
    protected $fillable = ['dia', 'concepto', 'cargo', 'abono', 'saldo'];

    /**
     * Scope methods
     */
    // @php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}

    public function scopeReferencia($query, $referencia)
    {
        return $query->where('concepto', 'LIKE', "%$referencia%");
    }
}
