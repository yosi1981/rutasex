<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProvinciaFormRequest;
use App\Provincia;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProvinciaController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
/*            $provincias=DB::table('provincias')->where('nombre','LIKE','%'.$query.'%')
->orderBy('nombre','asc')
->paginate(5);
 */
            $provincias = DB::table('provincias')
                ->join('users', 'provincias.idresponsable', '=', 'users.id')
                ->select('provincias.idprovincia', 'provincias.nombre', 'provincias.idresponsable', 'users.name as NombreUsuario', 'provincias.habilitado')
                ->where('provincias.nombre', 'LIKE', '%' . $query . '%')
                ->orderBy('provincias.nombre', 'asc')
                ->paginate(5);
            $delegados = User::where('tipo_usuario', '=', '3')->pluck('name', 'id');
            $admPro = User::where('tipo_usuario', '=', '2')->pluck('name', 'id');
            \Alert::message('this is a test message', 'info');
            return view('provincia.index', ["provincias" => $provincias, "searchText" => $query, "delegados" => $delegados,"admPro" => $admPro]);
        }

    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $query      = trim($request->get('searchText'));
            $provincias = DB::table('provincias')
                ->join('users', 'provincias.idresponsable', '=', 'users.id')
                ->select('provincias.idprovincia', 'provincias.nombre', 'provincias.idresponsable', 'users.name as NombreUsuario', 'provincias.habilitado')
                ->where('provincias.nombre', 'LIKE', '%' . $query . '%')
                ->orderBy('provincias.nombre', 'asc')
                ->paginate(5);

            if ($provincias) {
                $salida = view('provincia.tablaProvincias', compact('provincias', 'searchText'))->render();
                return response()->json($salida);
            }
        }
    }

    public function create()
    {

        return view("provincia.create", ["usuarios" => $usuarios]);
    }

    public function store(ProvinciaFormRequest $request)
    {
        $provincia                = new Provincia;
        $provincia->nombre        = $request->get('nombre');
        $provincia->idresponsable = $request->get('idresponsable');
        $provincia->habilitado    = '1';
        $provincia->save();
        return Redirect::to('/admin/Provincia');
    }

    public function nuevaProvincia(ProvinciaFormRequest $request)
    {
        if ($request->ajax()) {
            $provincia                = new Provincia;
            $provincia->nombre        = $request->get('nombre');
            $provincia->idresponsable = $request->get('idadmPro');
            $provincia->iddelegado    = $request->get('iddelegado');
            if ($request->get('habilitado')) {
                $provincia->habilitado = '1';
            } else {
                $provincia->habilitado = '0';
            }
            $provincia->save();
            return response()->json($provincia);
        }
    }

    public function show($id)
    {
        return view("provincia.show", ["provincia" => Provincia::findOrFail($id)]);
    }
    public function edit($id)
    {
        $query       = "";
        $provincia   = Provincia::findOrFail($id);
        $poblaciones = $provincia->localidades;
        $delegados    = User::where('tipo_usuario', '=', '3')->pluck('name', 'id');
        $delegado     = $provincia->iddelegado;
        $admPros    = User::where('tipo_usuario', '=', '2')->pluck('name', 'id');
        $admPro     = $provincia->idresponsable;

        //     $poblaciones=DB::table('localidades')-where('nombre','LIKE','%'.$query.'%')
        //    ->where('idprovincia','=',$id)
        //    ->orderBy('nombre','asc')
        //    ->paginate(50); //
        return view("provincia.edit", ["poblaciones" => $poblaciones, "provincia" => $provincia, "delegados" => $delegados, "delegado" => $delegado, "admPros" => $admPros, "admPro" => $admPro]);

        //Provincia::findOrFail($id)]);
    }
    public function update(ProvinciaFormRequest $request, $id)
    {
        $provincia         = Provincia::findOrFail($id);
        $provincia->nombre = $request->get('nombre');
        if ($request->get('habilitado')) {
            $provincia->habilitado = '1';
        } else {
            $provincia->habilitado = '0';
        }
        $provincia->iddelegado = $request->get('iddelegado');
        $provincia->idresponsable = $request->get('idadmPro');
        $provincia->update();
        return Redirect::to('/admin/Provincia');

    }
    public function destroy($id)
    {
        $provincia             = provincia::findOrFail($id);
        $provincia->habilitado = 0;
        $provincia->update();
        return Redirect::to('/admin/Provincia');
    }
    public function eliminar(Request $req)
    {
        $provincia             = provincia::findOrFail($req->id);
        $provincia->habilitado = 0;
        $provincia->update();
        return response()->json($provincia);
    }

}
