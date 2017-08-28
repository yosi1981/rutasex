<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cita;
use DB;

class CitaController extends Controller
{
    public function listadoCitas()
    {
    	$citas=db::table('citas')
    		->select('idcita','idanuncio as id','idusuario','fecha+horaini+horafin as start')
    		->orderBy('horaini');
    	return view('pruebas.pruebafullcalendar',["citas" => $citas]);

    }
}
