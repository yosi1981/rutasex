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

    public function DatosUsuario()
    {
        return $this->hasOne('App\User'. $this->stringRol->nombre, 'id','id');

        /*
        if($this->tipo_usuario==1)
        {
                return $this->hasOne('App\User','idusers1','id');
        }
        if($this->tipo_usuario==2)
        {
                 return $this->hasOne('App\User1','idusers1','id');           
        }
        if($this->tipo_usuario==3)
        {
                 return $this->hasOne('App\User2','idusers2','id');
           
        }
        if($this->tipo_usuario==4)
        {
                return $this->hasOne('App\User1','idusers1','id');            
        }
        */

/*
        switch ($this->tipo_usuario) {
            case 1 or 4:
                return $this->hasOne('App\User1','idusers1','id');
                break;
            case 2 or 3:
                return $this->hasOne('App\User2','idusers2','id');
                break;
        }
*/
    }
}
