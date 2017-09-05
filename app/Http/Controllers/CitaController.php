<?php

namespace App\Http\Controllers;

use App\Anuncio;
use App\Cita;
use App\user;
use Auth;

class CitaController extends Controller
{
    public function listadoCitas($id)
    {
        $usuarioactual = Auth::user();
        $anuncioactual = Anuncio::findorfail($id);

        /*return response()->json($data); //para luego retornarlo y estar listo para consumirlo*/
        return view($usuarioactual->stringRol->nombre . '.cita.index', ["anuncio" => $anuncioactual]);
    }

    private function horareservada($hora, $citas)
    {
        $horacomprobar = date('H:i:s', $hora);
        $reservada     = false;
        foreach ($citas as $cita) {
            if ($horacomprobar >= $cita->horaini and $horacomprobar <= $cita->horafin) {
                $reservada = true;
            }
        }
        return $reservada;
    }
    public function CitasAnuncio($id)
    {
        $reservados = array();
        $idusuario  = Auth::user()->id;

        $citas = Cita::all()
            ->where('idanuncio', '=', $id);

        foreach ($citas as $cita) {
            array_push($reservados, array("title" => $cita->idusuario, "start" => $cita->fecha . " " . $cita->horaini, "end" => $cita->fecha . " " . $cita->horafin, "color" => 'blue'));
        }

        return response()->json($reservados); //para luego retornarlo y estar listo para consumirlo
    }
    public function CitasAnuncioFechaUsuario($id, $fecha)
    {
        $reservados = array();
        $idusuario  = Auth::user()->id;

        $citas = Cita::all()
            ->where('idanuncio', '=', $id)
            ->where('fecha', '=', $fecha)
            ->where('idusuario', '<>', $idusuario);

        $hora      = 0;
        $ocupado   = false;
        $reservado = false;
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 24; $j++) {
                $hora = $hora + (15 * 60);

                $reservado = $this->horareservada($hora, $citas);
                if ($reservado == true) {
                    if ($ocupado == false) {
                        $ocupado     = true;
                        $horainicial = date('H:i', $hora);
                    }
                } else {
                    if ($ocupado == true) {
                        $horafinal = date('H:i', $hora - (15 * 60));
                        array_push($reservados, array("title" => "ocupado", "start" => $fecha . " " . $horainicial, "end" => $fecha . " " . $horafinal, "color" => 'green'));
                        $ocupado = false;
                    }
                }
            }
        }

        $citasusuario = Cita::all()
            ->where('idanuncio', '=', $id)
            ->where('fecha', '=', $fecha)
            ->where('idusuario', '=', $idusuario);

        foreach ($citasusuario as $ctusuario) {
            array_push($reservados, array("title" => $ctusuario->idusuario, "start" => $fecha . " " . $ctusuario->horaini, "end" => $fecha . " " . $ctusuario->horafin, "color" => 'blue'));
        }
        return response()->json($reservados); //para luego retornarlo y estar listo para consumirlo
    }

}
