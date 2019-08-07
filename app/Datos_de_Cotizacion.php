<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datos_de_Cotizacion extends Model
{
    protected $table = 'datos_de__cotizacions';

    protected $fillable = [
    	'id',
    	'cotizacion_id',
        'aportaciones_extraordinarias', 
        'monto_financiar',
        'anual_total',
        'monto_adjudicar',
        'aportacion_integrante', 
        'cuota_administracion_integrante',
        'iva_integrante',
        'sv_integrante',
        'sd_integrante',
        'aportacion_adjudicado',
        'cuota_administracion_adjudicado',
        'iva_adjudicado',
        'sv_adjudicado',
        'cuota_periodica_integrante',
        'cuota_periodica_adjudicado',
        'total_aportacion_en_mensualidades',
        'total_aportaciones_en_extraordin',
        'total_aportacion',
        'total_cuota_administracion',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function cotizacion()
    {
        return $this->belongsTo('App\Cotizacion');
    }
}
