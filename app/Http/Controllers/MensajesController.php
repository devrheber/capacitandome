<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
Use App\Models\Mensaje;

class MensajesController extends Controller {

    public function index() {
        return view('admin.comentarios.list');
    }

    public function registrarMensaje(Request $request) {
        date_default_timezone_set("America/Lima");
        DB::table('mensajes')->insert([ 
            'fecha'            => date("Y/m/d H:i:s"),
            'nombre_apellido'  => $request->input('nom_apell'),
            'correo'           => $request->input('correo'),
            'telefono'         => $request->input('telefono'),
            'mensaje'          => $request->input('mensaje'),
        ]);
        return response()->json(['success'=> 'ok']);
    }

    public function listarComentarios() {
        $mensajes   = DB::table('mensajes')->whereIn('estado', [1, 2])->orderBy('idmensajes', 'desc')->get();
        $autoi      = 1;
        $data       = Array();
        //dd($mensajes);
        foreach ($mensajes as $coments) {
            $data[] = array(
                'autoi'            => $autoi ++,
                'fecha'            => $coments->fecha,
                'nombre_apellido'  => $coments->nombre_apellido,
                'correo'           => $coments->correo,
                'telefono'         => $coments->telefono,
                'mensaje'          => $coments->mensaje,
                'estado'           => $coments->estado,
                'idmensajes'       => $coments->idmensajes,
            );
        }
        return \json_encode(array('data' => $data ));
    }

    public function mensajeLeido($id) {
        if (!empty($id)) {
            $mensaje         = Mensaje::find($id);
            $mensaje->estado = 2;
            $mensaje->save();
            return json_encode(["status" => true, "message" => "MENSAJE LEIDO."]);
        }
    }
}
