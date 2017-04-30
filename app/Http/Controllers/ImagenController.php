<?php

namespace App\Http\Controllers;

use App\Imagen;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ImagenController extends Controller
{
    public function index()
    {
        $imagenes = DB::table('imagenes')
            ->orderBy('titulo', 'asc')
            ->paginate(500);
        return view('imagen.index', compact('imagenes'));
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
                $newImagen->idusuario     = 2;
                $newImagen->save();

            }

        }
    }
    public function eliminar(Request $req)
    {
        $imagen = imagen::findOrFail($req->id);
        $imagen->delete();
        return response()->json();
    }
}
