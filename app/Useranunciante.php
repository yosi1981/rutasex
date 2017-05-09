<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Useranunciante extends Model
{

    protected $table='usersAnunciante';

    protected $primaryKey='id';

    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    public function Partner()
    {
        return $this->hasOne('App\User','id','idpartner');
    }

    public function Anuncios(Boolean $activo)
    {
        return $this->hasMany('App\Anuncio','idusuario','id')
    }

    public function HistorialAnuncios()
    {
        return $this->hasMany('App\AnuncioDia','idanunciante','id')
    }
}
