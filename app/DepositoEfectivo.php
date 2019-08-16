<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositoEfectivo extends Model
{
    protected $table = "depositos_efectivos";
    protected $fillable = ['dia', 'concepto', 'cargo', 'abono', 'saldo'];

    public function scopeReferencia($query, $referencia)
    {
        return $query->where('concepto', 'LIKE', "%$referencia%");
    }
}
