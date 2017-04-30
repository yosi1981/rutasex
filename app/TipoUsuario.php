<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
   protected $table='tipos_usuario';

    protected $primaryKey='id';

    public $timestamps=false;

    protected $fillable =[
    	'nombre',

    ];

    protected $guarded=[
    ];
}
