<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
   	protected $table = 'citas';

    protected $primaryKey = 'idcita';

    public $timestamps = false;

    protected $fillable = [
        'idanuncio',
        'idusuario',
        'fecha',
        'horaini',
        'horafin'
    ];
}
