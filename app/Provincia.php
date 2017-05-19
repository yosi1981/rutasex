<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincias';

    protected $primaryKey = 'idprovincia';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'habilitado',
        'idresponsable',
    ];

    protected $guarded = [
    ];

    public function localidades()
    {
        return $this->hasMany('App\Poblacion', 'idprovincia', 'idprovincia');
    }

    public function adminPro()
    {
<<<<<<< HEAD
        return $this->belongsTo('App\UseradminProvincia','idresponsable','id');
=======
        return $this->belongsTo('App\UseradminProvincia', 'idresponsable', 'id');
>>>>>>> 6ce6a9d8997b3edd9ddc9e0f0adf47e61d4eca1b
    }

    public function delegado()
    {
        return $this->belongsTo('App\Userdelegado', 'iddelegado', 'id');
    }

    public function anunciosHistorial()
    {
        return $this->hasMany('App\AnuncioDia', 'idprovincia', 'idprovincia');
    }
}
