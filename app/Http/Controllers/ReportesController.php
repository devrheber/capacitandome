<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Venta;
Use App\Models\Usuario;

class ReportesController extends Controller {

    public function indexCursoComprados(Request $request) {

        $search_titulo = $request->input('search');

        if ($search_titulo == '') {
            $pagos = Venta::join('curso as c', 'c.idcurso', '=', 'venta.idcurso')
                    ->select('venta.idcurso','c.portada','c.titulo','c.precio','c.plan',  \DB::raw('COUNT(venta.idcurso) as cant_vendido'))
                    ->where('venta.estado','=','1')
                    ->groupBy('venta.idcurso','c.portada','c.titulo','c.precio','c.plan')
                    ->paginate(10);
                    //->get();
        } else {
            $pagos = Venta::join('curso as c', 'c.idcurso', '=', 'venta.idcurso')
                    ->select('venta.idcurso', 'c.idcurso','c.portada','c.titulo','c.precio','c.plan',  \DB::raw('COUNT(venta.idcurso) as cant_vendido'))
                    ->where('venta.estado','=','1')
                    ->where("c.titulo","LIKE","%{$search_titulo}%")
                    ->groupBy('venta.idcurso', 'c.idcurso','c.portada','c.titulo','c.precio','c.plan')
                    ->paginate(10);
        }    
        return view('admin.pagos.cursosDictados', compact('pagos','search_titulo'));
    }

    public function indexPagoDet(Request $request, $id) {

        $curso = Curso::where('idcurso', $id)->first();

        if (!empty($curso) != "") {
            $departamentos     = DB::table('departamento')->get();
            $total_estudiantes = Venta::where([['idcurso',$id],['estado','!=',2]])->distinct()->count();
            return view('admin.pagos.indexAlumnos', compact('curso','departamentos','total_estudiantes'));
        } else {
            return \redirect('/admin/pagos');
        }
    }

    public function listEstudiantesPaginate(Request $request) {
        $filtro_buscar = $request->filtro_buscar;
        $query = Venta::join('curso as c', 'c.idcurso', '=', 'venta.idcurso')
                ->join('users as u', 'u.idusuario', '=', 'venta.idusuario')
                ->join('persona as p', 'p.idpersona', '=', 'u.idpersona')
                ->select(
                    'venta.idventa',
                    'venta.fecha_venta',
                    'u.idusuario',
                    'p.nombre',
                    'p.apellidos',
                    'p.telefono',
                    'venta.estado'
                )
                ->where('venta.estado','!=',2)
                ->where('venta.idcurso', $request->idcurso);
                if ($request->filtro_buscar != "") {
                    $query->where("p.apellidos","LIKE","%{$request->filtro_buscar}%");
                }
                if ($request->f_dep != "todos") {
                    $query->where("p.iddepartamento","=",$request->f_dep);
                }
                $ventas = $query->distinct()->paginate(50);
                //return $ventas;
        return view('admin.pagos.paginateAlumnos', ['ventas' => $ventas,'filtro_buscar' => $filtro_buscar])->render();
    }

    public function desactivarCuenta($id) {
        //$usuario = Usuario::where('idusuario', $id)->first();
        $venta = Venta::where('idventa', $id)->first();
        if (!empty($venta)) {
            $venta->estado = 0;
            $venta->save();
            return json_encode(["status" => true, "message" => "Acceso al curso. ¡Desabilitada!"]);
        } else {
            return \redirect('/admin/pagos');
        }
        
    }

    public function activarCuenta($id) {
        //$usuario = Usuario::where('idusuario', $id)->first();
        $venta = Venta::where('idventa', $id)->first();
        if (!empty($venta)) {
            $venta->estado = 1;
            $venta->save();
            return json_encode(["status" => true, "message" => "Acceso al curso. ¡Habilitado!"]);
        } else {
            return \redirect('/admin/pagos');
        }
        
    }
}


