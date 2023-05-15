<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrarTareaRequest;
use App\Models\Curso;
use App\Models\Recurso;
use App\Models\Seccion;
use App\Models\Entregable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RevisarTareaController extends Controller {



    public function indexRevisarTarea($idcurso) {
        $curso        = Curso::where('idcurso', $idcurso)->first();
        $entregable   = DB::table('entregable')->where([['idcurso', $idcurso],['estado', 2]])->select(DB::raw('count(*) as proyFinal'))->first();
        $secciones    = DB::table('entregable')->join('seccion', 'seccion.idseccion', '=', 'entregable.idseccion')
                        ->select('seccion.idseccion','seccion.titulo')
                        ->where([['seccion.idcurso', '=', $idcurso],['entregable.estado', '=', 1]])->distinct()->get();
        return view('web.revisarTareas', compact('curso','secciones','entregable'));
    }

    public function registrarTarea(RegistrarTareaRequest $request) {
        date_default_timezone_set("America/Lima");
        $idusuario = Auth::user()->idusuario;
        if ($request->hasFile('archivo')){
            $file           = $request->file("archivo");
            $nombrearchivo  = $file->getClientOriginalName();
            $extension          = explode(".", $nombrearchivo);
            $nvo_nombre_archivo = round(microtime(true)) . '.' . end($extension);
            $path = Storage::putFileAs(
                'public/tareas', $file, $nvo_nombre_archivo
            );
        }
        $respt = DB::table('entregable')->insert([
            'fecha'     => date("Y/m/d H:i:s"),
            'idusuario' => $idusuario,
            'idseccion' => $request->input('idseccion'),
            'nombre'    => $request->input('titulo'),
            'archivo'   => $nvo_nombre_archivo
        ]);
        return redirect()->back()->with('success','Tarea registrada correctamente.');
    }

    public function elimarTarea($identregable) {
        $idusuario     = Auth::user()->idusuario;
        $nom_archivo   = DB::table('entregable')->where([['identregable', $identregable],['idusuario', $idusuario]])->value('archivo');
        Storage::delete('public/tareas/'.$nom_archivo);
        $tarea         = DB::table('entregable')->where([['identregable', $identregable],['idusuario', $idusuario]])->delete();
        return json_encode(['status' => true,'data'=> $nom_archivo]);
    }

    public function misTareas($idcurso,$idseccion) {
        $idusuario = Auth::user()->idusuario;
        $curso     = Curso::where('idcurso', $idcurso)->first();
        $seccion   = Seccion::where('idseccion', $idseccion)->first();
        $tareas    = DB::table('entregable')->where([['idusuario', '=', $idusuario],['idseccion', '=', $idseccion],['estado', '=', 1]])->orderBy('identregable', 'desc')->get();
        return view('web.misTareas', compact('tareas','curso','seccion'));
    }

    /* PROYECTO FINAL DEL ALUMNO */
    public function proyectoFinal($idcurso,$idseccion) {
        $idusuario = Auth::user()->idusuario;
        $persona   = DB::table('users')->join('persona', 'persona.idpersona', '=', 'users.idpersona')
                    ->select('persona.nombre','persona.apellidos')
                    ->where([['users.idusuario', '=', $idusuario]])->first();
        $curso     = Curso::where('idcurso', $idcurso)->first();
        $tareas    = DB::table('entregable')->where([['idusuario', '=', $idusuario],['idcurso', '=', $idcurso],['estado', '=', 2]])->orderBy('identregable', 'desc')->get();
        return view('web.proyectofinal', compact('persona','curso','tareas'));
    }

    public function registrarProyFinal(RegistrarTareaRequest $request) {
        date_default_timezone_set("America/Lima");
        $idusuario = Auth::user()->idusuario;
        if ($request->hasFile('archivo')){
            $file           = $request->file("archivo");
            $nombrearchivo  = $file->getClientOriginalName();
            $extension          = explode(".", $nombrearchivo);
            $nvo_nombre_archivo = round(microtime(true)) . '.' . end($extension);
            $path = Storage::putFileAs(
                'public/tareas', $file, $nvo_nombre_archivo
            );
        }
        $respt = Entregable::updateOrCreate(
            [
                //'fecha'     => date("Y/m/d H:i:s"),
                'idcurso'   => $request->input('idcurso'),
                'idusuario' => $idusuario,
                //'nombre'    => $request->input('titulo'),
                //'archivo'   => $nvo_nombre_archivo          
            ], [
                'fecha'     => date("Y/m/d H:i:s"),
                'idcurso'   => $request->input('idcurso'),
                'idusuario' => $idusuario,
                'nombre'    => $request->input('titulo'),
                'archivo'   => $nvo_nombre_archivo,
                'estado'   => 2           
            ]
        );
        return redirect()->back()->with('success','Proyecto final registrado correctamente.');
    }

    public function elimarProyFinal($identregable) {
        $idusuario     = Auth::user()->idusuario;
        $nom_archivo   = DB::table('entregable')->where([['identregable', $identregable],['idusuario', $idusuario]])->value('archivo');
        Storage::delete('public/tareas/'.$nom_archivo);
        $tarea         = DB::table('entregable')->where([['identregable', $identregable],['idusuario', $idusuario]])->delete();
        return json_encode(['status' => true,'data'=> $nom_archivo]);
    }
    /* FINAL PROYECTO FINAL DEL ALUMNO */


    public function listaEstudiantes(Request $request, $idcurso, $idseccion, $idusuario = NULL) {
        $curso       = Curso::where('idcurso', $idcurso)->first();
        $seccion     = Seccion::where('idseccion', $idseccion)->first();
        return view('web.estudiantes',compact('curso','seccion'));
    }
    /* EVALUAR TAREAS : DOCENTE */
    public function listEstudiantesPaginate(Request $request, $idcurso, $idseccion) {
        $search      = $request->filtro_search;
        $curso       = Curso::where('idcurso', $idcurso)->first();
        $seccion     = Seccion::where('idseccion', $idseccion)->first();
        $estudiantes = DB::table('venta')->join('curso as c', 'c.idcurso', '=', 'venta.idcurso')
                     ->join('users as u', 'u.idusuario', '=', 'venta.idusuario')
                     ->join('persona as p', 'p.idpersona', '=', 'u.idpersona')
                     ->select('u.idusuario','p.nombre','p.apellidos')
                     ->where([['venta.idcurso', '=', $idcurso]])
                     ->where([['p.apellidos', 'LIKE', "%{$search}%"]])->get();
        
        $data = Array();
        foreach ($estudiantes as $estudiante) {
            $entregables = DB::table('entregable')->where([['idusuario', '=', $estudiante->idusuario],['idseccion','=', $idseccion]])->get();

            $resolvio_todo      = true;
            $reviso_todo        = true;
            $cantidad_falta     = 0;
            $cantidad_resuelto  = 0;

            if (count($entregables) > 0) {
                foreach ($entregables as $entregable) {

                    if ($entregable->nota > 0) {
                        $cantidad_resuelto++;
                    }else{
                        $cantidad_falta++;
                        $reviso_todo = false;
                    }
                }
            }else{
                $reviso_todo    = false;
                $resolvio_todo  = false;
            }

            if ($resolvio_todo == true) {
                if ($seccion->entregable == 1) {
                    $data[] = array(
                        "estudiante"        => $estudiante,
                        "reviso_todo"       => $reviso_todo,
                        "resolvio_todo"     => $resolvio_todo,
                        "cantidad_falta"    => $cantidad_falta,
                        "cantidad_resuelto" => $cantidad_resuelto,
                    );
                }
            }
        }
        $data = $this->paginate($data);
        //return $data;
        return view('web.estudiantes_paginate', compact('data','curso','seccion','search'))->render();
    }

    public function ListaTareaEstudiante($idcurso, $idseccion, $idusuario) {
        if ($idcurso != "" && $idseccion != "" && $idusuario != "") {
            $tareaEstudiante = [];
            $persona         = DB::table('users')->join('persona as p', 'p.idpersona', '=', 'users.idpersona')
                             ->select('p.nombre','p.apellidos')
                             ->where([['users.idusuario', '=', $idusuario]])->first();
            $tareaEstudiante = DB::table('entregable')->where([['idusuario', '=', $idusuario],['idseccion','=', $idseccion]])->get();
            return view('web.estudiantes_tarea', compact('tareaEstudiante','persona'))->render();
        }
    }

    public function mostrarTareaEst($idseccion, $idusuario) {
        $entregables = DB::table('entregable')->where([['idseccion', $idseccion],['idusuario', '=', $idusuario]])->get();
        return view('web.estudiantes', compact('entregables'));
    }
    public function paginate($items, $perPage = 30, $page = null) {
        $page   = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items  = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, 
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'pageName' => 'page',
                ]);
    }

    public function evaluarTarea(Request $request) {
        
        $identregable = $request->input('identregable');
        $idusuario    = $request->input('idusuario');
        $idseccion    = $request->input('idseccion');
        $nota         = $request->input('nota');

        if ($identregable != "" && $idusuario != "" && $idseccion != "") {
            date_default_timezone_set("America/Lima");
            $update = DB::table('entregable')
                    ->where([
                        ['identregable', $identregable],
                        ['idusuario', $idusuario],
                        ['idseccion', $idseccion]
                    ])->update([
                        'fecha'     => date("Y/m/d H:i:s"),
                        'idusuario' => $idusuario,
                        'nota'      => $nota,
                        'idseccion' => $idseccion,
                        'archivo'   => $this->asignarArchivo($request)
                    ]);
            return redirect()->back()->with('success','Se ha guardado correctamente su calificación.');
        } else {
            return redirect()->back()->with('error','Recargue la página, ha ocurrido un error al intentar calificar.');
        }
    }

    public function asignarArchivo($request) {
        $response = "";
        if ($request->hasFile('archivo')) {
                $nombre_archivo_bd   = DB::table('entregable')
                                    ->where([
                                      ['identregable', $request->input('identregable')],
                                      ['idusuario', $request->input('idusuario')],
                                      ['idseccion', $request->input('idseccion')]
                                    ])->value('archivo');
                Storage::delete('public/tareas/'.$nombre_archivo_bd);
                $archivo            = $request->file('archivo');
                $nombre_archivo     = $archivo->getClientOriginalName();
                $extension          = explode(".", $nombre_archivo);
                $nvo_nombre_archivo = round(microtime(true)) . '.' . end($extension);
                $path = Storage::putFileAs(
                    'public/tareas', $archivo, $nvo_nombre_archivo
                );
                $response = $nvo_nombre_archivo;
        } else {
            $response = $request->input('archivo_actual');
        }
        return $response;        
    }

    public function DescargarArchivo(Request $request){
        $idusuario    = $request->input('iduser');
        $archivo      = $request->input('arch');
        if ($idusuario != '' && $archivo != '') {
            $persona   = DB::table('users')->join('persona', 'persona.idpersona', '=', 'users.idpersona')
                       ->select('persona.nombre','persona.apellidos')
                       ->where([['users.idusuario', '=', $idusuario]])->first();
            //$headers   = ['Content-Type: application/vnd.ms-excel'];
            $headers   = [];
            $extension = explode(".", $archivo);
            $name      = $persona->nombre.' '.$persona->apellidos . '.' . end($extension);
            return Storage::download('public/tareas/'.$archivo, $name, $headers);
        }
    }	


    /* REVISIÓN DEL PROYECTO FINAL */
    public function indexProyFinal($idcurso) {
        $curso           = Curso::where('idcurso', $idcurso)->first();
        return view('web.revisarProyFinal', compact('curso'));
    }

    public function listaProyFinalPaginate(Request $request, $idcurso) {
        $search          = $request->filtro_search;
        $curso           = Curso::where('idcurso', $idcurso)->first();
        $proyFinalEst    = DB::table('entregable')->join('users as u', 'u.idusuario', '=', 'entregable.idusuario')
                         ->join('persona as p', 'p.idpersona', '=', 'u.idpersona')
                         ->select('entregable.*','p.nombre','p.apellidos')
                         ->where([['entregable.idcurso', '=', $idcurso],['entregable.estado', '=', 2]])
                         ->where([['p.apellidos', 'LIKE', "%{$search}%"]])->paginate(30);
        //$proyFinalEst    = $this->paginate($proyFinalEst);
        return view('web.revisarProyFinal_paginate', compact('curso','proyFinalEst','search'))->render();
    }

    public function revisarProyCurso(Request $request) {
        $identregable = $request->identregable;
        $idusuario    = $request->idusuario;
        $idcurso      = $request->idcurso;
        $nota         = $request->nota;

        if ($identregable != "" && $idusuario != "" && $idcurso != "" && $nota != "") {
            date_default_timezone_set("America/Lima");
            $update = DB::table('entregable')
                    ->where([
                        ['identregable', $identregable],
                        ['idusuario', $idusuario],
                        ['idcurso', $idcurso],
                        ['estado', 2]
                    ])->update([
                        'nota'      => $nota
                    ]);
            return \json_encode(["data"=>"ok","msj"=>"Su calificación se ha registrado correctamente."]);
        } else {
            return \json_encode(["data"=>"false","msj"=>"Recargue la página, ha ocurrido un error al intentar calificar.."]);
        }
    }
}
