<?php

namespace App\Http\Controllers;

use App\Http\Requests\PoblacionFormRequest;
use App\Poblacion;
use App\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PoblacionController extends Controller
{
    public function __construct()
    {

    }
    public function probando()
    {

    }

    public function show($id)
    {

        return view('poblacion.create', ["provincia" => Provincia::findOrFail($id)]);
    }

    public function selectLocalidades(request $request)
    {
        $provincia   = new Provincia;
        $provincia   = Provincia::findorfail($request->get('id'));
        $poblaciones = $provincia->localidades;
        if ($poblaciones) {
            $salida = view('poblacion.selectPoblaciones', compact('poblaciones', 'provincia'))->render();
            return response()->json($salida);

        }
    }
    public function getPoblacionesProvincia(request $request)
    {
        if ($request->ajax()) {
            $provincia   = new Provincia;
            $provincia   = Provincia::findorfail($request->get('id'));
            $poblaciones = $provincia->localidades;
            if ($poblaciones) {
                $salida = view('poblacion.tablaPoblaciones', compact('poblaciones', 'provincia'))->render();
                return response()->json($salida);

            }
        }
    }

    public function editar(request $request)
    {

        $poblacion = new poblacion;
        $poblacion = poblacion::findOrFail($request->id);
        $provincia = provincia::findorfail($poblacion->idprovincia);
        $salida    = view('poblacion.edit', compact('poblacion', 'provincia'))->render();
        return response()->json($salida);
    }

    public function actualizar(PoblacionFormRequest $request)
    {
        if ($request->ajax()) {
            $poblacion              = new poblacion;
            $poblacion              = poblacion::findOrFail($request->get('idlocalidad'));
            $poblacion->nombre      = $request->get('nombre');
            $poblacion->idprovincia = $request->get('idprovincia');
            $poblacion->update();
            return response()->json();
        }
    }
    public function store(PoblacionFormRequest $request)
    {
        $poblacion              = new poblacion;
        $poblacion->idprovincia = $request->get('idprovincia');
        $poblacion->nombre      = $request->get('nombre');
        $poblacion->save();
        return Redirect::to('/admin/Provincia');
    }

    public function nuevaPoblacion(PoblacionFormRequest $request)
    {
        if ($request->ajax()) {
            $poblacion              = new poblacion;
            $poblacion->nombre      = $request->get('nombre');
            $poblacion->idprovincia = $request->get('idprovioculto');
            $poblacion->save();
            return response()->json($poblacion);
        }
    }

    public function edit($id)
    {
        $pobla = new poblacion;
        $provi = new provincia;
        $pobla = poblacion::findOrFail($id);
        $provi = provincia::findOrFail($pobla->idprovincia);

        return view("poblacion.edit", ["provincia" => $provi, "poblacion" => $pobla]);
    }
    public function update(PoblacionFormRequest $request)
    {
        $poblacion         = poblacion::findOrFail($id);
        $poblacion->nombre = $request->get('nombre');
        $poblacion->update();
        return Redirect::to('/admin/Provincia');
    }

    public function destroy($id)
    {
        $poblacion = poblacion::findOrFail($id);
        $poblacion->delete();
        return Redirect::to('/admin/Provincia');
    }
    public function eliminar(Request $req)
    {
        $poblacion = poblacion::findOrFail($req->id);
        $poblacion->delete();
        return response()->json();
    }
}
