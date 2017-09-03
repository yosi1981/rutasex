<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnuncioDia extends Model
{

    protected $table='anunciosDia';

    protected $primaryKey='idanuncioDia';

    public $timestamps=false;

    protected $fillable =[
    	'fecha',
    	'idanuncio',
    	'idlocalidad',
        'idprovincia',
    	'idadminProv',
    	'iddelegado',
        'idpartner',
        'idlocalidad',
        'idanunciante',
    	'numvisitas',
    ];

    protected $guarded=[
    ];

    public function AnuncioProvincia()
    {
        return $this->belongsTo('App\Provincia','idprovincia','idprovincia');
    }

    public function AnuncioAdminProvincia()
    {
        return $this->belongsTo('App\UseradminProvincia','id','idadminProv');
    }

    public function AnuncioDelegadoProvincia()
    {
        return $this->belongsTo('App\Userdelegado','id','iddelegado');
    }

    public function AnuncioPartner()
    {
        return $this->belongsTo('App\User','id','idpartner');
    }

    public function AnuncioAnunciante()
    {
        return $this->belongsTo('App\Useranunciante','id','idanunciante');
    }
}

