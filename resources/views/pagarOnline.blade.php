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
                        <h2 class="section__title">Checkout</h2>
                    </div>
                    <ul class="breadcrumb__list">
                        <li class="active__list-item"><a href="javascript:">Inicio</a></li>
                        <li class="active__list-item">Cursos</li>
                        <li>Checkout</li>
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

                <style>
                    .error-frm{border: 1px solid #DD493D !important;border-radius: .25rem !important;}
                </style>

                <div class="card-box-shared">
                    <div class="card-box-shared-title">
                        <h3 class="widget-title font-size-18">Ingrese usuario y contraseña para comprar este curso</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="user-form">
                            <div class="contact-form-action">

                                @if (session('error'))
                                    <div class="alert alert-danger" style="background: #DD493D !important">
                                       <p style="color:white;text-align: center">{{ session('error') }}</p>
                                    </div>
                                @endif

                                <form method="post" action="{{route('validarLoginCheckout')}}" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="idcurso" value="{{ $cursoId->idcurso }}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">Usuario<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('usuario') error-frm @enderror" type="text" name="usuario" placeholder="Usuario">
                                                    <span class="la la-envelope input-icon"></span>
                                                    @error('usuario')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>                                                
                                            </div>
                                        </div><!-- end col-md-12 -->
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">Contraseña<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control @error('clave') error-frm @enderror" type="password" name="clave" placeholder="Contraseña">
                                                    <span class="la la-lock input-icon"></span>
                                                    @error('clave')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 ">
                                            <div class="btn-box">
                                                <button class="theme-btn" type="submit">Validar mi cuenta</button>
                                            </div>
                                        </div><!-- end col-md-12 -->
                                        <div class="col-lg-12">
                                            <p class="mt-4">¿No tienes una cuenta? <a href="{{route('registrarmeCheckout', $cursoId->idcurso)}}" class="primary-color-2">Registrate y compra este curso</a></p>
                                        </div><!-- end col-md-12 -->
                                    </div><!-- end row -->
                                </form>

                            </div>
                        </div>
                    </div><!-- end card-box-shared-body -->
                </div><!-- end card-box-shared -->
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
@endsection

@section('script')
@endsection
