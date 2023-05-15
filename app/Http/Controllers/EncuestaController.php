<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Models\Encuesta;
use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    public function index() {
        return view('admin.encuesta.index');
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
}
