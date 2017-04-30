<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poblacion extends Model
{
    protected $table='localidades';

    protected $primaryKey='idlocalidad';

    public $timestamps=false;

    protected $fillable =[
    	'nombre',
    	'idprovincia',
    ];

    protected $guarded=[
    ];

    public function provincia()
    {
        return $this->belongsTo('App\Provincia','idprovincia','idprovincia');
    }
}
