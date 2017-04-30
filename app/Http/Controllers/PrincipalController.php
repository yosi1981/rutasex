<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Provincia;
use App\Poblacion;
use App\User;
use App\Anuncio;
use App\AnuncioDia;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProvinciaFormRequest;
use DB;

class PrincipalController extends Controller
{
    public function __construct()
    {

    }

    public function show ($id)
    {

    }

    public function mostrarAnuncios($id=1)
    {
            $provincia=$id;
            if ($provincia<1) 
            {
                $provincia=1;
            }   
            $fechaact=getdate();
    		$fechaactual=$fechaact['year']."-".$fechaact['mon']."-".$fechaact['mday'];
    		$preanuncios=DB::table('anuncios')
    		->join('localidades','anuncios.idlocalidad','=','localidades.idlocalidad')
    		->select('anuncios.idanuncio','anuncios.titulo','anuncios.descripcion','anuncios.fechainicio','anuncios.fechafinal','anuncios.activo','anuncios.idlocalidad','localidades.nombre as NombreLocalidad','anuncios.idusuario','localidades.idprovincia')
            ->where('localidades.idprovincia','=',$provincia) //filtramos la localidad
            ->where(function($query) use ($fechaactual)
            {
                $query->where('anuncios.activo','=','1')
                      ->orwhere('anuncios.fechainicio',"=",$fechaactual);
            })
            ->get();

            $ayer= date("Y-m-d", strtotime("$fechaactual - 1 day"));
            $i=-1;
            foreach ($preanuncios as $anu) {
                $i=$i+1;
            	$anuncio=new Anuncio();
            	$anuncio=Anuncio::findorfail($anu->idanuncio);

            	if($anu->activo==0) 
            	{
            		$anuncio->activo=1;
            		$anuncio->save();

            	}
            	else
            	{

            		if($anu->fechafinal==$ayer) //si sigue activo, pero el final era ayer, lo desactivamos y no lo mostramos
            		{

            			$anuncio->activo =0;
            			$anuncio->save();
                        unset($preanuncios[$i]);
            		}
            	}
            }

            foreach ($preanuncios as $an) 
            {
                
            $anDia=DB::table('anunciosDia')
            ->select('idanuncioDia','fecha','idanuncio','idlocalidad','idrespprov','idrespprovorigen','numvisitas')
            ->where('fecha','=',$fechaactual)
            ->where('idanuncio','=',$an->idanuncio)             //este ya activado
            ->where('idlocalidad','=',$an->idlocalidad) //filtramos la localidad
            ->first();


                if(count($anDia)==1)
                {
                    $newandia= new AnuncioDia();
                    $newandia=AnuncioDia::findorfail($anDia->idanuncioDia);
                    $newandia->numvisitas=$newandia->numvisitas+1;
                    $newandia->update();
                }
                else
                {
                    $newandia=new AnuncioDia();
                    $newandia->idanuncio=$an->idanuncio;
                    $newandia->fecha=$fechaactual;
                    $newandia->idlocalidad=$an->idlocalidad;
                    $poblacion=Poblacion::findorfail($an->idlocalidad);
                    $provincia=Provincia::findorfail($poblacion->idprovincia);
                    $responsable=User::findorfail($provincia->idresponsable);
                    $newandia->idrespprov=$provincia->idresponsable;
                    $newandia->idrespprovorigen=$provincia->idresponsable;
                    $newandia->numvisitas=1;
                    $newandia->save();
                }
            }
            $provincias=DB::table('provincias')
            ->select('idprovincia','nombre')
            ->where('habilitado','=','1')
            ->get();

    		return view('publico.mostrarAnunciosProvincia',["anuncios"=>$preanuncios,"provincias"=>$provincias,"provincia"=>$provincia]);
    }

}