<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller {

    public function examenEstudiante($idcurso, $idseccion) {
        $idusuario = Auth::user()->idusuario;
        $examen = DB::table('examen')
                ->join('seccion as s', 's.idseccion', '=', 'examen.idseccion')
                ->select('examen.idexamen','examen.titulo')
                ->where([['examen.idcurso', '=', $idcurso],['examen.idseccion', '=', $idseccion],['examen.estado', '=', '1']])->get();
        return json_encode(['data' => $recursos]);
    }
}
