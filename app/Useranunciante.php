<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Useranunciante extends Model
{

    protected $table='usersAnunciante';

    protected $primaryKey='id';

    public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    public function Partner()
    {
        return $this->hasOne('App\User','id','idpartner');
    }
}
