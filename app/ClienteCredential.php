<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ClienteResetPasswordNotification;
use App\Notifications\ClienteCredentialNotification;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClienteCredential extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guard = "cliente";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'presolicitud_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function presolicitud()
    {
        return $this->belongsTo('App\Presolicitud','presolicitud_id');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClienteResetPasswordNotification($token));
    }
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendCredentialNotification($contrasena)
    {
        // dd($this);
        $this->notify(new ClienteCredentialNotification($this, $contrasena));
    }
}
