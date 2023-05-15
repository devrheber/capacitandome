<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
Use App\Models\Usuario;
Use App\Models\Curso;
Use App\Models\Persona;
use App\Http\Requests\registrarClienteRequest;
use App\Http\Requests\registrarPreventaRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrarVoucherRequest;

use Lyra;

$comision_izipay=["porcentaje"=>0.034,"monto_fijo"=>0.69,"igv"=>0.18];

class PagarOnlineController extends Controller {

    public function __construct() {
        //$this->middleware('auth');
    }

    public function cursoPagarId( $id ) {
        
            $cursoId       = DB::table('curso')->where('idcurso', '=', $id)->first();
            $departamentos = $this->listDepartamentos();
            if (!empty($cursoId)) {
                if(Auth::id()==null){
                    return view('pagarOnline')->with([
                        'cursoId'       => $cursoId,
                        'departamentos' => $departamentos,
                    ]);
                }else{
                    
                    $venta = DB::table('venta')->where([['idcurso','=',$id],['idusuario','=',Auth::id()]])->first();
                    if (!isset($venta)) {
                        return redirect()->route('subirVoucher',array("cu"=>$id,"us"=> Auth::user()->idusuario));
                    }else{
                        return redirect()->route('miaprendizaje',$id);
                    }
                }
            } else {
                return redirect('/');
            }
        
        
    }

    public function listDepartamentos() {
        $departamentos = DB::table('departamento')->get();
        return $departamentos;
    }

    #registrarClienteRequest
    public function registrarCliente(registrarClienteRequest $request) {
        $data      = $request->validated();
        $persona   = Persona::where('dni', $data['dni'])->first();

        if (empty($persona)) {

            $idpersona = DB::table('persona')->insertGetId([
                'tipo_persona'    => 'estudiante', 
                'nombre'          => $data['nombre'], 
                'apellidos'       => $data['apellido'],
                'dni'             => $data['dni'],
                'telefono'        => $data['telefono'],
                'iddepartamento'  => $data['iddepartamento'],
                'correo'          => $data['correo'],
                'direccion'       => $data['direccion'],
            ]);
            if (!empty($idpersona)) {
                $iduser = DB::table('users')->insertGetId([
                    'idrol'       => 2, 
                    'idpersona'   => $idpersona,
                    'usuario'     => $data['usuario'],
                    'password'    => Hash::make($data['clave']),
                    'estado'      => 1,
                ]);
            }

            /*$curso   = Curso::where('idcurso', $request->idcurso)->first();
            $persona = Persona::where('idpersona', $idpersona)->first();

            return view('subirBoucher')->with([
                'cursoId'     => $curso,
                'idusuario'   => $iduser,
                'persona'     => $persona
            ]);*/

            return redirect()->route('subirVoucher',array("cu"=>$request->idcurso,"us"=> $iduser));

        } else {
            return back()->with('error', $data['nombre']." ".$data['apellido'].', ya está registrado en nuestra base de datos.');
        }
    }

    #registrarPreVentaRequest
    public function registrarpreventa(registrarPreventaRequest $request) {
        $data      = $request->validated();
  
        $curso = DB::table('curso')->where('idcurso', '=', $data['idcurso'])->first();
 
        if (isset($curso)) {

            $id =  DB::table('venta')->insertGetId([
                'idcurso'            => $data['idcurso'], 
                'nombre'=>$data['name'],
                'email'=>$data['email'],
                'nro_documento'=>$data['dni'],
                'tipo'       => "card",
                'fecha_venta'        => date("Y/m/d H:i:s"),
                'created_at'        => date("Y/m/d H:i:s"),
                'updated_at'        => date("Y/m/d H:i:s"),
                'tipo'       => "card",
                'estado'             => 3
            ]);

            return redirect()->route('pasarelapagocheckout',array("cu"=>$request->idcurso,"prv"=> $id));

        } else {
            return back()->with('error','No se encuentra el curso');
        }
    }

