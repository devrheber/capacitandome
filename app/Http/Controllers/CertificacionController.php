<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CertificadoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\Venta;
use App\Models\Certificado;
use App\Models\Curso;
use App\Models\MallaCurricular;

class CertificacionController extends Controller {

    public function index() {
        $curso       = DB::table('venta')
                     ->join('curso as c', 'c.idcurso', '=', 'venta.idcurso')
                     ->select('c.idcurso','c.titulo',DB::raw('count(venta.idcurso) as cursos'))
                     ->where([['c.plan','=','pago'],['venta.estado','=','1']])
                    ->groupBy('c.idcurso','c.titulo')->get();
        return view('admin.certificados.listar', ['curso' => $curso]);
    }

    public function indexCertificado($idcurso, Request $request) {
        $curso     = Curso::where('idcurso', '=', $idcurso)->first();
        if (!empty($curso)) {
            $mallacurricular = MallaCurricular::where('idcurso', $idcurso)->first();
            return view('admin.certificados.certificacionDetalle', ['curso' => $curso,'idcurso' => $idcurso, 'mallacurricular'=> $mallacurricular]);
        } else {
            return \redirect()->route('admin_index_certificacion');
        }
        
    }

    public function tablaPagCertificados(Request $request) {
        $searh_estudiante = $request->searh_estudiante;
        $idcurso = $request->idcurso;

        //TABLA VENTA DEBE ESTAR ESTADO 1
        //ERRORES : 
        $estudiantes = User::with([
            'Ventas', 
            'Persona', 
            'Entregable' => function ($query) use($idcurso){
                return $query->where('idcurso', $idcurso)->where('estado', 2);
            },
            'Certificados' => function ($query) use($idcurso){
                return $query->where('idcurso', $idcurso);
            },
            'ResolverExamenes', 
            'ResolverExamenes.Examen'
        ])
        ->whereHas('Persona', function ($query) use ($searh_estudiante){
            return $query->where('nombre', 'like', "%{$searh_estudiante}%")
                            ->orWhere('apellidos', 'like', "%{$searh_estudiante}%")
                            ->orderBy('apellidos', 'DESC');
        })
        ->whereHas('Ventas' , function ($query) use ($idcurso){
            return $query->where('idcurso', $idcurso)->where('estado', '!=', 2);
        })
        // ->whereHas('Entregable' , function ($query) use ($idcurso){
        //     return $query->where('entregable.idcurso', $idcurso)->where('entregable.estado', 2);
        // })
        // ->whereHas('Certificados' , function ($query) use ($idcurso){
        //     return $query->where('idcurso', $idcurso);
        // })
        // ->get();
        ->paginate(500);
        
        // return json_encode($estudiantes);
        // return dd($estudiantes);
        

        $curso = Curso::with('Secciones', 'Secciones.Examenes')->where('idcurso', $idcurso)->first();
        $mallacurricular = MallaCurricular::where('idcurso', $idcurso)->first();
        //dd($estudiantes);
        //return $estudiantes;
        return view('admin.certificados.tabla_paginate_certifi', ['curso'=> $curso, 'estudiantes' => $estudiantes,'searh_estudiante'=> $searh_estudiante,'mallacurricular' => $mallacurricular])->render();
    }

    public function agregarCertificado(CertificadoRequest $request){

        $certificado_ruta = "";

        $curso = Curso::where('idcurso', $request->input('idCurso'))->first();
        if($curso){

            $user = Venta::where('idcurso', $request->input('idCurso'))->where('idusuario', $request->input('idUser'))->first();
            if($user){

                $cert = Certificado::where('idcurso', $request->input('idCurso'))->where('idusuario', $request->input('idUser'))->first();

                if($cert){
                    Storage::disk('public')->delete($cert->url);
                    $delete = Certificado::where('idcertificados', $cert->idcertificados)->delete();
                }

                if($request->hasFile('certificado')){
                    $certificado        = $request->file('certificado');
                    $certificado_nombre =  $certificado->getClientOriginalName() . '-' . rand() . '.' . $certificado->getClientOriginalExtension();
                    $certificado_ruta   = '/certificados';
                    $certificado_ruta   = Storage::disk('public')->put($certificado_ruta ,  $certificado);

                }else{
                    return false;
                }

                $create = Certificado::firstOrCreate(
                    [
                        'idcurso'           => $request->input('idCurso'),
                        'idusuario'         => $request->input('idUser'),
                        'url'               => $certificado_ruta,
                    ], [
                        'idcurso'           => $request->input('idCurso'),
                        'idusuario'         => $request->input('idUser'),
                        'url'               => $certificado_ruta,
                        'estado'            => '1',
                    ]);

                if($create){
                    //return redirect('/admin/certificacion/'.$request->input('idCurso'))->with('success','El certificado se registró correctamente.');
                    return \json_encode(["data"=>"ok","msj"=>"El certificado se registró correctamente."]);
                } else {
                    //return redirect('/admin/certificacion/'.$request->input('idCurso'))->with('error','Ocurrió un error al guardar.');
                    return \json_encode(["data"=>"false","msj"=>"Ocurrió un error al guardar."]);
                }

            } else {
                //return redirect('/admin/certificacion/'.$request->input('idCurso'))->with('error','El estudiante seleccionado no pertenece al curso.');
                return \json_encode(["data"=>"false","msj"=>"El estudiante seleccionado no pertenece al curso."]);
            }

        } else {
            //return redirect('/admin/certificacion/'.$request->input('idCurso'))->with('error','No se encontró el curso seleccionado.');
            return \json_encode(["data"=>"false","msj"=>"No se encontró el curso seleccionado."]);
        }

    }


    /*  VISTAS PARA LA WEB CERTIFICADOS */
    public function indexCertificadosWeb() {
        return view('certificados');
    }
}
