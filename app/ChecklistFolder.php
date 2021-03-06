<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChecklistFolder extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'contrato_id',
        'ficha_deposito_path',
        'perfil_path',
        'presolicitud_path',
        'contrato_path',
        'hoja_aceptacion_path',
        'manual_consumidor_path',
        'calidad_path',
        'privacidad_path',
        'copia_ficha_deposito_path',
        'identificacion_path',
        'comprobante_domicilio_path',
        'croquis_ubicacion_path',
        'carta_bienvenida_path',
        'anexos_path'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function contrato()
    {
        return $this->belongsTo('App\Contrato', 'id', 'contrato_id');
    }

    public function getStatusAttribute()
    {
        $status = true;
        if (!$this->ficha_deposito_path) {
            $status = false;
        }
        if (!$this->perfil_path) {
            $status = false;
        }
        if (!$this->presolicitud_path) {
            $status = false;
        }
        if (!$this->contrato_path) {
            $status = false;
        }
        if (!$this->hoja_aceptacion_path) {
            $status = false;
        }
        if (!$this->manual_consumidor_path) {
            $status = false;
        }
        if (!$this->calidad_path) {
            $status = false;
        }
        if (!$this->privacidad_path) {
            $status = false;
        }
        if (!$this->copia_ficha_deposito_path) {
            $status = false;
        }
        if (!$this->identificacion_path) {
            $status = false;
        }
        if (!$this->comprobante_domicilio_path) {
            $status = false;
        }
        if (!$this->croquis_ubicacion_path) {
            $status = false;
        }
        if (!$this->carta_bienvenida_path) {
            $status = false;
        }
        if (!$this->anexos_path) {
            $status = false;
        }
        // dd($status);
        return $status;
    }

    /**
     * ========
     * BOOLEANS
     * ========
     */

    public function estaCompleto()
    {

        if (!$this->ficha_deposito_path) {
            return false;
        }
        if (!$this->perfil_path) {
            return false;
        }
        if (!$this->presolicitud_path) {
            return false;
        }
        if (!$this->contrato_path) {
            return false;
        }
        if (!$this->hoja_aceptacion_path) {
            return false;
        }
        if (!$this->manual_consumidor_path) {
            return false;
        }
        if (!$this->calidad_path) {
            return false;
        }
        if (!$this->privacidad_path) {
            return false;
        }
        if (!$this->copia_ficha_deposito_path) {
            return false;
        }
        if (!$this->identificacion_path) {
            return false;
        }
        if (!$this->comprobante_domicilio_path) {
            return false;
        }
        if (!$this->croquis_ubicacion_path) {
            return false;
        }
        if (!$this->carta_bienvenida_path) {
            return false;
        }
        if (!$this->anexos_path) {
            return false;
        }
        return true;
    }
}
