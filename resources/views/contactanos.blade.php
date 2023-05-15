@extends('layouts.app_web')
@section('tituloPagina','contáctanos')
@section('styles')
@endsection
@section('contenido')

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area" style="background-image: url('/recursos/web/images/img-cursos.jpg');background-color: #233d63 !important;opacity: 0.9 !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <div class="section-heading">
                        <h2 class="section__title" style="color:#28a745 !important">Contáctanos</h2>
                    </div>
                    <ul class="breadcrumb__list">
                        <li class="active__list-item"><a href="{{ route('inicio') }}" style="color:#28a745 !important">Inicio</a></li>
                        <li style="color:#28a745 !important">Contáctanos</li>
                    </ul>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->
<section class="contact-area padding-top-70px text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section__title">¿Quiénes somos?</h2>
                    <span class="section-divider"></span>
                </div><!-- end section-heading -->
            </div><!-- end col-md-12 -->
        </div><!-- end row -->
        <div class="row">
            <div class="col-lg-4">
                <div class="team-single-img">
                    <img src="{{ asset('/recursos/web/images/iiap.png') }}" height="380px" alt="team image" class="team__img">
                </div><!-- end team-single-img -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-8">
                <div class="team-single-wrap">
                    <div class="team-single-content">
                        <div class="team-single-item">
                            {{--<h3 class="widget-title pb-2">¿Quiénes somos?</h3>--}}
                            <p class="line-height-30" style="text-align: justify">
                                El <strong>Instituto de Investigaciones de la Amazonía Peruana (IIAP)</strong>, es una institución de investigación científica y tecnológica concebida para lograr el desarrollo sostenible de la población amazónica, con énfasis en lo rural, especializada en la conservación y uso correcto de los recursos naturales en la región amazónica. Realiza sus actividades de forma descentralizada, promoviendo la participación institucional y de la sociedad civil organizada.
                                Fue creado el año 1981 mediante la Ley N° 23374, siguiendo el mandato del artículo 120 de la Constitución Política del Perú de 1979, siendo ratificado el año 2004 por la Ley Nº 28168, que le otorga personería de derecho público interno, así como autonomía económica y administrativa.
                                A través de estas Direcciones el IIAP, desarrolla la investigación, evaluación y control de los recursos naturales, promoviendo su uso racional y fomentando actividades económicas que permitan el desarrollo sostenible de las comunidades rurales asentadas en la Amazonía peruana.
                                Cuenta con una sede principal en Loreto y con órganos desconcentrados en las regiones amazónicas del Perú, en Loreto, Ucayali, San Martín, Madre de Dios, Amazonas y Huánuco, además de una oficina de coordinación en la ciudad de Lima.
                            </p>
                        </div><!-- end team-single-item -->
                    </div>
                </div><!-- end team-single-wrap -->
            </div><!-- end col-lg-8 -->
        </div>
    </div>
</section>

<section class="contact-area padding-top-70px text-center">
    <div class="container">
        <div class="row margin-top-10px">
            <div class="col-lg-4 column-td-half">
                <div class="post-card post-card-layout-2" style="height: 250px !important;background: #e7eaec">
                    <div class="post-card-content">
                        <h2 class="widget-title mt-2 mb-2" style="color: #28a745">Misión</h2>
                        <p>Generar y proveer conocimientos sobre la diversidad biológica y socio-cultural de la Amazonía peruana, en beneficio de la población, que sean pertinentes, eficientes y confiables</p>
                    </div><!-- end post-card-content -->
                </div>
            </div><!-- end col-lg-4 -->
            <div class="col-lg-4 column-td-half">
                <div class="post-card post-card-layout-2" style="height: 250px !important;background: #e7eaec">
                    <div class="post-card-content">
                        <h2 class="widget-title mt-2 mb-2" style="color: #28a745">Visión</h2>
                        <p>Generar e incorporar conocimientos, tecnologías innovadoras y el saber ancestral, al servicio de las sociedades y de los ecosistemas amazónicos</p>
                    </div><!-- end post-card-content -->
                </div>
            </div><!-- end col-lg-4 -->
            <div class="col-lg-4 column-td-half">
                <div class="post-card post-card-layout-2" style="height: 250px !important;background: #e7eaec">
                    <div class="post-card-content">
                        <h2 class="widget-title mt-2 mb-2" style="color: #28a745">Nosotros</h2>
                        <p>Somos una institución de investigación científica y tecnológica concebida para lograr el desarrollo sostenible de la población amazónica, especializada en la conservación y uso correcto de los recursos naturales.</p>
                    </div><!-- end post-card-content -->
                </div>
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>
<!-- ================================
       START GOOGLE MAP
================================= -->
<div class="map-container section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section__title">Ubícanos en el mapa</h2>
                    <span class="section-divider"></span>
                </div><!-- end section-heading -->
            </div><!-- end col-md-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="map" class="radius-round"></div><!-- end map -->
            </div>
        </div>
    </div>
</div>
<!-- ================================
       END GOOGLE MAP
