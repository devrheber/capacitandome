@extends('layouts.app_web')
@section('tituloPagina','Checkout')

@section('styles')
<link rel="stylesheet" 
   href="{{ $paymentGateway->getClientEndpoint() }}/static/js/krypton-client/V4.0/ext/classic-reset.css">
<link rel="stylesheet" href="{{ asset('/recursos/web/css/traducirEs.scss') }}">
@endsection
@section('contenido')

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area" style="background-image: url('/recursos/web/images/breadcrumb-bg.jpg');background-color: #233d63 !important;opacity: 0.9 !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <div class="section-heading">
                        <h2 class="section__title" style="color:#28a745 !important">Checkout</h2>
                    </div>
                    <!--ul class="breadcrumb__list" >
                        <li class="active__list-item">
                            <a href="/" style="color:#28a745 !important">Inicio</a></li>
                        <li class="active__list-item" style="color:#28a745 !important">Cursos</li>
                        <li style="color:#28a745 !important">Checkout</li>
                    </ul-->
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
            <div class="col-lg-12">
                @if ($errors->any())
                    <div class="alert alert-danger" style="background: #DD493D !important">
                        <p style="color:white;text-align: center">Los campos notificados son requeridos, complete para continuar</p>
                        {{--<ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>--}}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" style="background: #28a745 !important;color:white;text-align: center">
                        <p style="">{{ session('success') }}</p>
                        <a style="color: white !important" href="/"><i class="fa fa-arrow-left"></i> Regresar al inicio.</a>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" style="background: #DD493D !important;color:white;text-align: center">
                        <p style="">{{ session('error') }}</p>
                        <a style="color: white !important" href="/"><i class="fa fa-arrow-left"></i> Regresar al inicio.</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
        <div class="col-lg-12">
        <div class="user-form">
                            <div class="contact-form-action">
                                <div class="team-single-wrap">
                                    <div class="team-single-content">
                                        <div class="team-single-item">
                                            <h3 class="widget-title pb-2">¡Hola, {{ $venta->nombre }}</h3>
                                            
                                            <p>Acontinuación :</p>
                                            <ul class="list-items">
                                                <li class="">
                                                    <span class="">Complete el formulario <strong>método de pago</strong> y siga las intrucciones correspondientes.</span>
                                                </li>
                                            </ul>
                                        </div><!-- end team-single-item -->
                                    </div>
                                    <div class="team-single-content padding-top-10px">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="team-single-item">
                                                    <ul class="address-list">
                                                        <li><a href="javascript:"><i class="la la-user"></i>{{ $venta->nro_documento }}</a></li>
                                                        <li><a href="javascript:"><i class="la la-envelope-o"></i>{{ $venta->email }}</a></li>
                                                    </ul>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                        </div><!-- end row-->
                                    </div>
                                </div>
                                
                            </div>
                        </div>
        </div>
            <div class="col-lg-7">
            <div class="card-box-shared">
                    <div class="card-box-shared-title">
                        <h3 class="widget-title font-size-18">Resumen del pedido</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="shopping-cart-content">
                            <ul class="list-items">
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="primary-color">1. {{ $cursoId->titulo }}</span>
                                    <input type="hidden" name="idcurso" value="{{ $cursoId->idcurso }}">
                                    <span class="primary-color-3">s/.{{ $cursoId->precio }}</span>
                                </li>
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="primary-color">Comisión pasarela pago :</span>
                                    <span class="primary-color-3">s/.{{ $cursoId->precioFinal - $cursoId->precio}}</span>
                                </li>
                                <li
                                    class="d-flex align-items-center justify-content-between font-size-18 font-weight-bold">
                                    <span class="primary-color">Total :</span>
                                    <span class="primary-color-3">s/.{{ $cursoId->precioFinal }}</span>
                                    <input type="hidden" name="precio" value="{{ $cursoId->precioFinal }}">
                                </li>
                            </ul>
                        </div>
                    </div><!-- end card-box-shared-body -->
                </div><!-- end card-box-shared -->
            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="card-box-shared">
                <div class="card-box-shared-title">
                    <h3 class="widget-title font-size-18">Método de pago</h3>
                </div>
                <div class="card-box-shared-body p-0">
                    <div class="payment-method-wrap">
                        <div class="checkout-item-list">
                            <div class="accordion" id="paymentMethodExample">
                                
                                <div id="frm-pago">  
                                        <div class="card">
                                            <div class="card-header" id="tarjeta">
                                                <div class="checkout-item">
                                                    <label for="radio_credit_card" class="mb-0" data-toggle="collapse"
                                                        data-target="#collapseOneTarjeta" aria-expanded="true"
                                                        aria-controls="collapseOne" style="cursor: pointer;">
                                                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                                                        <span class="widget-title font-size-16">Tarjeta de Credito/Débito</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="collapseOneTarjeta" class="collapse show" aria-labelledby="tarjeta"
                                                data-parent="#paymentMethodExample">
                                                <div class="card-body">
                                                    
                                                        <input type="hidden" name="idcurso" value="{{$cursoId->idcurso}}">
                                                        <input type="hidden" name="idusuario" value="{{$idusuario}}">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="d-flex justify-content-center">

                                                                    <!-- payment form -->
                                                                    <div class="kr-embedded" kr-form-token="{{$formToken}}" class="d-inline-block">
                                                                        <!-- payment form fields -->
                                                                        <div class="kr-pan"></div>
                                                                        <div class="kr-expiry"></div>
                                                                        <div class="kr-security-code"></div>  

                                                                        <!-- payment form submit button -->
                                                                        <button class="kr-payment-button"></button>

                                                                        <!-- error zone -->
                                                                        <div class="kr-form-error"></div>
                                                                    </div> 
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                        </div><!-- end card -->
                                        <div class="section-block"></div>
                                       
                                </div>
                                
                            </div><!-- end accordion -->
                        </div>
                    </div><!-- end payment-method-wrap -->
                </div><!-- end card-box-shared-body -->
        
                </div><!-- end card-box-shared -->
            </div><!-- end col-lg-5 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end checkout-area -->
<!-- ================================
    END CHECKOUT AREA
================================= -->

<div class="modal-form">
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-login">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="pb-3">Gracias, <strong>{{ old('nombre') }}</strong> haz comprado el curso <strong>{{ $cursoId->titulo }}</strong>
                        Bienvenido a CAPACITÁNDOME.
                    </h5>
                </div>
            </div>
        </div>
    </div><!-- end modal -->
</div>

<div class="modal fade" id="modal-success-pago"  role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="contact-form-action">
                        <div class="col lg-12">
                            <h4 class="mb-3">SE HA REGISTRADO SUS DATOS CORRECTAMENTE, EN EL TRANSCURSO DE LOS DÍAS NOS ESTAREMOS CONTACTANDO CONTIGO</h4>
                            <strong>Gracias por confiar en Biolearning</strong>
                        </div>
                    </div><!-- end contact-form -->

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script 
   src="{{ $paymentGateway->getClientEndpoint() }}/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
   kr-public-key="{{ $paymentGateway->getPublicKey()}}"
   kr-post-url-success="/registrarCard"
   kr-post-url-refused="/purchaseRefused?cu={{ $cursoId->idcurso }}&prv={{ $venta->idventa }}">
</script>
<script 
   src="{{ $paymentGateway->getClientEndpoint() }}/static/js/krypton-client/V4.0/ext/classic.js">
  </script>
@endsection
