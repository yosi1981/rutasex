<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userdelegado extends Model
{

    protected $table='usersDelegado';

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
    
    public function ProvinciasGestionaDelegado()
    {
            return $this->hasMany('App\Provincia','iddelegado','id');
    }
}
