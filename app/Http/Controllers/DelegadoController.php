<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DelegadoController extends Controller
{
    public function Dashboard()
    {
        return view("delegado.Dashboard");

    }

}
