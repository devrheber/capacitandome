<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
Use App\Models\Curso;
use App\Models\Venta;
use App\Models\Persona;
Use App\Models\Usuario;
Use App\Http\Requests\registrarClienteRequest;
use Illuminate\Support\Facades\Auth;
use Hash;

class SuscripcionCursoController extends Controller {
    
    public function index($idcurso) {

        $cursoId = Curso::where('idcurso',$idcurso)->first();
        if (!empty($cursoId)) {
            $departamentos = DB::table('departamento')->get();
            return \view('suscribirme',compact('cursoId','departamentos'));
        } else {
            return \redirect()->route('inicio');
        }
    }

    public function suscribirme($idcurso, Request $request) {
        date_default_timezone_set("America/Lima");
        $cursoId = Curso::where('idcurso',$idcurso)->first();

        if ($cursoId->plan == 'gratis') {

            $usuario = DB::table('persona')->join('users', 'users.idpersona', '=', 'persona.idpersona')->where([['persona.dni','=',$request->dni]])->first();

            if (!empty($usuario)) {

                $venta = DB::table('venta')->where([['idcurso','=',$idcurso],['idusuario','=',$usuario->idusuario]])->first();

                if (empty($venta)) {
                    $suscrito = Venta::updateOrCreate(
                        [
                            'idcurso'            => $idcurso, 
                            'idusuario'          => $usuario->idusuario],
                        [
                            'fecha_venta'        => date("Y/m/d H:i:s"),
                            'precio'             => $cursoId->precio,
                            'precio_referencial' => $cursoId->precio,
                            'nombre'             => $usuario->nombre." ".$usuario->apellidos,
                            'direccion'          => $usuario->direccion,
                            //'nro_documento'      => $usuario->dni_i
                        ]
                    );
                    if ($suscrito) {
                        return redirect('/suscribirme/'.$idcurso)->with('success', 'Se registrado al curso correctamente. ¡ingrese a su cuenta para continuar aprendiendo!');
                    } else {
                        return redirect('/suscribirme/'.$idcurso)->with('error', 'No se pudo registrar al curso, vuelva a intentarlo mas tarde.');
                    }
                } else {
                    return redirect('/suscribirme/'.$idcurso)->with('warning', 'Usted ya está suscrito al curso, ¡ingrese a su cuenta para continuar aprendiendo!');
                }
            } else {
                return redirect('/suscribirme/'.$idcurso)->with('no_suscrito', 'No se encuentra en nuestra base de datos. Complete el formulario y registre sus accesos al sistema.');
            }
        } else {
            return redirect('/suscribirme/'.$idcurso)->with('error', 'ALERTA: Acceso denegado, por seguridad sus datos han sido registrados.');
        }
        
    }

    public function suscribirNuevo($idcurso, registrarClienteRequest $request) {
        date_default_timezone_set("America/Lima");
        $cursoId = Curso::where('idcurso',$idcurso)->first();

        if ($cursoId->plan == 'gratis') {
            $persona = Persona::updateOrCreate(
                ['nombre' => $request->nombre, 'apellidos' => $request->apellido, 'dni' => $request->dni_i,'telefono'=> $request->telefono],
                ['tipo_persona' => 'estudiante','iddepartamento' => $request->iddepartamento,'correo' => $request->correo,'direccion' => $request->direccion]
            );
            if (!empty($persona)) {
                $user = Usuario::updateOrCreate(
                    ['idpersona'   => $persona->idpersona, 'usuario' => $request->usuario, 'password'    => Hash::make($request->clave)],
                    ['idrol'       => 2,'estado'=> 1]
                );
            }
            $per_suscrito = Venta::updateOrCreate(
                [
                    'idcurso'            => $idcurso, 
                    'idusuario'          => $user->idusuario],
                [
                    'fecha_venta'        => date("Y/m/d H:i:s"),
                    'precio'             => $cursoId->precio,
                    'precio_referencial' => $cursoId->precio,
                    'nombre'             => $request->nombre." ".$request->apellidos,
                    'direccion'          => $request->direccion,
                    //'nro_documento'      => $request->dni_i
                ]
            );
    
            if ($per_suscrito) {
                if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->clave, 'estado' => 1])) {
                    return redirect()->route('miscursos')->with('success', 'Se suscribió y registró el curso satisfactoriamente.');
                }                
            } else {
                return redirect('/suscribirme/'.$idcurso)->with('error', 'Error al registrarse. Recague la página y vuelva a internalo.');
            }
        }
    }
}
