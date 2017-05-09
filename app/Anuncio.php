<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $table='anuncios';

    protected $primaryKey='idanuncio';

    public $timestamps=false;

    protected $fillable =[
    	'titulo',
    	'descripcion',
    	'activo',
    	'idusuario'
    ];

    protected $guarded=[
    ];

    public function UserAnunciante()
    {
        return $this->hasOne('App\Useranunciante','id','idusuario');
    }
}
