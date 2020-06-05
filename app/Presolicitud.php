<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Presolicitud extends Model
{
	use SoftDeletes;
    // PRESOLICITUD DE PROSPECTO

    protected $fillable=[
    	'folio',
        'perfil_id',
    	'precio_inicial',
		'plazo_contratado',
		'plan',
		'paterno',
		'materno',
		'nombre',
		'calle',
		'numero_ext',
		'numero_int',
		'colonia',
		'municipio',
		'estado',
		'cp',
		'rfc',
		'tel_casa',
		'tel_oficina',
		'tel_celular',
		'email',
		'fecha_nacimiento',
		'lugar_nacimiento',
		'nacionalidad',
		'sexo',
		'estado_civil',
		'profesion',
		'empresa',
		'puesto',
		'antiguedad_actual',
		'antiguedad_anterior',
		'ingreso_mensual',
		'enterarse',
        'prospecto',
        'gestion',
        'fecha_gestion'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $dates=[
    	'deleted_at'
    ];
    public function getAgeAttribute()
    {
        $date_birth = $this->fecha_nacimiento;
        $age = Carbon::parse($date_birth)->age;
        return $age;
    }

    public function perfil()
    {
    	return $this->belongsTo('App\PerfilDatosPersonalCliente','perfil_id','id');
    }

    public function cotizacion(){
    	return $this->perfil->cotizacion;
    }

    public function conyuge(){
    	return $this->hasOne('App\Conyuge','presolicitud_id','id');
    }

    public function beneficiarios()
    {
    	return $this->hasMany('App\Beneficiario','presolicitud_id','id');
    }

    public function referencias()
    {
    	return $this->hasMany('App\Referencia','presolicitud_id','id');
    }

    // public function recibos()
    // {
    // 	return $this->hasMany('App\Recibo','presolicitud_id','id');
    // }
    
    public function contratos()
    {
        return $this->hasMany('App\Contrato');
    }

    public function getStatusAttribute()
    {
        $status = 20.00;
        if(in_array($this->estado_civil,['Casado','Divorciado','Unión Libre']) && $this->conyuge){
            $status+=20;
        }
        if(in_array($this->estado_civil,['Soltero','Viudo'])){
            $status += 20;
        }
        if ($this->beneficiarios->isNotEmpty()) {
            $status+=20;
        }
        if($this->referencias->isNotEmpty()){
            $status+=20;
        }
        if ( ($this->cotizacion() && $this->cotizacion()->liberar) || $this->cotizacion()->plan->tipo == 'libre' ) {
            $status += 20;
        }
        return $status;
    }
    public function checklist()
    {
        return $this->hasOne('App\ChecklistFolder','presolicitud_id','id');
    }
    public function cliente_credential()
    {
        return $this->hasOne('App\ClienteCredential','presolicitud_id');
    }
}
