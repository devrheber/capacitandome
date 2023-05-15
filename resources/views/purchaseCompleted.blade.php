@extends('layouts.app_web')
@section('tituloPagina','Checkout')

@section('styles')
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
                        <h2 class="section__title" style="color:#28a745 !important">Resultados de pago</h2>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</section>
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
                
                @if (session('success'))
                    <div class="alert alert-success" style="background: #28a745 !important;color:white;text-align: center">
                        <p style="">{{ session('success') }}</p>
                        <a style="color: white !important" href="/"><i class="fa fa-arrow-left"></i> Ir a inicio</a>
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
            <div class="col-lg-7">
                <div class="card-box-shared">
                    <div class="card-box-shared-title">
                        <h3 class="widget-title font-size-18">Detalles de conctacto</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="user-form">
                            <div class="contact-form-action">
                                <div class="team-single-wrap">
                                    <div class="team-single-content">
                                        <div class="team-single-item">
                                        @if (isset($persona))
                                            <h3 class="widget-title pb-2">{{ $persona->nombre }}</h3>
                                        @else
                                            <h3 class="widget-title pb-2">{{ $venta->nombre }}</h3>
                                        @endif
                                        </div><!-- end team-single-item -->
                                    </div>
                                    <div class="team-single-content">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="team-single-item">
                                                    <ul class="address-list">
                                                    @if (isset($persona))
                                                        <li><a href="javascript:"><i class="la la-phone"></i>{{ $persona->telefono }}</a></li>
                                                        <li><a href="javascript:"><i class="la la-envelope-o"></i>{{ $persona->correo }}</a></li>
                                                        <li><a href="javascript:"><i class="la la-map-marker"></i>{{ $persona->direccion }}</a></li>
                                                    @else
                                                        <li><a href="javascript:"><i class="la la-user"></i>{{ $venta->nro_documento }}</a></li>
                                                        <li><a href="javascript:"><i class="la la-envelope-o"></i>{{ $venta->email }}</a></li>
                                                    @endif
                                                        
                                                    </ul>
                                                </div>
                                            </div><!-- end col-lg-6 -->
                                        </div><!-- end row-->
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div><!-- end card-box-shared-body -->
                </div><!-- end card-box-shared -->

            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="card-box-shared">
                    <div class="card-box-shared-title">
                        <h3 class="widget-title font-size-18">Resumen del pago</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="shopping-cart-content">
                            <ul class="list-items">
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="primary-color">1. {{ $cursoId->titulo }}:</span>
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
                                    <input type="hidden" name="precio" value="{{ $cursoId->precio }}">
                                </li>
                            </ul>
                        </div>
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
@endsection
