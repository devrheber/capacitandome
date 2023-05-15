@extends('layouts.app_webLogueado')
@section('tituloPagina','Perfil')
@section('styles')

@endsection
@section('contenido')

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area instructor-breadcrumb-area text-left" style="background-color: #233d63 !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content instructor-bread-content d-flex align-items-center">
                    <div class="bread-img-wrap flex-shrink-0">
                        <img src="{{ asset('/recursos/web/images/user.png') }}" width="110" height="110" alt="">
                    </div>
                    <div class="section-heading">
                        <h2 class="section__title font-size-40">{{$persona->nombre}}</h2>
                        <p class="section__desc font-size-16 mb-1">{{$persona->apellidos}}</p>
                        <p class="section__desc font-size-16 mb-0">{{$persona->direccion}}</p>
                    </div>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START SPEAKER AREA
======================================-->
<section class="team-detail-area pt-5">
    <div class="container">
    
    <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('miscursos')}}">REGRESAR A MIS CURSOS</a></li>
                      <li class="breadcrumb-item active" aria-current="page">PERFIL</li>
                    </ol>
                  </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-box-shared">
                    <div class="card-box-shared-title">
                        <h3 class="widget-title">Mi perfil</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="section-tab section-tab-2">
                            <ul class="nav nav-tabs" role="tablist" id="review">
                                <li role="presentation" class="">
                                    <a href="#profile" role="tab" data-toggle="tab" class="active" aria-selected="true">
                                        Mis datos
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#password" role="tab" data-toggle="tab" aria-selected="false" class="">
                                         Cuenta
                                    </a>
                                </li>
                                <!--<li role="presentation">
                                    <a href="#change-email" role="tab" data-toggle="tab" aria-selected="false" class="">
                                        Change Email
                                    </a>
                                </li>
                                 <li role="presentation">
                                    <a href="#withdraw" role="tab" data-toggle="tab" aria-selected="false" class="">
                                        Withdraw
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#account" role="tab" data-toggle="tab" aria-selected="false" class="">
                                        Account
                                    </a>
                                </li>-->
                            </ul>
                        </div>
                        <style>
                            .rqed {
                                color: #28a745 !important;
                                /*color: blue !important;*/
                            }
                        </style>
                        <div class="dashboard-tab-content mt-5">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active show" id="profile">
                                    <div class="user-form">
                                        <div class="contact-form-action">
                                            <form method="post" action="{{route('actualizarperfil')}}" autocomplete="off">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        @if (session('mensaje'))
                                                            <div class="alert alert-success">
                                                                {{ session('mensaje') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="input-box">
                                                            <label class="label-text">NOMBRE(S)<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="nombre" value="{{$persona->nombre}}" disabled>
                                                                <span class="la la-user input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="input-box">
                                                            <label class="label-text">APELLIDO<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="apellido" value="{{$persona->apellidos}}" disabled>
                                                                <span class="la la-user input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3">
                                                        <div class="input-box">
                                                            <label class="label-text">DNI/CARNET EXT<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="dni" value="{{$persona->dni}}" disabled>
                                                                <span class="la la-th input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3">
                                                        <div class="input-box">
                                                            <label class="label-text">TELEFONO<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control rqed" type="text" name="telefono" value="{{$persona->telefono}}">
                                                                <span class="la la-phone input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="input-box">
                                                            <label class="label-text">CORREO<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control rqed" type="text" name="correo" value="{{$persona->correo}}">
                                                                <span class="la la-envelope input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="form-gruoup">
                                                            <label class="label-text">REGIÓN<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="sort-ordering user-form-short">
                                                                <select name="iddepartamento" class="sort-ordering-select">
                                                                    <option value="" disabled>Seleccione..</option>
                                                                    @foreach ($departamentos as $departamento)
                                                                        <option value="{{ $departamento->iddepartamento }}" {{ $persona->iddepartamento == $departamento->iddepartamento ? "selected" : "" }}>
                                                                            {{ $departamento->departamento }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-6 -->
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="input-box">
                                                            <label class="label-text">DIRECCIÓN<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control rqed" type="text" name="direccion" value="{{$persona->direccion}}">
                                                                <span class="la la-map-marker input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 text-center">
                                                        <button class="btn btn-outline-success btn-lg" type="submit">ACTUALIZAR</button>
                                                        <a class="btn btn-outline-secondary btn-lg" href="{{route('miscursos')}}">REGRESAR</a>
                                                    </div><!-- end col-lg-12 -->
                                                </div><!-- end row -->
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- end tab-pane-->
                                
                                <div role="tabpanel" class="tab-pane fade" id="password">
                                    <div class="user-form padding-bottom-60px">
                                        <div class="user-profile-action-wrap">
                                            <h3 class="widget-title font-size-18 padding-bottom-40px">Cambiar contraseña</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                
                                                <div id="msj-frm-clave">
                                                    
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="contact-form-action">
                                            <form method="post" autocomplete="off" id="frm-act-clave">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4">
                                                        <div class="input-box">
                                                            <label class="label-text">Contraseña actual<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="password" id="clave_actual" name="clave_actual" placeholder="Contraseña actual">
                                                                <span class="la la-lock input-icon"></span>
                                                                @error('clave_actual')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->
                                                    <div class="col-lg-4 col-sm-4">
                                                        <div class="input-box">
                                                            <label class="label-text">Nueva contraseña<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="password" id="clave_nueva" name="clave_nueva" placeholder="Nueva contraseña">
                                                                <span class="la la-lock input-icon"></span>
                                                                @error('clave_actual')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->
                                                    <div class="col-lg-4 col-sm-4">
                                                        <div class="input-box">
                                                            <label class="label-text">Confirmar contraseña<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="password" id="clave_confir" name="clave_confir" placeholder="Confirmar contraseña">
                                                                <span class="la la-lock input-icon"></span>
                                                                @error('clave_actual')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->
                                                    
                                                    <div class="col-lg-12">
                                                        <div class="pb-3">
                                                            <div class="progress" id="div_barra_progress">
                                                                <div id="barra_progress" class="progress-bar progress-bar-striped" role="progressbar"
                                                                    aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"
                                                                    style="min-width: 2em; width: 0%;">
                                                                    0%
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-12 text-center">
                                                        <button class="btn btn-outline-success btn-lg" type="submit">ACTUALIZAR</button>
                                                        <a class="btn btn-outline-secondary btn-lg" href="{{route('miscursos')}}">REGRESAR</a>
                                                    </div>
                                                </div><!-- end row -->
                                            </form>
                                        </div>
                                    </div>
                                    
                                </div>
                                {{--
                                <div role="tabpanel" class="tab-pane fade" id="change-email">
                                    <div class="user-form">
                                        <div class="user-profile-action-wrap">
                                            <h3 class="widget-title font-size-18 padding-bottom-40px">Change email</h3>
                                        </div><!-- end user-profile-action-wrap -->
                                        <div class="contact-form-action">
                                            <form method="post">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4">
                                                        <div class="input-box">
                                                            <label class="label-text">Old Email<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="text" placeholder="Old email">
                                                                <span class="la la-envelope input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->
                                                    <div class="col-lg-4 col-sm-4">
                                                        <div class="input-box">
                                                            <label class="label-text">New Email<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="text" placeholder="New email">
                                                                <span class="la la-envelope input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->
                                                    <div class="col-lg-4 col-sm-4">
                                                        <div class="input-box">
                                                            <label class="label-text">Confirm New Email<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="text" placeholder="Confirm new email">
                                                                <span class="la la-envelope input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->
                                                    <div class="col-lg-12">
                                                        <div class="btn-box">
                                                            <button class="theme-btn" type="submit">save changes</button>
                                                        </div>
                                                    </div><!-- end col-lg-12 -->
                                                </div><!-- end row -->
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- end tab-pane-->
                                <div role="tabpanel" class="tab-pane fade" id="withdraw">
                                    <div class="user-profile-action-wrap">
                                        <h3 class="widget-title font-size-18 padding-bottom-40px">Select a Withdraw Method</h3>
                                    </div><!-- end user-profile-action-wrap -->
                                    <div class="withdraw-method-wrap">
                                        <div class="row">
                                            <div class="col-lg-2 column-td-half">
                                                <div class="payment-option">
                                                    <label for="radio-1" class="radio-trigger">
                                                        <input type="radio" id="radio-1" name="radio">
                                                        <span class="checkmark"></span>
                                                        <span class="widget-title font-size-18">
                                                            Bank Transfer
                                                            <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div><!-- end col-lg-2 -->
                                             <div class="col-lg-2 column-td-half">
                                                <div class="payment-option">
                                                    <label for="radio-2" class="radio-trigger">
                                                        <input type="radio" id="radio-2" name="radio">
                                                        <span class="checkmark"></span>
                                                        <span class="widget-title font-size-18">
                                                            E-Check
                                                            <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div><!-- end col-lg-2 -->
                                            <div class="col-lg-2 column-td-half">
                                                <div class="payment-option">
                                                    <label for="radio-3" class="radio-trigger">
                                                        <input type="radio" id="radio-3" name="radio">
                                                        <span class="checkmark"></span>
                                                        <span class="widget-title font-size-18">
                                                            Payoneer
                                                            <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div><!-- end col-lg-2 -->
                                            <div class="col-lg-2 column-td-half">
                                                <div class="payment-option">
                                                    <label for="radio-4" class="radio-trigger">
                                                        <input type="radio" id="radio-4" name="radio">
                                                        <span class="checkmark"></span>
                                                        <span class="widget-title font-size-18">
                                                            PayPal
                                                            <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div><!-- end col-lg-2 -->
                                             <div class="col-lg-2 column-td-half">
                                                <div class="payment-option">
                                                    <label for="radio-5" class="radio-trigger">
                                                        <input type="radio" id="radio-5" name="radio">
                                                        <span class="checkmark"></span>
                                                        <span class="widget-title font-size-18">
                                                            Skrill
                                                            <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div><!-- end col-lg-2 -->
                                            <div class="col-lg-2 column-td-half">
                                                <div class="payment-option">
                                                    <label for="radio-6" class="radio-trigger">
                                                        <input type="radio" id="radio-6" name="radio">
                                                        <span class="checkmark"></span>
                                                        <span class="widget-title font-size-18">
                                                            Stripe
                                                            <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div><!-- end col-lg-2 -->
                                        </div><!-- end row -->
                                    </div>
                                    <div class="user-form padding-top-50px">
                                        <div class="user-profile-action-wrap">
                                            <h3 class="widget-title font-size-18 padding-bottom-40px">Account info</h3>
                                        </div><!-- end user-profile-action-wrap -->
                                        <div class="contact-form-action">
                                            <form method="post">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-4">
                                                        <div class="input-box">
                                                            <label class="label-text">Account Name<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="text" value="Alex Smith">
                                                                <span class="la la-user input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->
                                                    <div class="col-lg-4 col-sm-4">
                                                        <div class="input-box">
                                                            <label class="label-text">Account Number<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="text" value="3275476222500">
                                                                <span class="la la-pencil input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->
                                                    <div class="col-lg-4 col-sm-4">
                                                        <div class="input-box">
                                                            <label class="label-text">Bank Name<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="text" value="South State Bank">
                                                                <span class="la la-bank input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-4 -->
                                                     <div class="col-lg-6 col-sm-6">
                                                        <div class="input-box">
                                                            <label class="label-text">IBAN<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="text" value="3030">
                                                                <span class="la la-pencil input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-6 -->
                                                     <div class="col-lg-6 col-sm-6">
                                                        <div class="input-box">
                                                            <label class="label-text">BIC/SWIFT<span class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" name="text" value="CDDHDBBL">
                                                                <span class="la la-pencil input-icon"></span>
                                                            </div>
                                                        </div>
                                                    </div><!-- end col-lg-6 -->
                                                    <div class="col-lg-12">
                                                        <div class="btn-box">
                                                            <button class="theme-btn" type="submit">save withdraw account</button>
                                                        </div>
                                                    </div><!-- end col-lg-12 -->
                                                </div><!-- end row -->
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- end tab-pane-->
                                <div role="tabpanel" class="tab-pane fade" id="account">
                                    <div class="user-profile-action-wrap">
                                        <h3 class="widget-title font-size-18 padding-bottom-40px">My Account</h3>
                                    </div><!-- end user-profile-action-wrap -->
                                   <div class="user-account-wrap padding-bottom-40px">
                                       <div class="row">
                                           <div class="col-lg-4">
                                               <div class="deactivate-account d-flex align-items-center">
                                                   <div class="payment-option">
                                                       <label for="radio-7" class="radio-trigger mb-0">
                                                           <input type="radio" id="radio-7" name="radio">
                                                           <span class="checkmark"></span>
                                                           <span class="widget-title font-size-18">Deactivate Account</span>
                                                       </label>
                                                   </div>
                                                   <div class="btn-box ml-3">
                                                       <button class="theme-btn line-height-40 font-size-14">Deactivate</button>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                    <div class="section-block"></div>
                                    <div class="user-profile-action-wrap padding-top-40px">
                                        <div class="delete-account-wrap">
                                            <h3 class="widget-title font-size-18 pb-2 text-danger">Delete Account Permanently</h3>
                                            <p><span class="text-warning">Warning:</span> Once you delete your account, there is no going back. Please be certain.</p>
                                            <div class="btn-box mt-4">
                                                <button class="theme-btn line-height-40 font-size-14" data-toggle="modal" data-target=".account-delete-modal">Delete My Account</button>
                                            </div>
                                        </div>
                                    </div><!-- end user-profile-action-wrap -->
                                </div><!-- end tab-pane--> --}}
                            </div><!-- end tab-content -->
                        </div>
                        
                    </div>
                </div><!-- end card-box-shared -->
            </div><!-- end col-lg-12 -->
        </div>


    </div><!-- container -->
</section><!-- team-detail-area secction-padding -->
<!--======================================
        END SPEAKER AREA
======================================-->

<!-- start scroll top -->
<div id="scroll-top">
    <i class="fa fa-angle-up" title="Go top"></i>
</div>
<!-- end scroll top -->


@endsection

@section('script')
<script src="{{ asset('/recursos/ajax/web/miscursos.js') }}"></script>
@endsection
