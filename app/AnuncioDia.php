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
    	'idrespprov',
    	'idrespprovorigen',
    	'numvisitas',
    ];

    protected $guarded=[
    ];
}

