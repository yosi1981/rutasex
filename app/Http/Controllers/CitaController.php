<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cita;
use Auth;
use DB;

class CitaController extends Controller
{
    public function listadoCitas()
    {
    	$citas=Cita::all();


        $data = array(); //declaramos un array principal que va contener los datos

		foreach($citas as $cita)
		{
			array_push($data,array("title"=>$cita->idanuncio,"start"=>$cita->fecha.$cita->horaini));
		} 
  
        /*return response()->json($data); //para luego retornarlo y estar listo para consumirlo*/
        return view('pruebas.pruebafullcalendar');
    }

    private function horareservada($hora,$citas)
    {
    	$horacomprobar=date('H:i:s',$hora);
    	$reservada=false;
    	foreach ($citas as $cita)
    	{
    		if($horacomprobar>=$cita->horaini and $horacomprobar<=$cita->horafin)
    		{
    			$reservada=true;
    		}
    	}
    	return $reservada;
    }

     public function CitasAnuncioFecha($id,$fecha)
    
    {
    	$reservados=array();
    	$idusuario=Auth::user()->id;

    	$citas=Cita::all()
    			->where('idanuncio','=',$id)
    			->where('fecha','=',$fecha)
    			->where('idusuario','<>',$idusuario);

  		$hora="00:00:00";
  		$ocupado=false;
  		$reservado=false;
  		for($i=0;$i<4;$i++)
  		{
  			for($j=0;$j<24;$j++)
  			{
  				$hora=$hora+(15*60);

  				$reservado=$this->horareservada($hora,$citas);
  				if($reservado==true)
  				{
  					if($ocupado==false)
  					{
  						$ocupado=true;
  						$horainicial=date('H:i',$hora);
  					}
  				}
  				else
  				{
  					if($ocupado==true)
  					{
  						$horafinal=date('H:i',$hora-(15*60));
  						array_push($reservados,array("title"=>"ocupado","start"=>$fecha." ".$horainicial,"end"=>$fecha." ".$horafinal,"color"=>'green'));
  						$ocupado=false;
  					}
  				}
  			}
  		} 

  		  	$citasusuario=Cita::all()
    			->where('idanuncio','=',$id)
    			->where('fecha','=',$fecha)
    			->where('idusuario','=',$idusuario);
    	foreach($citasusuario as $ctusuario)
    	{
    		array_push($reservados,array("title"=>$ctusuario->idusuario,"start"=>$fecha." ".$ctusuario->horaini,"end"=>$ctusuario->horafin,"color"=>'blue'));
    	}
        return response()->json($reservados); //para luego retornarlo y estar listo para consumirlo
    }


}
