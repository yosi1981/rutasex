<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioFormRequest;
use App\Mail\verifyEmail;
use App\TipoUsuario;
use App\User;
use App\Useradmin;
use App\UseradminProvincia;
use App\Useranunciante;
use App\Usercolaborador;
use App\Userdelegado;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mail;

class UsuarioController extends Controller
{
    public function CrearUsuario()
    {
        $tipos_usuario = TipoUsuario::where('id', '>', 0)->OrderBy('descripcion')
            ->pluck('descripcion', 'id');
        return view("usuario.NuevoUsuario", ["TiposUsuario" => $tipos_usuario]);

    }
    public function NuevoUsuario(UsuarioFormRequest $request)
    {
        $usuario               = new User;
        $usuario->name         = $request->get('nombre');
        $usuario->email        = $request->get('email');
        $usuario->password     = bcrypt($request->get('password'));
        $usuario->tipo_usuario = $request->get('idTipousuario');
        $usuario->token        = Str_random(40);
        $usuario->status       = 0;
        /*
        Mail::send('emails.nuevoUsuario', ['nombre' => $usuario->name, 'email' => $usuario->email, 'tipo_usuario' => $usuario->tipo_usuario], function ($msj) {
        $msj->subject('NUEVO USUARIO ');
        $msj->to('info@latiendadeyosi.com');
        $msj->attach('imagenes/1.jpg');
        });
         */

        $usuario->save();

        if ($usuario->tipo_usuario == 1) {
            $usuDatos            = new Useranunciante;
            $usuarioActual       = new User;
            $usuarioActual       = Auth::user();
            $usuDatos->id        = $usuario->id;
            $usuDatos->idpartner = $usuarioActual->id;
            $usuDatos->save();
        }
        if ($usuario->tipo_usuario == 2) {
            $usuDatos     = new UseradminProvincia;
            $usuDatos->id = $usuario->id;
            $usuDatos->save();
        }
        if ($usuario->tipo_usuario == 3) {
            $usuDatos     = new Userdelegado;
            $usuDatos->id = $usuario->id;
            $usuDatos->save();

        }
        if ($usuario->tipo_usuario == 4) {
            $usuDatos     = new Useradmin;
            $usuDatos->id = $usuario->id;
            $usuDatos->save();

        }
        if ($usuario->tipo_usuario == 5) {
            $usuDatos     = new Usercolaborador;
            $usuDatos->id = $usuario->id;
            $usuDatos->save();

        }

        Mail::to($usuario['email'])->send(new verifyEmail($usuario));

        return Redirect::to('/admin/Usuario');
    }

    public function IniciarSesion($id)
    {
        $usuario = User::findOrFail($id);
        Auth::login($usuario);
        return Redirect::to('/admin/Usuario');

    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view("admin.usuario.editUsuario.edit", ["usuario" => $usuario]);

        //Provincia::findOrFail($id)]);
    }

    public function update(UsuarioFormRequest $request, $id)
    {
        $usuario        = new User;
        $usuario        = User::findOrFail($id);
        $usuario->name  = $request->get('nombre');
        $usuario->email = $request->get('email');
        $usuario->update();

        return Redirect::to('/admin/Usuario');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            /*$usuarios = DB::table('users')->where('name', 'LIKE', '%' . $request->get('searchText') . '%')
            ->orderBy('name', 'asc')
            ->paginate(5);
             */
            $usuarios = User::where('name', 'LIKE', '%' . $request->get('searchText') . '%')
                ->orderBy('name', 'asc')
                ->paginate(5);
            if ($usuarios) {
                $salida = view('admin.usuario.includes.tablaUsuarios', compact('usuarios', 'searchText'))->render();
                return response()->json($salida);
            }
        }
    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('searchText'));
            /*$usuarios = DB::table('users')->where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('name', 'asc')
            ->paginate(5);
             */
            $usuarios = User::where('name', 'LIKE', '%' . $request->get('searchText') . '%')
                ->orderBy('name', 'asc')
                ->paginate(5);
  
            return view('admin.usuario.index', ["usuarios" => $usuarios, "searchText" => $query]);
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
