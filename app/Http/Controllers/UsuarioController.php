<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioFormRequest;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mail;

class UsuarioController extends Controller
{
    public function CrearUsuario()
    {

        return view("usuario.NuevoUsuario");

    }
    public function NuevoUsuario(UsuarioFormRequest $request)
    {
        $usuario               = new User;
        $usuario->name         = $request->get('nombre');
        $usuario->email        = $request->get('email');
        $usuario->password     = bcrypt($request->get('password'));
        $usuario->tipo_usuario = 1;
        $usuario->activo       = 1;
        Mail::send('emails.nuevoUsuario', ['nombre' => $usuario->name, 'email' => $usuario->email, 'tipo_usuario' => $usuario->tipo_usuario], function ($msj) {
            $msj->subject('NUEVO USUARIO ');
            $msj->to('info@latiendadeyosi.com');
            $msj->attach('imagenes/1.jpg');
        });

        $usuario->save();

        return Redirect::to('Usuario');
    }

    public function IniciarSesion($id)
    {
        $usuario = User::findOrFail($id);
        Auth::login($usuario);
        return Redirect::to('Usuario');

    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view("usuario.edit", ["usuario" => $usuario]);

        //Provincia::findOrFail($id)]);
    }

    public function update(UsuarioFormRequest $request, $id)
    {
        $usuario               = new User;
        $usuario               = User::findOrFail($id);
        $usuario->name         = $request->get('nombre');
        $usuario->email        = $request->get('email');
        $usuario->tipo_usuario = 1;
        $usuario->activo       = 1;
        $usuario->update();

        return Redirect::to('Usuario');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            /*$usuarios = DB::table('users')->where('name', 'LIKE', '%' . $request->get('searchText') . '%')
                ->orderBy('name', 'asc')
                ->paginate(5);
            */
                $usuarios=User::where('name', 'LIKE', '%' . $request->get('searchText') . '%')
                ->orderBy('name', 'asc')
                ->paginate(5);
            if ($usuarios) {
                $salida = view('usuario.tablaUsuarios', compact('usuarios', 'searchText'))->render();
                return response()->json($salida);
            }
        }
    }

    public function index(Request $request)
    {
        if ($request) {
            $query    = trim($request->get('searchText'));
            /*$usuarios = DB::table('users')->where('name', 'LIKE', '%' . $query . '%')
                ->orderBy('name', 'asc')
                ->paginate(5);
            */
                $usuarios=User::where('name', 'LIKE', '%' . $request->get('searchText') . '%')
                ->orderBy('name', 'asc')
                ->paginate(5);                
            return view('usuario.index', ["usuarios" => $usuarios, "searchText" => $query]);
        }

    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return Redirect::to('Usuario');
    }
    public function eliminar(Request $req)
    {
        $usuario = User::findOrFail($req->id);
        $usuario->delete();
        return response()->json();
    }
}
