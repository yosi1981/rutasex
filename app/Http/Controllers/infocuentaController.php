<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class infocuentaController extends Controller
{
    //
    public function InfoReferidos()
    {
    	$usuarioActual=Auth::user();
    	return view($usuarioActual->stringRol->nombre.'.InfoCuenta.infocuenta',["usuario"=>$usuarioActual]);
    }
}