    public function validarLoginCheckout(LoginRequest $request) {

        if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->clave, 'estado' => 1, 'idrol' => 2])) {
            return redirect()->route('subirVoucher',array("cu"=>$request->idcurso,"us"=> Auth::user()->idusuario));
        } else {
            return back()->with('error', 'Usuario y contraseña no coinciden.');
        }
    }
    private function calcularPagoIzipay($monto){
        $comision_izipay=["porcentaje"=>0.034,"monto_fijo"=>0.69,"igv"=>0.18];
        return round(($monto+$comision_izipay["monto_fijo"]+$comision_izipay["monto_fijo"]*$comision_izipay["igv"])/(1-$comision_izipay["porcentaje"]-$comision_izipay["porcentaje"]*$comision_izipay["igv"]),2);
    }
    public function indexSubirVoucher(Request $request,Lyra\Client $paymentGateway) {
        
        $curso   = Curso::where('idcurso', $request->cu)->first();
        $persona = DB::table('users')->join('persona', 'users.idpersona', '=', 'persona.idpersona')->where('idusuario', $request->us)->first();
       
        if (!empty($curso) && !empty($persona)) {
            $venta = DB::table('venta')->where([['idcurso','=',$request->cu],['idusuario','=',$request->us]])->first();
            if (empty($venta)) {
                $store = array("amount" => floatval(number_format($curso->precio*100,2,",","")), 
                "currency" => "PEN", 
                "orderId" => uniqid("course"),
                "customer" => array(
                "email" => $persona->correo
                ));
                
                $response = $paymentGateway->post("V4/Charge/CreatePayment", $store);

                /* I check if there are some errors */
                if ($response['status'] != 'SUCCESS') {
                    /* an error occurs, I throw an exception */
                    dd($response);
                    display_error($response);
                    $error = $response['answer'];
                    throw new Exception("error " . $error['errorCode'] . ": " . $error['errorMessage']);
                }

                DB::table('order_card')->insert([
                    'idcurso'            => $curso->idcurso, 
                    'iduser'          => $persona->idusuario,
                    'uniqid'        => $store['orderId'],
                    'amount'       => $store['amount']                
                ]);

                /* everything is fine, I extract the formToken */
                $formToken = $response["answer"]["formToken"];


                return view('subirBoucher')->with([
                    'orderId'     => $store['orderId'],
                    'paymentGateway'     => $paymentGateway,
                    'formToken'     => $formToken,
                    'cursoId'     => $curso,
                    'idusuario'   => $request->us,
                    'persona'     => $persona
                ]);
            } else {
                return redirect()->route('purchaseCompleted',["cu"=>$request->cu,"us"=>$request->us])->with('success', 'USTED YA SE EMCUENTRA REGISTRADO EN EL CURSO');
            }
        } else {
            return redirect('/');
        }
    }
    public function pasarelaPagoRegistro(Request $request,Lyra\Client $paymentGateway) {
        
        $curso   = Curso::where('idcurso', $request->cu)->first();
       
        if (!empty($curso) ) {
            $curso->precioFinal=$this->calcularPagoIzipay($curso->precio);
            return view('pasarelaPagoFormulario')->with([
                'cursoId'     => $curso,
            ]);
        } else {
            return redirect('/');
        }
    }
    public function pasarelaPagoCheckout(Request $request,Lyra\Client $paymentGateway) {
        
        
        $curso   = Curso::where('idcurso', $request->cu)->first();
        $venta   = DB::table('venta')->where([['idventa','=',$request->prv]])->first();
        if (!empty($curso) && !empty($venta)) {
            $curso->precioFinal=$this->calcularPagoIzipay($curso->precio);
            if ($venta->estado==3) {
                $store = array("amount" => floatval(number_format($curso->precioFinal*100,2,",","")), 
                "currency" => "PEN", 
                "orderId" => uniqid("course"),
                "customer" => array(
                "email" => $venta->email
                ));

                DB::table('venta')
                ->where('idventa', $request->prv)
                ->update(
                    [
                        "precio"=> $curso->precioFinal,
                        "precio_referencial"=> $curso->precio,
                        "idordercard"=>$store['orderId'],
                        "updated_at"=> date("Y/m/d H:i:s")
                    ]
                );

                
                
                $response = $paymentGateway->post("V4/Charge/CreatePayment", $store);

                /* I check if there are some errors */
                if ($response['status'] != 'SUCCESS') {
                    /* an error occurs, I throw an exception */
                    //dd($response);
                    //display_error($response);
                    $error = $response['answer'];
                    throw new Exception("error " . $error['errorCode'] . ": " . $error['errorMessage']);
                }

                DB::table('order_card')->insert([
                    'idcurso'            => $curso->idcurso, 
                    'uniqid'        => $store['orderId'],
                    'amount'       => $store['amount']                
                ]);

                /* everything is fine, I extract the formToken */
                $formToken = $response["answer"]["formToken"];


                return view('pasarelaPagoCheckout')->with([
                    'orderId'     => $store['orderId'],
                    'paymentGateway'     => $paymentGateway,
                    'formToken'     => $formToken,
                    'cursoId'     => $curso,
                    'idusuario'   => $request->us,
                    'venta'     => $venta
                ]);
            } else {
                return redirect()->route('purchaseCompleted',["cu"=>$request->cu,"prv"=>$request->prv])->with('success', 'USTED YA COMPLETO EL PAGO');
            }
        } else {
            return redirect('/');
        }
    }
    public function purchaseCompleted(Request $request) {
         
        $curso   = Curso::where('idcurso', $request->cu)->first();
        if(isset($request->us)){
            $persona = DB::table('users')->join('persona', 'users.idpersona', '=', 'persona.idpersona')->where('idusuario', $request->us)->first();
            $venta =DB::table('venta')->where([['idcurso','=',$request->cu],['idusuario','=',$request->us]])->first();
            if($venta->tipo=="card"){
                $curso->precioFinal=$this->calcularPagoIzipay($curso->precio);
            }else{
                $curso->precioFinal=$curso->precio;
            }
            if (!empty($curso) && !empty($persona)) {            
            
                return view('purchaseCompleted')->with([
                    'cursoId'     => $curso,
                    'idusuario'   => $request->us,
                    'persona'     => $persona
                ]);
            } else {
                return redirect('/');
            }
        }else{
            $venta = DB::table('venta')->where('idventa', $request->prv)->first();
            if (!empty($curso) && !empty($venta)) {           
                
                if($venta->tipo=="card"){
                    $curso->precioFinal=$this->calcularPagoIzipay($curso->precio);
                }else{
                    $curso->precioFinal=$curso->precio;
                }
            
                return view('purchaseCompleted')->with([
                    'cursoId'     => $curso,
                    'idventa'   => $request->prv,
                    'venta'     => $venta
                ]);
            } else {
                return redirect('/');
            }
        }
        
    }

    public function purchaseRefused(Request $request,Lyra\Client $paymentGateway) {
        
        $formAnswer = $paymentGateway->getParsedFormAnswer();
        if($paymentGateway->checkHash()){
            $orcerdar = DB::table('order_card')->where([['uniqid','=',$formAnswer['kr-answer']['orderDetails']['orderId']]])->first();
           
            if (!empty($orcerdar)) {
                DB::table('order_card')
                            ->where('uniqid', $orcerdar->uniqid)
                            ->update(
                                ['card_answer' => json_encode($formAnswer),
                                'orderStatus' => $formAnswer['kr-answer']['orderStatus']]
                            );
            }


            $curso   = Curso::where('idcurso', $request->cu)->first();

            if(isset($request->us)){
                $persona = DB::table('users')->join('persona', 'users.idpersona', '=', 'persona.idpersona')->where('idusuario', $request->us)->first();
                $venta =DB::table('venta')->where([['idcurso','=',$request->cu],['idusuario','=',$request->us]])->first();    

                if($venta->tipo=="card"){
                    $curso->precioFinal=$this->calcularPagoIzipay($curso->precio);
                }else{
                    $curso->precioFinal=$curso->precio;
                }
                if (!empty($curso) && !empty($persona)) {            
                    
                    return view('purchaseRefused')->with([
                        'cursoId'     => $curso,
                        'idusuario'   => $request->us,
                        'persona'     => $persona
                    ]);
                } else {
                    return redirect('/');
                }

            }else{
                $venta = DB::table('venta')->where('idventa', $request->prv)->first();
                if (!empty($curso) && !empty($venta)) {           
                    
                    if($venta->tipo=="card"){
                        $curso->precioFinal=$this->calcularPagoIzipay($curso->precio);
                    }else{
                        $curso->precioFinal=$curso->precio;
                    }
                
                    return view('purchaseRefused')->with([
                        'cursoId'     => $curso,
                        'idventa'   => $request->prv,
                        'venta'     => $venta
                    ]);
                } else {
                    return redirect('/');
                }
            }

            
        }else{
            return redirect('/');
        }
    }

    public function registrarmeCheckout($id){
        $cursoId       = DB::table('curso')->where('idcurso', '=', $id)->first();
        
        if (!empty($cursoId)) {
            
            if(Auth::id()==null){
                $departamentos = $this->listDepartamentos();
                return view('registrarseCheckout')->with([
                    'cursoId'       => $cursoId,
                    'departamentos' => $departamentos,
                ]);
            }else{
                $venta = DB::table('venta')->where([['idcurso','=',$id],['idusuario','=',Auth::id()]])->first();
                if (!isset($venta)) {
                    return redirect()->route('subirVoucher',array("cu"=>$id,"us"=> Auth::user()->idusuario));
                }else{
                    return redirect()->route('miaprendizaje',$id);
                }
                
            }
        } else {
            return redirect('/');
        }
    }

    public function registrarVoucher(RegistrarVoucherRequest $request) {
        date_default_timezone_set("America/Lima");

        $venta = DB::table('venta')->where([['idcurso','=',$request->idcurso],['idusuario','=',$request->idusuario]])->first();

        if (empty($venta)) {
            if($request->hasFile('boucher_pago')){
                $nombre_input_img  = $request->file('boucher_pago');
                $nombre_img        = $nombre_input_img->getClientOriginalName();
                $extension         = explode(".", $nombre_img);
                $nvo_nombre_img    = $request->idusuario.'_'.round(microtime(true)) . '.' . end($extension);   
    
                if (!Storage::disk('public')->exists('boucher_pago')) {
                    Storage::makeDirectory('public/boucher_pago', 0775, true);
                }
                \Storage::disk('public')->put("boucher_pago/".$nvo_nombre_img, \File::get($nombre_input_img));  
                
                DB::table('venta')->insert([
                    'idcurso'            => $request->idcurso, 
                    'idusuario'          => $request->idusuario,
                    'fecha_venta'        => date("Y/m/d H:i:s"),
                    'boucher_pago'       => $nvo_nombre_img,
                    'tipo'       => "bank",
                    'estado'             => 2
                ]);
                /*$usuario         = Usuario::find($request->idusuario);
                $usuario->estado = 0;
                $usuario->save();*/
                return back()->with('success', 'SE HA REGISTRADO SU VOUCHER DE PAGO SATISFACTORIAMENTE, SE LE ENVIARÁ UN CORREO NOTIFICANDOLE EL ACCESO AL CURSO.');
            }
        } else {
            return back()->with('error', 'USTED YA ESTÁ REGISTRADO EN ESTE CURSO.');
        }
        
        
        
    }

    public function registrarCard(Request $request,Lyra\Client $paymentGateway) {
        date_default_timezone_set("America/Lima");
        try {
            if($paymentGateway->checkHash()){
                $formAnswer = $paymentGateway->getParsedFormAnswer();
      
                $orcerdar = DB::table('order_card')->where([['uniqid','=',$formAnswer['kr-answer']['orderDetails']['orderId']]])->first();
                $venta = DB::table('venta')->where([['idordercard','=',$orcerdar->uniqid]])->first();
                
                if (!empty($orcerdar)) {
                         
                    DB::table('order_card')
                            ->where('uniqid', $orcerdar->uniqid)
                            ->update(
                                ['card_answer' => json_encode($formAnswer),
                                'orderStatus' => $formAnswer['kr-answer']['orderStatus']]
                            );
                    if(!isset($orcerdar->card_answer_ipn)){         
                        if($formAnswer['kr-answer']['orderStatus']=='PAID'){
                           
                            if(isset($orcerdar->iduser)){
                                echo "orcerdar->iduse";
                                var_dump($orcerdar);
                                $venta = DB::table('venta')->where([['idcurso','=',$orcerdar->idcurso],['idusuario','=',$orcerdar->iduser]])->first();
                                if (!isset($venta)) {
                                        $getPrecio = $this->validarPrecioCurso($orcerdar->idcurso, $orcerdar->iduser);
                        
                                        //VALIDAMOS QUE EL PRECIO DEL CURSO QUE SE OBTIENE DE LA WEB SEA EL MISMO DE LA BASE DE DATOS
                                        if (!empty($getPrecio)) {
                                            DB::table('venta')->insert([
                                                'idcurso'            => $orcerdar->idcurso, 
                                                'idusuario'          => $orcerdar->iduser,
                                                'tipo'       => "card",
                                                'precio'       => $orcerdar->amount,
                                                'precio_referencial'       => $orcerdar->amount,
                                                'fecha_venta'        => date("Y/m/d H:i:s"),
                                                'tipo'       => "card",
                                                'idordercard'             => $orcerdar->uniqid,
                                                'estado'             => 1
                                            ]);
                                
                                            return redirect()->route('pasarelapagocheckout',["cu"=>$orcerdar->idcurso,"us"=>$orcerdar->iduser])->with('success', 'SE HA REGISTRADO SU PAGO SATISFACTORIAMENTE, SE LE ENVIARÁ UN CORREO NOTIFICANDOLE EL ACCESO AL CURSO.');
                
                                        } else {
                                            return redirect()->route('pasarelapagocheckout',["cu"=>$orcerdar->idcurso,"us"=>$orcerdar->iduser])->with('error', 'PARECE QUE ENCONTRAMOS UNA INCONSISTENCIA EL PRECIO DEL CURSO NO COINCIDE CON EL MONTO PAGADO. CONTACTESE CON EL ADMINISTRADOR PARA PROCEDER CON LA DEVOLUCION');
                                        }
                                                            
                                } else {
                                    return redirect()->route('purchaseCompleted',["cu"=>$orcerdar->idcurso,"us"=>$orcerdar->iduser])->with('error', 'USTED YA ESTÁ REGISTRADO EN ESTE CURSO.');
                                }

                            }else{                                
                                
                                if(isset($venta)){

                                    DB::table('venta')
                                    ->where('idventa', $venta->idventa)
                                    ->update(
                                        ['estado' => 1,
                                         "fecha_venta"=> date("Y/m/d H:i:s"),
                                         "updated_at"=> date("Y/m/d H:i:s")
                                        ]
                                    );
                                    return redirect()->route('purchaseCompleted',["cu"=>$orcerdar->idcurso,"prv"=>$venta->idventa])->with('success', 'SE HA REGISTRADO SU PAGO SATISFACTORIAMENTE, SE LE ENVIARÁ UN CORREO NOTIFICANDOLE EL PAGO.');

                                }else{
                                    return redirect()->route('purchaseCompleted',["cu"=>$orcerdar->idcurso,"prv"=>$venta->idventa])->with('error', 'NO SE ENCONTRO LA ORDEN DE PREVENTA');
                                }
                            }

                            
                        }else{
                            if(isset($orcerdar->iduser)){
                                return redirect()->route('purchaseCompleted',["cu"=>$orcerdar->idcurso,"us"=>$orcerdar->iduser])->with('error', 'ECONTRAMOS QUE EL PROCESO NO SE LOGRO COMPLETAR, INTENTE DE NUEVO');
                            }else{
                                return redirect()->route('purchaseCompleted',["cu"=>$orcerdar->idcurso,"prv"=>$venta->idventa])->with('error', 'ECONTRAMOS QUE EL PROCESO NO SE LOGRO COMPLETAR, INTENTE DE NUEVO');
                            }
                            
                        } 
                    }else{        
                                          
                        if(isset($orcerdar->iduser)){
                            return redirect()->route('purchaseCompleted',["cu"=>$orcerdar->idcurso,"us"=>$orcerdar->iduser])->with('success', 'SE HA REGISTRADO SU PAGO SATISFACTORIAMENTE, SE LE ENVIARÁ UN CORREO NOTIFICANDOLE EL ACCESO AL CURSO.');
                        }else{
                            return redirect()->route('purchaseCompleted',["cu"=>$orcerdar->idcurso,"prv"=>$venta->idventa])->with('success', 'SE HA REGISTRADO SU PAGO SATISFACTORIAMENTE, SE LE ENVIARÁ UN CORREO NOTIFICANDOLE EL PAGO');
                        }
                        
                    }
                }
                else{
                   
                    if(isset($orcerdar->iduser)){
                        return redirect()->route('purchaseCompleted',["cu"=>$orcerdar->idcurso,"us"=>$orcerdar->iduser])->with('error', 'ORDERID ENVIADO POR Payment Gateway NO EXISTE '.$formAnswer['orderDetails']['orderId']);
                    }else{
                        return redirect()->route('purchaseCompleted',["cu"=>$orcerdar->idcurso,"prv"=>$venta->idventa])->with('error', 'ORDERID ENVIADO POR Payment Gateway NO EXISTE '.$formAnswer['orderDetails']['orderId']);
                    }
                    
                }

            }else{
                if(isset($orcerdar->iduser)){
                    return redirect()->route('purchaseCompleted',["cu"=>$orcerdar->idcurso,"us"=>$orcerdar->iduser])->with('error', 'CLAVE HASH NO COINCIDE');
                }else{
                    return redirect()->route('purchaseCompleted',["cu"=>$orcerdar->idcurso,"prv"=>$orcerdar->idventa])->with('error', 'CLAVE HASH NO COINCIDE');
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }        
    }
    public function registrarCardIPN(Request $request,Lyra\Client $paymentGateway) {
        date_default_timezone_set("America/Lima");
        try {
            if($paymentGateway->checkHash()){
                $formAnswer = $paymentGateway->getParsedFormAnswer();
      
                $orcerdar = DB::table('order_card')->where([['uniqid','=',$formAnswer['kr-answer']['orderDetails']['orderId']]])->first();
               
                if (!empty($orcerdar)) {                    
                    DB::table('order_card')
                        ->where('uniqid', $orcerdar->uniqid)
                        ->update(
                            ['card_answer_ipn' => json_encode($formAnswer),
                            'orderStatus' => $formAnswer['kr-answer']['orderStatus']]
                        );
                    if($formAnswer['kr-answer']['orderStatus']=='PAID'){

                        if(isset($orcerdar->iduser)){
                            $venta = DB::table('venta')->where([['idcurso','=',$orcerdar->idcurso],['idusuario','=',$orcerdar->iduser]])->first();

                            if (!isset($venta)) {
                                    $getPrecio = $this->validarPrecioCurso($orcerdar->idcurso, $orcerdar->iduser);
                    
                                    //VALIDAMOS QUE EL PRECIO DEL CURSO QUE SE OBTIENE DE LA WEB SEA EL MISMO DE LA BASE DE DATOS
                                    if (!empty($getPrecio)) {
                                        DB::table('venta')->insert([
                                            'idcurso'            => $orcerdar->idcurso, 
                                            'idusuario'          => $orcerdar->iduser,
                                            'tipo'       => "card",
                                            'precio'       => $getPrecio,
                                            'precio_referencial'       => $getPrecio,
                                            'fecha_venta'        => date("Y/m/d H:i:s"),
                                            'tipo'       => "card",
                                            'idordercard'             => $orcerdar->uniqid,
                                            'estado'             => 1
                                        ]);
                                        return response()->json(
                                            [
                                            'status' => 'success',
                                            'data' =>false,
                                            'message' => 'SE HA REGISTRADO SU VOUCHER DE PAGO SATISFACTORIAMENTE'
                                            ],
                                            200
                                        );
            
                                    } else {
                                        return response()->json(
                                            [
                                            'status' => 'error',
                                            'data' =>false,
                                            'message' => 'PARECE QUE ENCONTRAMOS UNA INCONSISTENCIA EL PRECIO DEL CURSO NO COINCIDE CON EL MONTO PAGADO. CONTACTESE CON EL ADMINISTRADOR PARA PROCEDER CON LA DEVOLUCION'
                                            ],
                                            200
                                        );
                                    }
                                                        
                            } else {
                                return response()->json(
                                    [
                                    'status' => '200',
                                    'data' =>'USTED YA ESTÁ REGISTRADO EN ESTE CURSO.',
                                    'message' => 'error'
                                    ],
                                    200
                                );
                            }

                        }else{
                            $venta = DB::table('venta')->where([['idordercard','=',$orcerdar->uniqid]])->first();

                                if(isset($venta)){
                                    
                                    DB::table('venta')
                                    ->where('idventa', $venta->idventa)
                                    ->update(
                                        ['estado' => 1,
                                         "fecha_venta"=> date("Y/m/d H:i:s"),
                                         "updated_at"=> date("Y/m/d H:i:s")
                                        ]
                                    );
                                    return response()->json(
                                        [
                                        'status' => 'success',
                                        'data' =>false,
                                        'message' => 'SE HA REGISTRADO SU VOUCHER DE PAGO SATISFACTORIAMENTE'
                                        ],
                                        200
                                    );

                                }else{
                                    return response()->json(
                                        [
                                        'status' => '200',
                                        'data' =>'PRE VENTA NO ENCONTRADA.',
                                        'message' => 'error'
                                        ],
                                        200
                                    );
                                }
                        }

                        
                    }else{
                        return response()->json(
                            [
                              'status' => 'error',
                              'data' =>false,
                              'message' => 'PAGO NO PROCESADO'
                            ],
                            200
                          );
                    } 
                }
                else{
                   
                    return response()->json(
                        [
                          'status' => 'error',
                          'data' => false,
                          'message' =>  'ORDERID ENVIADO POR Payment Gateway NO EXISTE '.$formAnswer['orderDetails']['orderId'],
                        ],
                        200
                      );
                }

            }else{
                return response()->json(
                    [
                      'status' => 'error',
                      'data' => false,
                      'message' => 'ORDERID ENVIADO POR Payment Gateway NO EXISTE '.$formAnswer['orderDetails']['orderId'],
                    ],
                    200
                  );
            }
        } catch (\Throwable $th) {
 
            $data =$request->all();
            DB::table('order_card')->insert([
                'reference_ipn'          =>$th->getMessage(), 
                'post_ipn'            => json_encode($data), 
            ]);            
            return response()->json(
                [
                  'status' =>  'error',
                  'data' => $th->getMessage(),
                  'message' =>'No se econtraron datos',
                ],
                200
              );
        }        
    }

    /* INCONCLUSO */
    public function registrarPago(Request $request) {
        date_default_timezone_set("America/Lima");
        $validator = Validator::make($request->all(), [
            'num_targeta' => 'required',
            'mes_ven'     => 'required',
            'anio_ven'    => 'required',
            'cvv'         => 'required',
            'idcurso'     => 'required',
            'precio'      => 'required',
            'idu'         => 'required',
            'nombre'      => 'required',
            'apellido'    => 'required',
            'dni'         => 'required',
            'direccion'   => 'required',
        ]);
        if ($validator->passes()) {
            $getPrecio = $this->validarPrecioCurso($request->input('idcurso'), $request->input('precio'));
            
            //VALIDAMOS QUE EL PRECIO DEL CURSO QUE SE OBTIENE DE LA WEB SEA EL MISMO DE LA BASE DE DATOS
            if (!empty($getPrecio)) {
                //Validar datos de la targeta | CULQUI
                /*DB::table('venta')->insert([
                    'idcurso' => $request->input('idcurso'), 
                    'fecha_venta' => date("Y/m/d H:i:s"),
                    'precio' => $request->input('precio'),
                    'precio_referencial' => $request->input('precio'),
                    'nombre' => $request->input('nombre').' '.$request->input('apellido'),
                    'direccion' => $request->input('direccion'),
                    'nro_documento' => $request->input('dni'),
                ]);*/
                return response()->json(['success'=>'ok']);
            } else {
                return redirect('/');
            }
        }
    	return response()->json(['error'=>$validator->errors()]);
        //return ($request);
    }

    public function validarPrecioCurso( $idcurso, $precio ) {
        $getPrecio = DB::table('curso')->where([['idcurso', '=', $idcurso],['precio', '=', $precio]])->pluck('precio');
        if (($getPrecio) != "") {
            return $getPrecio;
        } else {
            return '';
        }
    }

    
}
