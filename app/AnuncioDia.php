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
        return $this->hasOne('App\Poblacion','idlocalidad','idlocalidad');
    }

    public function AnuncioAdminProvincia()
    {
        return $this->hasOne('App\UseradminProvincia','id','idadminProv');
    }

    public function AnuncioDelegadoProvincia()
    {
        return $this->hasOne('App\Userdelegado','id','iddelegado');
    }

    public function AnuncioPartner()
    {
        return $this->hasOne('App\User','id','idpartner');
    }

    public function AnuncioAnunciante()
    {
        return $this->hasOne('App\Useranunciante','id','idanunciante');
    }
}

