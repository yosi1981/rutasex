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
        $usuarios    = User::all()->where('tipo_usuario','=',1)->pluck('name', 'id');
        return view("admin.anuncio.nuevoAnuncio.NuevoAnuncio", ["localidades" => $localidades, "usuarios" => $usuarios]);

    }

    public function NuevoAnuncio(AnuncioFormRequest $request)
    {
        $data=$request->get('ch');
        $anuncio              = new anuncio;
        $anuncio->titulo      = $request->get('titulo');
        $anuncio->descripcion = $request->get('descripcion');
        $anuncio->fechainicio = $request->get('fechainicio');
        $anuncio->fechafinal  = $request->get('fechafinal');
        $anuncio->activo      = 1;
        $anuncio->idlocalidad = $request->get('idlocalidad');
        $anuncio->idusuario   = $request->get('idusuario');
        $anuncio->save();

        //sincronizamos la tabla pivote imagenes_anuncios automaticamente pasandole el array
        //de checkboxes pasados (ids de imagenes pasadas junto al idanuncio)

        $anuncio->ImagenesAnuncio()->sync($data);

        return Redirect::to('/admin/Anuncio');

    }

    public function edit($id)
    {
        $anuncio     = anuncio::findOrFail($id);
        $localidades = Poblacion::all()->pluck('nombre', 'idlocalidad');
        $usuarios    = User::all()->pluck('name', 'id');
        return view("admin.anuncio.editAnuncio.edit", ["anuncio" => $anuncio, "localidades" => $localidades, "usuarios" => $usuarios]);

        //Provincia::findOrFail($id)]);
    }

    public function update(AnuncioFormRequest $request, $id)
    {
        $data = $request->get('ch');
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


        $anuncio->ImagenesAnuncio()->sync($data);

        return Redirect::to('/admin/Anuncio');
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
                $salida = view('admin.anuncio.includes.tablaAnuncios', compact('anuncios', 'searchText'))->render();
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
            return view('admin.anuncio.index', ["anuncios" => $anuncios, "searchText" => $query]);
        }

    }

    public function destroy($id)
    {
        $anuncio = anuncio::findOrFail($id);
        $anuncio->delete();
        return Redirect::to('/admin/Anuncio');
    }
    public function eliminar(Request $req)
    {
        $anuncio = anuncio::findOrFail($req->id);
        $anuncio->ImagenesAnuncio()->sync(array());
        $anuncio->delete();
        return response()->json();
    }
}
