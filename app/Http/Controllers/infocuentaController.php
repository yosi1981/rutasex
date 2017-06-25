<?php

namespace App\Http\Controllers;

use Auth;

class infocuentaController extends Controller
{
    //
    public function InfoReferidos()
    {
        $usuarioActual = Auth::user();
        \Session::put('seccion_actual', 'infocuenta');
        return view($usuarioActual->stringRol->nombre . '.InfoCuenta.infocuenta', ["usuario" => $usuarioActual]);
    }
}
