<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositoEfectivo extends Model
{
    protected $table = "depositos_efectivos";
    protected $fillable = ['dia', 'concepto', 'cargo', 'abono', 'saldo'];

    public function contrato()
    {
        $grupo_deposito_efectivo = substr($this->concepto, 0, 3);
        $id_contrato_deposito_efectivo = substr($this->concepto, 3, 1);

        if (is_numeric($grupo_deposito_efectivo)) {
            $grupo_deposito_efectivo = (int) $grupo_deposito_efectivo;
        }

        $contrato = Contrato::where('grupo_id', $grupo_deposito_efectivo);
        $contrato = $contrato->where('id', $id_contrato_deposito_efectivo);

        return $contrato;
    }

    /**
     * Scope methods
     */
    // @php(printf('%03d', $contrato->grupo->id)){{$contrato->numero_contrato}}{{ strtoupper(substr(md5($cliente->id.$cotizacion->id.$contrato->id),16)) }}

    public function scopeReferencia($query, $referencia)
    {
        return $query->where('concepto', 'LIKE', "%$referencia%");
    }
}
