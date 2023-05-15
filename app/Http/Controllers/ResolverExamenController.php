<?php

namespace App\Http\Controllers;

use App\Models\DetalleResolverExamen;
use App\Models\Examen;
use App\Models\ResolverExamen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class ResolverExamenController extends Controller
{
    //

    public function getMostrarResolverExamen($idexamen)
    {
        // Cambiar esto en produccion
        $idusuario = Auth::user()->idusuario;
        // $idusuario = 1;

        // Fecha de hoy
        $now = Carbon::now();

        $examen = Examen::with(['Curso','Seccion', 'Preguntas', 'Preguntas.Alternativas'])
        ->where('idexamen', $idexamen)
        ->first();

        // return json_encode($examen);

        if ($examen) {

            $resolver_examen = ResolverExamen::with('DetalleResolverExamen')->where('idusuario', $idusuario)->where('idexamen', $idexamen)->first();

            // return json_encode($resolver_examen);

            $flat_terminado = false;

            if ($resolver_examen) {
                if ($resolver_examen->examen_terminado == "1") {
                    $flat_terminado = false;
                }else if ($resolver_examen->examen_terminado == "0") {
                    $flat_terminado = true;
                }
            }

            // return json_encode(($now->diffInSeconds($examen->fecha_final, false)) > 0 && $flat_terminado == false);

            if (($now->diffInSeconds($examen->fecha_final, false)) > 0 && $flat_terminado == false) {
            
                return view('web.resolver_examen', compact('examen' , 'resolver_examen'));

            }else if($flat_terminado == true){

                return view('web.examen_respuesta', compact('examen' , 'resolver_examen'));
            } else {
                return \redirect()->route('miscursos');
            }

        }else{
            abort(404);
        }
    }

    public function postTerminarExamen(Request $request)
    {
        $idusuario = Auth::user()->idusuario;
        // $idusuario = 1;

        $resolver_examen = ResolverExamen::with('Examen')->where('idusuario', $idusuario)->where('idexamen', $request->input('idexamen'))->first();

        if ($resolver_examen) {

            $resolver_examen->examen_terminado = 0;
            $resolver_examen->save();

            return json_encode(['status' => true, 'message' => 'Usted ha entregado su examen']);
        }else{
            return json_encode(['status' => false, 'message' => 'No puede terminar un examen si no lo ha comenzado']);
        }
    }

    public function getTiempoTermino($idexamen)
    {
        $examen = Examen::where('idexamen', $idexamen)->first();

        $my_examen = new stdClass;
        $my_examen->fecha_final = $examen->fecha_final;
        $my_examen->fecha_final_hummans = Carbon::parse($examen->fecha_final)->diffForHumans();
        $my_examen->fecha_final_format  = Carbon::parse($examen->fecha_final)->format('d/m/Y H:i:s');
        
        return json_encode($my_examen);
    }


    public function postGuardarExamen(Request $request)
    {
        $idusuario = Auth::user()->idusuario;
        // $idusuario = 1;

        $idexamen = $request->input('idexamen');

        // Usuario valido
        if ($idusuario) {
            
            $now = Carbon::now();

            $examen = Examen::where('idexamen', $request->input('idexamen'))->first();

            // Validar examen terminó
            if (($now->diffInSeconds($examen->fecha_final, false)) > 0) {

                $resolver_examen = ResolverExamen::with('Examen')->where('idusuario', $idusuario)->where('idexamen', $request->input('idexamen'))->first();

                if ($resolver_examen) {

                    $detalle_resolver_examen = DetalleResolverExamen::updateOrCreate(
                        [
                            'idresolver_examen' => $resolver_examen->idresolver_examen,
                            'idpregunta'        => $request->input('idpregunta'),
                        ],
                        ['idalternativa' => $request->input('idalternativa')]
                    );
                    $this->actualizarNota($request->input('idexamen'));
                    return json_encode(['status' => true, 'message' => 'Se ha guardado su respuesta.']);
                }else{


                    $resolver_examen = new ResolverExamen;
                    $resolver_examen->idexamen     = $request->input('idexamen');
                    $resolver_examen->idusuario    = $idusuario;
                    $resolver_examen->fecha_inicio = Carbon::now();
                    $resolver_examen->save();

                    $detalle_resolver_examen = DetalleResolverExamen::updateOrCreate(
                        [
                            'idresolver_examen' => $resolver_examen->idresolver_examen,
                            'idpregunta'        => $request->input('idpregunta'), 
                        ],
                        ['idalternativa' => $request->input('idalternativa')]
                    );
                    $this->actualizarNota($request->input('idexamen'));

                    return json_encode(['status' => true, 'message' => 'Se ha guardado su primera respuesta.']);
                }

               

            }else{

                return json_encode(['status' => false, 'message' => 'El examen ya termino']);
            }
            
        }else{
            return json_encode(['status' => false, 'message' => 'No existe su usuario']);
        }

    }


    public function actualizarNota($idexamen)
    {

        $idusuario = Auth::user()->idusuario;
        // $idusuario = 1;

        $resolver_examen = ResolverExamen::with('Examen', 'Examen.Preguntas','DetalleResolverExamen', 'DetalleResolverExamen.Pregunta', 'DetalleResolverExamen.Alternativa')->where('idusuario', $idusuario)->where('idexamen', $idexamen)->first();
        
        $calificion_total   = 0;
        $calificacion_final = 0;

        foreach ($resolver_examen->Examen->Preguntas as $key => $preguntas) {
            $calificion_total += $preguntas->puntos;
        }

        foreach ($resolver_examen->DetalleResolverExamen as $key => $detalle_resolver) {
            
            if ($detalle_resolver->Alternativa->correcta == 1) {
                $calificacion_final += $detalle_resolver->Pregunta->puntos;
            }
        }

        $resolver_examen->calificion_total   = $calificion_total;
        $resolver_examen->calificacion_final = $calificacion_final;
        $resolver_examen->save();

    }
}