================================= -->

<!-- ================================
       START CONTACT AREA
================================= -->
<section class="contact-area padding-bottom-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 column-td-half">
                <div class="info-box info-box-color-1 text-center">
                    <div class="hover-overlay"></div>
                    <div class="icon-element mx-auto">
                        <i class="la la-map-marker"></i>
                    </div>
                    <h3 class="info__title">Visítanos</h3>
                    <p class="info__text mb-0">Jr. Ayacucho N° 1171 2° Piso, Chachapoyas</p>
                </div><!-- end info-box -->
            </div><!-- end col-lg-4 -->
            <div class="col-lg-4 column-td-half">
                <div class="info-box info-box-color-2 text-center">
                    <div class="hover-overlay"></div>
                    <div class="icon-element mx-auto">
                        <i class="la la-envelope"></i>
                    </div>
                    <h3 class="info__title">Escríbenos</h3>
                    <p class="info__text mb-0">
                        <span class="d-block">iiapam@iiap.gob.pe</span>
                    </p>
                </div><!-- end info-box -->
            </div><!-- end col-lg-4 -->
             <div class="col-lg-4 column-td-half">
                <div class="info-box info-box-color-3 text-center">
                    <div class="hover-overlay"></div>
                    <div class="icon-element mx-auto">
                        <i class="la la-phone"></i>
                    </div>
                    <h3 class="info__title">Llámanos</h3>
                    <p class="info__text mb-0">
                        <span class="d-block">924755807</span>
                    </p>
                </div><!-- end info-box -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
        <div class="contact-form-wrap pt-5">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-heading">
                        <p class="section__meta">Nosotros</p>
                        <h2 class="section__title">Contáctanos</h2>
                        <span class="section-divider"></span>
                        <p class="section__desc">
                            Si tienes dudas sobre alguno de nuestros cursos, envíanos un mensaje para poder ayudarte.
                        </p>
                        <ul class="social-profile">
                            <li><a href="javascript:"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="javascript:"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="javascript:"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="javascript:"><i class="fa fa-youtube-play"></i></a></li>
                        </ul>
                    </div><!-- end section-heading -->
                </div><!-- end col-lg-5 -->
                <div class="col-lg-7">
                    <div class="contact-form-action">
                        <form method="POST" id="contactform">
                                <div class="row">
                                    {{ csrf_field() }}
                                <div class="col-lg-12">
                                    <div id="error-frm" style="display: none;background: rgba(238, 21, 21, 0.863);padding: 5px;border-radius: 3px;margin-bottom: 8px;">
                                        <p style="font-size: 14px;color:white;text-align: center">
                                            Nombre, apellido y telefono son requeridos.
                                        </p> 
                                    </div> 
                                    <div id="success-frm" style="display: none;background: #51be78;padding: 5px;border-radius: 5px;margin-bottom: 8px;">
                                        <p style="font-size: 13px;color:white;">
                                            Mensaje enviado correctamente.
                                        </p> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-box">
                                        <label class="label-text">Nombre<span class="primary-color-2 ml-1">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese su nombre">
                                            <span class="la la-user input-icon"></span>
                                        </div>
                                    </div>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="input-box">
                                        <label class="label-text">Apellido<span class="primary-color-2 ml-1">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="apellido" id="apellido" placeholder="Ingrese su apellido">
                                            <span class="la la-user input-icon"></span>
                                        </div>
                                    </div>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="input-box">
                                        <label class="label-text">Telefono<span class="primary-color-2 ml-1">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control" type="number" name="telefono" id="telefono" placeholder="Ingrese telefono">
                                            <span class="la la-phone input-icon"></span>
                                        </div>
                                    </div>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="input-box">
                                        <label class="label-text">Correo<span class="primary-color-2 ml-1">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control" type="email" name="correo" id="correo" placeholder="Ingrese correo">
                                            <span class="la la-envelope input-icon"></span>
                                        </div>
                                    </div>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-12">
                                    <div class="input-box">
                                        <label class="label-text">Mensaje<span class="primary-color-2 ml-1">*</span></label>
                                        <div class="form-group">
                                            <textarea class="message-control form-control" name="mensaje" id="mensaje" placeholder="Déjanos un mensaje"></textarea>
                                            <span class="la la-pencil input-icon"></span>
                                        </div>
                                    </div>
                                </div><!-- end col-lg-12 -->
                                <div class="col-lg-12">
                                    <button class="theme-btn" type="button" id="btn-mensaje">Enviar mensaje</button>
                                </div><!-- end col-md-12 -->
                            </div><!-- end row -->
                        </form>
                    </div><!-- end contact-form-action -->
                </div><!-- end col-md-7 -->
            </div><!-- end row -->
        </div>
    </div><!-- end container -->
</section><!-- end contact-area -->
<!-- ================================
       START CONTACT AREA
================================= -->


@endsection

@section('script')
<script src="{{ asset('/recursos/ajax/web/contactanos.js') }}"></script>

@endsection
