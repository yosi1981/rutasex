<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usercolaborador extends Model
{

    protected $table='usersColaborador';

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
    

}
