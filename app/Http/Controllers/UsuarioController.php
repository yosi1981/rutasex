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
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mail;

class UsuarioController extends Controller
{
    public function CrearUsuario()
    {
        $usuarioactual = Auth::user();
        \Session::put('seccion_actual', "Usuario");
        if ($usuarioactual->tipo_usuario == 4) {
            $tipos_usuario = TipoUsuario::where('id', '>', 0)->OrderBy('descripcion')
                ->pluck('descripcion', 'id');
            return view($usuarioactual->stringRol->nombre . ".usuario.nuevoUsuario.NuevoUsuario", ["TiposUsuario" => $tipos_usuario]);
        } else {
            $tipos_usuario = TipoUsuario::where('id', '=', 1)
                ->OrderBy('descripcion')
                ->pluck('descripcion', 'id');
            return view($usuarioactual->stringRol->nombre . ".usuario.nuevoUsuario.NuevoUsuario", ["TiposUsuario" => $tipos_usuario]);

        }

    }
    public function NuevoUsuario(UsuarioFormRequest $request)
    {
        $ifposible = false;
        if (Auth::user()->tipo_usuario == 4) {
            $ifposible = true;
        } else {
            if ($request->get('idTipousuario') == 1 or $request->get('idTipousuario') == 5) {
                $ifposible = true;
            }
        }

        if ($ifposible == true) {
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
        }

        return Redirect::to('/delegado/Usuario');
    }

    public function IniciarSesion($id)
    {
        $usuario = User::findOrFail($id);
        Auth::login($usuario);
        return Redirect::to('/admin/Usuario');

    }

    public function edit($id)
    {
        $useractual    = Auth::user();
        $usuarioeditar = User::findOrFail($id);
        if ($useractual->tipo_usuario == 4) {
            return view($useractual->stringRol->nombre . ".usuario.editUsuario.edit", ["usuario" => $usuarioeditar]);
        } else {

            if ($usuarioeditar->stringRol->nombre == "anunciante") {
                if ($useractual->tipo_usuario == 1 and $useractual->id == $usereditar->id) {

                } else {
                    $usuarioanun = Useranunciante::findorfail($usuarioeditar->id);
                    if ($usuarioanun->Partner->id == $useractual->id) {
                        return view($useractual->stringRol->nombre . ".usuario.editUsuario.edit", ["usuario" => $usuarioeditar]);
                    }
                }

            }
        }

        //Provincia::findOrFail($id)]);
    }

    public function update(UsuarioFormRequest $request, $id)
    {
        $usuario        = new User;
        $usuario        = User::findOrFail($id);
        $usuario->name  = $request->get('nombre');
        $usuario->email = $request->get('email');
        $usuario->update();

        return Redirect::to('/' . Auth::user()->stringRol->nombre . '/Usuario');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            /*$usuarios = DB::table('users')->where('name', 'LIKE', '%' . $request->get('searchText') . '%')
            ->orderBy('name', 'asc')
            ->paginate(5);
             */

            $query = trim($request->get('searchText'));
            /*$usuarios = DB::table('users')->where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('name', 'asc')
            ->paginate(5);
             */
            $useractual = Auth::user();
            if ($useractual->tipo_usuario == 4) {
                $usuarios = User::where('name', 'LIKE', '%' . $request->get('searchText') . '%')
                    ->orderBy('name', 'asc')
                    ->paginate(5);
                if ($usuarios) {
                    $salida = view($useractual->stringRol->nombre . '.usuario.includes.tablaUsuarios', compact('usuarios', 'searchText'))->render();
                    return response()->json($salida);
                }

            } else {

                $usuarios = DB::table('users')
                    ->join('usersAnunciante', 'users.id', '=', 'usersAnunciante.id')
                    ->select('users.id', 'users.name', 'users.email', 'users.status as activo')
                    ->where('users.tipo_usuario', '=', 1)
                    ->where('users.name', 'LIKE', '%' . $request->get('searchText') . '%')
                    ->where('usersAnunciante.idpartner', '=', $useractual->id)
                    ->orderBy('users.name', 'asc')
                    ->paginate(5);
                if ($usuarios) {
                    dd($useractual->stringRol->nombre);
                    $salida = view($useractual->stringRol->nombre . '.usuario.includes.tablaUsuarios', compact('usuarios', 'searchText'))->render();
                    return response()->json($salida);
                }

            }
        }
    }

    public function index(Request $request)
    {
        \Session::put('seccion_actual', "Usuario");
        if ($request) {
            $query = trim($request->get('searchText'));
            /*$usuarios = DB::table('users')->where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('name', 'asc')
            ->paginate(5);
             */
            $useractual = Auth::user();
            if ($useractual->tipo_usuario == 4) {
                $usuarios = User::where('name', 'LIKE', '%' . $request->get('searchText') . '%')
                    ->orderBy('name', 'asc')
                    ->paginate(5);

                return view($useractual->stringRol->nombre . '.usuario.index', ["usuarios" => $usuarios, "searchText" => $query]);
            } else {

                $usuarios = DB::table('users')
                    ->join('usersAnunciante', 'users.id', '=', 'usersAnunciante.id')
                    ->select('users.id', 'users.name', 'users.email', 'users.status as activo')
                    ->where('users.name', 'LIKE', '%' . $request->get('searchText') . '%')
                    ->where('usersAnunciante.idpartner', '=', $useractual->id)
                    ->orderBy('users.name', 'asc')
                    ->paginate(5);

                return view($useractual->stringRol->nombre . '.usuario.index', ["usuarios" => $usuarios, "searchText" => $query]);
            }

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
