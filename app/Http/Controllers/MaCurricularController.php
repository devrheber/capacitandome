<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MallaCurricular;
use App\Models\Curso;
use App\Http\Requests\MaCurricularRequest;

class MaCurricularController extends Controller {
    
    public function index(){
        return \view('admin.malla-curricular.listar');
    }

    public function mallaCurPaginate(Request $request) {
        $filtro_search   = $request->filtro_search;
        $mallacurricular = MallaCurricular::join('curso', 'malla_curricular.idcurso', '=', 'curso.idcurso')
                            ->where("malla_curricular.estado",1)
                            ->where('curso.titulo', 'like', "%{$filtro_search}%")->orderBy('malla_curricular.idmalla_curricular', 'desc')
                            ->distinct()
                            ->paginate(10);
        return \view('admin.malla-curricular.tabla_paginate_malla', compact('mallacurricular','filtro_search'))->render();
    }

    public function create() {
        $cursos = Curso::where('estado',1)->get();
        return \view('admin.malla-curricular.crear', compact('cursos'));
    }

    public function store(MaCurricularRequest $request) {
        $idcurso        = $request->input('idcurso');
        $examen_final   = $request->input('examen_final');
        $trabajo_final  = $request->input('trabajo_final');

        $suma = $examen_final + $trabajo_final;
        if ($suma == 100) {

            $mallacur   = MallaCurricular::where([['estado','=',1],['idcurso','=',$idcurso]])->first();
            $curso      = Curso::where([['estado','=',1],['idcurso','=',$idcurso]])->first();

            if (empty($mallacur)) {                
                $maCurr = new MallaCurricular();
                $maCurr->idcurso               = $idcurso;
                $maCurr->puntaje_trabajo_final = $trabajo_final;
                $maCurr->puntaje_examen_final  = $examen_final;
                $maCurr->save();
                return redirect()->route('admin_index_macurricular')->with('success','Se ha registrado correctamente los puntajes asignados.');
            } else {
                return redirect()->back()->with('error','YA EXISTE UN PUNTAJE ASIGNADO PARA EL CURSO : '.$curso->titulo.' | Examen = '.$mallacur->puntaje_examen_final.'% , Trabajo = '.$mallacur->puntaje_trabajo_final.'%');
            }
            
        } else {
            return redirect()->back()->with('error','EL PUNTAJE EXAMEN FINAL + PUNTAJE TRABAJO FINAL DEBE SER IGUAL AL 100%. VUELVA A INGRESAR CORRECTAMENTE.');
        }
    }

    public function show($idmallaCurricular) {
        $cursos     = Curso::where('estado',1)->get();
        $mallacur   = MallaCurricular::where([['idmalla_curricular','=',$idmallaCurricular]])->first();
        return \view('admin.malla-curricular.editar', compact('cursos','mallacur'));
    }

    public function update(MaCurricularRequest $request, $id) {
        $idcurso        = $request->input('idcurso');
        $examen_final   = $request->input('examen_final');
        $trabajo_final  = $request->input('trabajo_final');

        $suma = $examen_final + $trabajo_final;
        if ($suma == 100) {

            $maCurr   = MallaCurricular::where([['idmalla_curricular','=',$id]])->first();
            if (!empty($maCurr)) {
                $maCurr->idcurso               = $idcurso;
                $maCurr->puntaje_trabajo_final = $trabajo_final;
                $maCurr->puntaje_examen_final  = $examen_final;
                $maCurr->save();
                return redirect()->route('admin_index_macurricular')->with('success','Se ha actualzado correctamente los puntajes asignados.');
            } else {
                return redirect()->back()->with('error','Asegurese de editar un registro correcto. Vuelva a recargar la página.'.$id);
            }
            
        } else {
            return redirect()->back()->with('error','EL PUNTAJE EXAMEN FINAL + PUNTAJE TRABAJO FINAL DEBE SER IGUAL AL 100%. VUELVA A INGRESAR CORRECTAMENTE.');
        }
    }

    public function delete($id) {
        $maCurr = MallaCurricular::find($id);
        $maCurr->delete();
        return json_encode(["status" => true, "message" => "Se eliminó el registro"]);
    }
}
