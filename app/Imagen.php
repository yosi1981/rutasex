<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table='imagenes';

    protected $primaryKey='idimagen';

    public $timestamps=false;

    protected $fillable =[
    	'ficheroimagen',
    	'titulo',
    	'iduser',
    ];

    protected $guarded=[
    ];


    public function ImagenesAnuncio()
    {
        return $this->belongsToMany('App\Anuncio', 'imagenes_anuncios', 'idimagen', 'idanuncio');
    }
}
