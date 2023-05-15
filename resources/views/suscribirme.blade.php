@extends('layouts.app_web')
@section('tituloPagina','Checkout')
@section('styles')
<link rel="stylesheet" href="{{ asset('/recursos/web/css/traducirEs.scss') }}">
@endsection
@section('contenido')

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area" style="background-image: url('{{ asset('/storage/cursos/'.$cursoId->url_portada_det.'') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <div class="section-heading">
                        <h2 class="section__title">Suscribirme</h2>
                    </div>
                    <ul class="breadcrumb__list">
                        <li class="active__list-item"><a href="/">Inicio</a></li>
                        <li class="active__list-item"><a href="/cursos">Cursos</a></li>
                        <li>Suscribirme</li>
                    </ul>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
    START CHECKOUT AREA
================================= -->
<section class="checkout-area padding-top-120px padding-bottom-70px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">

                <div class="order-details pt-5 pb-5">
                    <h3 class="widget-title font-size-25"><i class="la la-shopping-cart"
                            style="font-size: 30px !important"></i> Detalles del pedido</h3>
                    <ul class="shopping-list pt-4">
                        <li class="d-flex align-items-center justify-content-between">

                            <div class="shopping-link">
                                <a href="javascript:">1. {{ $cursoId->titulo }}</a>
                            </div>
                            <div class="shopping-price">
                                <span>s/.{{ $cursoId->precio }}</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="card-box-shared">
                    <div class="card-box-shared-title">
                        <h3 class="widget-title font-size-18">Ingrese su DNI/CARNET para validar sus datos. Si usted se encuentra registrado automaticamente se registrará el curso seleccionado. De ser caso contrario debe completar el formulario.</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="user-form">
                            <div class="contact-form-action">


                                <form action="{{ route('suscribirme',$cursoId->idcurso) }}" autocomplete="off" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="input-box">
                                                <label class="label-text">Ingrese DNI/Carnet estranjeria.</label>
                                                <div class="form-group mb-0">
                                                    <input type="text" name="dni" id="dni" required class="form-control" placeholder="Ingrese DNI/Carnet estranjeria.">
                                                    <span class="la la-user input-icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mt-2">
                                                <label for=""></label>
                                                <button class="theme-btn btn-block" type="submit">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                                <style>.error-frm{border: 1px solid #DD493D !important;border-radius: .25rem !important;}</style>
                                <form id="frm-cliente" method="POST" action="{{ route('suscribir_nuevo',$cursoId->idcurso) }}" autocomplete="off">
                                    @csrf

                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if (session('warning'))
                                                <div class="alert alert-danger" style="background: #ebb918 !important">
                                                    <p style="color:white;text-align: center">{{session('warning')}}</p>
                                                </div>
                                            @endif
                                            @if (session('error'))
                                                <div class="alert alert-danger" style="background: #DD493D !important">
                                                    <p style="color:white;text-align: center">{{session('error')}}</p>
                                                </div>
                                            @endif
                                            @if (session('success'))
                                                <div class="alert alert-success" style="background: #28a745 !important">
                                                    <p style="color:white;text-align: center">{{session('success')}}</p>
                                                </div>
                                            @endif
                                            @if (session('no_suscrito'))
                                                <div class="alert alert-warning" style="background: #ebb918 !important">
                                                    <p style="color:white;text-align: center">{{session('no_suscrito')}}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    
                                    {{--@if (!session('no_suscrito'))--}}
                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <strong class="font-size-18">Datos personales</strong>
                                            <hr>
                                        </div>
                                        <div class="col-lg-12">
                                            @if ($errors->any())
                                                <div class="alert alert-danger" style="background: #DD493D !important">
                                                    <p style="color:white;text-align: center">Los campos notificados son requeridos, complete para continuar</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">Nombre(s)<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group mb-0">
                                                    <input type="text" name="nombre" required id="nombre" value="{{ old('nombre') }}" placeholder="Ingrese nombre" class="form-control @error('nombre') error-frm @enderror">
                                                    <span class="la la-user input-icon"></span>
                                                </div>
                                                @error('nombre')
                                                    <span style="color: #DD493D !important;font-size: 13px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">Apellido<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group mb-0">
                                                    <input type="text" name="apellido" required value="{{ old('apellido') }}" class="form-control @error('apellido') error-frm @enderror"
                                                        placeholder="Ingrese apellido">
                                                    <span class="la la-user input-icon"></span>
                                                </div>
                                                @error('apellido')
                                                    <span style="color: #DD493D !important;font-size: 13px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">DNI<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group mb-0">
                                                    <input type="number" name="dni_i" required value="{{ old('dni_i') }}"  class="form-control @error('dni_i') error-frm @enderror"
                                                        placeholder="Ingrese DNI">
                                                    <span class="la la-user-plus input-icon"></span>
                                                </div>
                                                @error('dni_i')
                                                    <span style="color: #DD493D !important;font-size: 13px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">Telefono<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group mb-0">
                                                    <input type="number" name="telefono" required value="{{ old('telefono') }}" class="form-control @error('telefono') error-frm @enderror"
                                                        placeholder="Ingrese telefono">
                                                    <span class="la la-phone input-icon"></span>
                                                </div>
                                                @error('telefono')
                                                    <span style="color: #DD493D !important;font-size: 13px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">Correo<span
                                                        class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group mb-0">
                                                    <input type="text" name="correo" required value="{{ old('correo') }}" class="form-control @error('correo') error-frm @enderror"
                                                        placeholder="Ingrese correo">
                                                    <span class="fa fa-envelope-o input-icon"></span>
                                                </div>
                                                @error('correo')
                                                    <span style="color: #DD493D !important;font-size: 13px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">Departamento<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group mb-0">
                                                    <div class="sort-ordering user-form-short">
                                                        <select name="iddepartamento" required class="sort-ordering-select @error('iddepartamento') error-frm @enderror">
                                                            <option selected value="">Selecciona región</option>
                                                            @foreach ($departamentos as $departamento)
                                                                <option value="{{ $departamento->iddepartamento }}" {{ old('iddepartamento') == $departamento->iddepartamento ? "selected" : "" }}>
                                                                    {{ $departamento->departamento }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @error('iddepartamento')
                                                    <span style="color: #DD493D !important;font-size: 13px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">Dirección<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group mb-0">
                                                    <input type="text" name="direccion" required value="{{ old('direccion') }}" class="form-control @error('direccion') error-frm @enderror" placeholder="Ingrese dirección">
                                                    <span class="la la-map-marker input-icon"></span>
                                                </div>
                                                @error('direccion')
                                                    <span style="color: #DD493D !important;font-size: 13px;">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>                                        

                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-box">
                                                        <label class="label-text">Usuario<span class="primary-color-2 ml-1">*</span></label>
                                                        <div class="form-group mb-0">
                                                            <input required  class="form-control @error('usuario') error-frm @enderror" type="text" id="usuario_v" name="usuario" placeholder="Ingrese su usuario">
                                                            <span class="la la-user input-icon"></span>
                                                        </div>
                                                        @error('usuario')
                                                            <span id="e_u" style="color: #DD493D !important;font-size: 13px;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div><!-- end col-md-12 -->
                                                <div class="col-lg-6">
                                                    <div class="input-box">
                                                        <label class="label-text">Contraseña<span class="primary-color-2 ml-1">*</span></label>
                                                        <div class="form-group mb-0">
                                                            <input required class="form-control @error('clave') error-frm @enderror" type="password" id="clave_v" name="clave" placeholder="Ingrese su contraseña">
                                                            <span class="la la-lock input-icon"></span>
                                                        </div>
                                                        @error('clave')
                                                            <span id="e_c" style="color: #DD493D !important;font-size: 13px;">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div><!-- end row -->
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div id="error-login" style="display: none;background: rgba(238, 21, 21, 0.863);padding: 5px;border-radius: 3px;margin-bottom: 8px;">
                                                         
                                                    </div>
                                                    <div id="error-cuenta" style="display: none;background: rgba(238, 21, 21, 0.74);padding: 5px;border-radius: 3px;margin-bottom: 8px;">
                                                        <p style="font-size: 14px;color:white;text-align: center"><i class="la la-info"></i> Usuario y contraseña no se encontró en nuestros registros. Se creará una nueva cuenta con su USUARIO Y CONTRASEÑA ingresada. Si está conforme presionar el botón (CREAR FACTURACIÓN) caso contrario vuelva a validar su usuario y contraseña.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>





                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <div class="form-group mb-0">
                                                    <div class="custom-checkbox">
                                                        <label for="acepto" class="radio-trigger mb-2 mt-2">
                                                            <input type="radio" id="acepto" name="acepto" checked="">
                                                            <span class="checkmark"></span>
                                                            <span class="widget-title font-size-13">Acepto los términos de servicio y la política de privacidad.</span>
                                                        </label>
                                                    </div>
                                                    @error('acepto')
                                                        <span style="color: #DD493D !important;font-size: 13px;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                

                                                <div class="btn-box pb-3" id="alert-btn-fact">
                                                    <button class="theme-btn btn-block theme-btn-light line-height-40" type="submit">Crear Cuenta</button>
                                                </div>
                                                <div class="secure-connection">
                                                    <p class="d-flex align-items-center">
                                                        <i class="fa fa-lock font-size-30"></i>
                                                        <span class="ml-2">¡Su información está segura con
                                                            nosotros!</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-12 -->
                                    </div>
                                    {{--@endif--}}
                                </form><!-- end row -->
                                


                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- end col-lg-7 -->

            <div class="col-lg-5">
                <div class="card-box-shared">
                    <div class="card-box-shared-title">
                        <h3 class="widget-title font-size-18">Resumen del pedido</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="shopping-cart-content">
                            <ul class="list-items">
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="primary-color">Precio :</span>
                                    <input type="hidden" name="idcurso" value="{{ $cursoId->idcurso }}">
                                    <span class="primary-color-3">s/.{{ $cursoId->precio }}</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="primary-color">Cupón de descuento :</span>
                                    <span class="primary-color-3">No existe</span>
                                </li>
                                <li
                                    class="d-flex align-items-center justify-content-between font-size-18 font-weight-bold">
                                    <span class="primary-color">Total :</span>
                                    <span class="primary-color-3">s/.{{ $cursoId->precio }}</span>
                                    <input type="hidden" name="precio" value="{{ $cursoId->precio }}">
                                </li>
                            </ul>
                        </div>
                    </div><!-- end card-box-shared-body -->
                </div>
                
                <div class="card-box-shared">
                    
                    <div class="card-box-shared-title" style="background: #28a745; !important;">
                        <h3 class="widget-title font-size-18" style="color: white !important">Pasos a seguir:</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="shopping-cart-content">

                            <div class="team-single-item">
                                <ul class="address-list">
                                    <li><a href="javascript:"><i class="la la-check"></i>
                                            Ingrese su DNI para validar si está registrado en nuestra base de datos
                                        </a>
                                    </li>
                                    <li><a href="javascript:"><i class="la la-check"></i>
                                            Complete el formulario <strong>(Detalles del pedido)</strong>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div><!-- end card-box-shared-body -->
                </div>
            </div>

        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end checkout-area -->
<!-- ================================
    END CHECKOUT AREA
================================= -->
@endsection

@section('script')

@endsection
