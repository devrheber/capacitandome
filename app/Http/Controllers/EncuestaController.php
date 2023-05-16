<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Models\Encuesta;
use App\Models\EncuestaContestada;
use App\Models\Pregunta;
use App\Models\PreguntaEncuesta;
use App\Models\RespuestaEncuesta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Nette\Schema\ValidationException;
use PHPUnit\Exception;

class EncuestaController extends Controller
{
    public function index() {
        return view('admin.encuesta.index');
    }

    public function resultados() {
        return view('admin.encuesta.resultados');
    }

    public function detalle_resultado($idencuestacontestada) {
        $respuestas = RespuestaEncuesta::with('pregunta')
            ->where('encuesta_contestada_id', $idencuestacontestada)->get();
        return view('admin.encuesta.resultados_detalle')->with(array('respuestas' => $respuestas));
    }

    public function estadisticas() {
        $cursos = Curso::where('estado', 1)->get();
        return view('admin.encuesta.estadisticas', compact('cursos'));
    }

    public function nuevo() {

    }

    public function recursos($idencuesta) {
        $encuesta      = Encuesta::where('id', $idencuesta)->with('pregunta_encuestas')->first();

        if ($encuesta) {
            return view('admin.encuesta.recursos', compact( 'encuesta'));
        } else {
            return redirect('/admin/encuestas');
        }
    }

    public function actualizar_recursos(Request $request) {
        $encuesta = Encuesta::where('id', $request->post('idencuesta'))->first();

        DB::beginTransaction();

        try {
            //dd($request->all());
            if ($encuesta) {
                for ($x = 0; $x < count($request->post('pregunta')); $x++) {
                    if ($request->post('idpregunta')[$x] != 0) {
                        $pregunta_encuesta = PreguntaEncuesta::find($request->post('idpregunta')[$x]);
                    } else {
                        $pregunta_encuesta = new PreguntaEncuesta;
                    }

                    $pregunta_encuesta->encuesta_id = $request->post('idencuesta');
                    $pregunta_encuesta->tipo_pregunta = $request->post('tipo_pregunta')[$x];
                    $pregunta_encuesta->nombre = $request->post('pregunta')[$x];
                    $pregunta_encuesta->estado = isset($request->post('estado')[$x]) ? $request->post('estado')[$x] : 1;
                    $pregunta_encuesta->save();
                }
            } else {
                return redirect('/admin/encuestas');
            }

            DB::commit();

            return redirect('/admin/encuestas')->with('success', 'Se registraron los recursos con éxito');

        } catch (\Exception $e) {
            // Si ocurre un error, se deshace toda la transacción
            DB::rollback();
            //dd($e);
            return redirect('/admin/encuestas')->with('error','No se pudo agregar los recursos');
        }
    }

    public function editar($idencuesta) {
        $encuesta      = Encuesta::where('id', $idencuesta)->first();
        $cursos = Curso::where('estado', 1)->get();

        if ($encuesta) {
            return view('admin.encuesta.editar', compact('cursos', 'encuesta'));
        } else {
            return redirect('/admin/encuestas');
        }
    }

    public function actualizar(Request $request) {
        $encuesta = Encuesta::where('id', $request->idencuesta)->first();

        if ($encuesta) {

            $encuesta->titulo = $request->input('titulo');
            $encuesta->curso_id = $request->input('idcurso');
            $encuesta->descripcion = $request->input('descripcion');
            $encuesta->save();
            return redirect('/admin/encuestas')->with('success','Encuesta editada satisfactoriamente');
        } else {
            return redirect('/admin/encuestas')->with('error','No se encontró la encuesta a editar.');
        }
    }

    public function getListarEncuestasPaginate(Request $request, $estado) {
        if ($estado == 0) {
            $encuestas = Encuesta::where([
                ['titulo', 'like', "%{$request->filtro_search}%"]
            ])->with('curso')->orderBy('updated_at', 'desc')->paginate(10);
        }
        else {
            $encuestas = Encuesta::where([
                ['titulo', 'like', "%{$request->filtro_search}%"]
            ])->with('curso')->whereIn('estado', [1, 2])->orderBy('updated_at', 'desc')->paginate(10);
        }

        return  view('admin.encuesta.paginate_encuestas',  ['encuestas' => $encuestas])->render();
    }

