<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user();

        switch ($usuario->tipo_usuario) {
            case 1:
                return Redirect::to('/anunciante/dashboard');
            case 2:
                return Redirect::to('/adminProvincia/dashboard');
            case 3:
                return Redirect::to('/delegado/dashboard');
            case 4:
                return Redirect::to('/admin/dashboard');
        }

    }
}
