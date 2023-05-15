<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Models\Encuesta;
use App\Models\PreguntaEncuesta;
use App\Models\RespuestaEncuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function getListarEncuestasResultadosPaginate(Request $request) {
        $resultados = RespuestaEncuesta::where([
            ['respuesta', 'like', "%{$request->filtro_search}%"]
        ])->with('user.Persona', 'pregunta.encuesta.curso.CursoDocenteUsuarios')->orderBy('updated_at', 'desc')->paginate(10);

        return  view('admin.encuesta.paginate_resultados',  ['resultados' => $resultados])->render();
    }

    public function store_encuesta_curso(Request $request) {
        DB::beginTransaction();

        try {
            for ($x = 0; $x < count($request->post('pregunta')); $x++) {
                $respuesta_encuesta = new RespuestaEncuesta;
                $respuesta_encuesta->pregunta_encuesta_id = $request->post('pregunta')[$x];
                $respuesta_encuesta->respuesta = $request->post('respuesta_' . $x);
                $respuesta_encuesta->user_id = Auth::id();
                $respuesta_encuesta->save();
            }

            DB::commit();
            return redirect()->back()->with('success', 'Su respuesta se envió con éxito!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()-with('error', 'No se pudo registrar la respuesta');
        } catch (\PDOException $e) {
            if ($e->getCode() === '23000' && $e->errorInfo[1] === 1062) {
                DB::rollBack();
                $errorMessage = 'No puedes realizar 2 veces la misma encuesta.';

                return redirect()->back()->with('error', $errorMessage);
            }
        }
    }
}
