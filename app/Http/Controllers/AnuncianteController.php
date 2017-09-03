<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnuncianteController extends Controller
{
    public function Dashboard()
    {
        return view("anunciante.Dashboard");

    }

}
