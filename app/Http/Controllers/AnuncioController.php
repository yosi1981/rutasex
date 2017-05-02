<?php

namespace App\Http\Controllers;

use App\Anuncio;
use App\Http\Requests\AnuncioFormRequest;
use App\Poblacion;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AnuncioController extends Controller
{

    public function CrearAnuncio()
    {
        $localidades = Poblacion::all()->pluck('nombre', 'idlocalidad');
        $usuarios    = User::all()->pluck('name', 'id');
        return view("anuncio.NuevoAnuncio", ["localidades" => $localidades, "usuarios" => $usuarios]);

    }

    public function NuevoAnuncio(AnuncioFormRequest $request)
    {
        $anuncio              = new anuncio;
        $anuncio->titulo      = $request->get('titulo');
        $anuncio->descripcion = $request->get('descripcion');
        $anuncio->fechainicio = $request->get('fechainicio');
        $anuncio->fechafinal  = $request->get('fechafinal');
        $anuncio->activo      = 1;
        $anuncio->idlocalidad = $request->get('idlocalidad');
        $anuncio->idusuario   = $request->get('idusuario');
        $anuncio->save();
        return Redirect::to('Anuncio');

    }

    public function edit($id)
    {
        $anuncio     = anuncio::findOrFail($id);
        $localidades = Poblacion::all()->pluck('nombre', 'idlocalidad');
        $usuarios    = User::all()->pluck('name', 'id');
        return view("anuncio.edit", ["anuncio" => $anuncio, "localidades" => $localidades, "usuarios" => $usuarios]);

        //Provincia::findOrFail($id)]);
    }

    public function update(AnuncioFormRequest $request, $id)
    {
        $anuncio = new anuncio;
        $anuncio = anuncio::findOrFail($id);

        $anuncio->titulo      = $request->get('titulo');
        $anuncio->descripcion = $request->get('descripcion');
        $anuncio->fechainicio = $request->get('fechainicio');
        $anuncio->fechafinal  = $request->get('fechafinal');
        if ($request->get('activo')) {
            $anuncio->activo = 1;
        } else {
            $anuncio->activo = 0;
        }
        $anuncio->idlocalidad = $request->get('idlocalidad');
        $anuncio->idusuario   = $request->get('idusuario');
        $anuncio->update();

        return Redirect::to('Anuncio');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query    = trim($request->get('searchText'));
            $anuncios = DB::table('anuncios')
                ->join('localidades', 'anuncios.idlocalidad', '=', 'localidades.idlocalidad')
                ->join('users', 'anuncios.idusuario', '=', 'users.id')
                ->select('anuncios.idanuncio', 'anuncios.titulo', 'anuncios.descripcion', 'anuncios.fechainicio', 'anuncios.fechafinal', 'anuncios.activo', 'anuncios.idlocalidad', 'localidades.nombre as NombreLocalidad', 'anuncios.idusuario', 'users.name as NombreUsuario')
                ->where('anuncios.titulo', 'LIKE', '%' . $query . '%')
                ->orderBy('anuncios.titulo', 'asc')
                ->paginate(5);

            if ($anuncios) {
                $salida = view('anuncio.tablaAnuncios', compact('anuncios', 'searchText'))->render();
                return response()->json($salida);
            }
        }
    }

    public function index(Request $request)
    {

        if ($request) {
            $query = trim($request->get('searchText'));
/*            $anuncios = DB::table('anuncios')->where('titulo', 'LIKE', '%' . $query . '%')
->orderBy('titulo', 'asc')
->paginate(5);
return view('anuncio.index', ["anuncios" => $anuncios, "searchText" => $query]);
 */
            $anuncios = DB::table('anuncios')
                ->join('localidades', 'anuncios.idlocalidad', '=', 'localidades.idlocalidad')
                ->join('users', 'anuncios.idusuario', '=', 'users.id')
                ->select('anuncios.idanuncio', 'anuncios.titulo', 'anuncios.descripcion', 'anuncios.fechainicio', 'anuncios.fechafinal', 'anuncios.activo', 'anuncios.idlocalidad', 'localidades.nombre as NombreLocalidad', 'anuncios.idusuario', 'users.name as NombreUsuario')
                ->where('anuncios.titulo', 'LIKE', '%' . $query . '%')
                ->orderBy('anuncios.titulo', 'asc')
                ->paginate(5);
            return view('anuncio.index', ["anuncios" => $anuncios, "searchText" => $query]);
        }

    }

    public function destroy($id)
    {
        $anuncio = anuncio::findOrFail($id);
        $anuncio->delete();
        return Redirect::to('Anuncio');
    }
    public function eliminar(Request $req)
    {
        $anuncio = anuncio::findOrFail($req->id);
        $anuncio->delete();
        return response()->json();
    }
}
