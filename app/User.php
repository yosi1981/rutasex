<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table='users';

    protected $primaryKey='id';

    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function provincias()
    {
        return $this->hasMany('App\Provincia','idresponsable','id');
    }

    public function stringRol()
    {
        return $this->hasOne('App\TipoUsuario','id','tipo_usuario');
    }


    public function Referidos()
    {
        return $this->hasMany('App\Useranunciante','idpartner','id');
    }

    public function DatosUsuario()
    {
        return $this->hasOne('App\User'. $this->stringRol->nombre, 'id','id');

    }
}
