<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UseradminProvincia extends Model
{

    protected $table='usersAdminProvincia';

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
    
   public function ProvinciasGestionaAdminProv()
    {
            return $this->hasMany('App\Provincia','idresponsable','id');

    }
}
