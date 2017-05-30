<?php

namespace App\Http\Controllers;

use App\Imagen;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ImagenController extends Controller
{
    public function index()
    {
        switch (Auth::user()->stringRol->nombre) {
            case 'admin':
                $imagenes = Imagen::all();
                //->short('titulo', 'asc')
                //->paginate(500);
                break;

            case 'anunciante':
                $imagenes = Imagen::where('idusuario', Auth::user()->id)
                    ->orderBy('titulo', 'asc')
                    ->paginate(500);
                break;
        }

        return view(Auth::user()->stringRol->nombre . '/imagen.index', compact('imagenes'));
    }

    public function almacenar(request $request)
    {
        $files = Input::file('filesUpload');
        if (!empty($files)) {
            foreach ($files as $file) {
                $image = \Image::make($file);
                $path  = public_path() . '/imagenes/';

                $image->save($path . $file->getClientOriginalName());
                $image->resize(240, 240);
                $image->save($path . 'thumb_' . $file->getClientOriginalName());

                $newImagen                = new Imagen;
                $newImagen->ficheroimagen = $file->getclientOriginalName();
                $newImagen->titulo        = $file->getClientOriginalName();
                $newImagen->idusuario     = Auth::user()->id;
                $newImagen->save();

            }

        }
    }
    public function eliminar(Request $req)
    {
        $imagen = imagen::findOrFail($req->id);
        if ($imagen->idusuario === Auth::user()->id or Auth::user()->stringRol->nombre = 'admin') {
            $imagen->delete();
            return response()->json();
        }
    }

    public function pruebaIPN()
    {
        return view('paypal.pruebaIPNform');
    }
}