    public function getListarEncuestasResultadosPaginate(Request $request, $estado) {
        $filtro = $request->filtro_search;
        $resultados = EncuestaContestada::with(['user.Persona', 'curso.CursoDocenteUsuarios.persona'])
            ->whereHas('curso', function($query) use ($filtro) {
                $query->where('titulo', 'like', "%{$filtro}%");
            })
            ->orderBy('updated_at', 'desc')->paginate(10);

        return  view('admin.encuesta.paginate_resultados',  ['resultados' => $resultados])->render();
    }

    public function store_encuesta_curso(Request $request) {
        DB::beginTransaction();

        try {
            $encuesta_contestada = EncuestaContestada::where([
                ['user_id', Auth::id()],
                ['encuesta_id', $request->post('idencuesta')]
            ])->first();

            if ($encuesta_contestada) {
                DB::commit();
                return redirect()->back()->with('error', 'No puedes realizar 2 veces la misma encuesta!');
            } else {
                $new_encuesta_contestada = new EncuestaContestada();
                $new_encuesta_contestada->user_id = Auth::id();
                $new_encuesta_contestada->encuesta_id = $request->post('idencuesta');
                $new_encuesta_contestada->curso_id = $request->post('idcurso');
                $new_encuesta_contestada->calificacion = $this->get_calificacion($request);
                $new_encuesta_contestada->save();

                for ($x = 0; $x < count($request->post('pregunta')); $x++) {
                    $respuesta_encuesta = new RespuestaEncuesta;
                    $respuesta_encuesta->encuesta_contestada_id = $new_encuesta_contestada->id;
                    $respuesta_encuesta->pregunta_encuesta_id = $request->post('pregunta')[$x];
                    $respuesta_encuesta->respuesta = $request->post('respuesta_' . $x);
                    $respuesta_encuesta->save();
                }

                DB::commit();
                return redirect()->back()->with('success', 'Su respuesta se envió con éxito!');
            }

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()-with('error', 'No se pudo registrar la respuesta');
        }

//        return redirect()->back()->with('error', 'Ocurrió un error!');
    }

    public function get_calificacion($request) {
        $cantidad_preguntas = 0;
        $sumatoria = 0;
        for ($x = 0; $x < count($request->post('pregunta')); $x++) {
            $pregunta = PreguntaEncuesta::find($request->post('pregunta')[$x]);
            if ($pregunta) {
                if ($pregunta->tipo_pregunta == 1) {
                    $sumatoria = $sumatoria +  (int) $request->post('respuesta_' . $x);
                    $cantidad_preguntas++;
                }
            }
        }

        return $sumatoria / $cantidad_preguntas;
    }

    public function getEstadisticas(Request $request) {
        $request = request();

        $validator = Validator::make($request->all(), [
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ]);

        if ($validator->fails()) {
            // Las reglas de validación no se cumplen
            $errors = $validator->errors();

            return response()->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
            // Manejar los errores de validación
        } else {
            // Las reglas de validación se cumplen, procede con la consulta
            $fechaInicio = Carbon::parse($request->from);
            $fechaFin = Carbon::parse($request->to);

            $promedios = EncuestaContestada::select('curso.titulo as nombre_curso', DB::raw('CAST(AVG(encuesta_contestadas.calificacion) AS UNSIGNED) as promedio'), DB::raw('COUNT(*) as registros'))
                ->join('curso', 'encuesta_contestadas.curso_id', '=', 'curso.idcurso')
                ->whereBetween('encuesta_contestadas.created_at', [$fechaInicio, $fechaFin])
                ->groupBy('curso_id', 'nombre_curso')
                ->get();

            return response()->json(['data' => $promedios]);
        }
    }
}
