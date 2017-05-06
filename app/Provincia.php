<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table='provincias';

    protected $primaryKey='idprovincia';

    public $timestamps=false;

    protected $fillable =[
    	'nombre',
    	'habilitado',
    	'idresponsable'
    ];

    protected $guarded=[
    ];

    public function localidades()
    {
        return $this->hasMany('App\Poblacion','idprovincia','idprovincia');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User','idresponsable','id');
    }
}
