
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Capacitándome -  Mi aprendizaje</title>

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('/recursos/web/images/convenios/icono.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/tooltipster.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/jquery.filer.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/plyr.css') }}">
    <link rel="stylesheet" href="{{ asset('/recursos/web/css/style.css') }}">
    <!-- end inject -->
</head>
<body>

<!-- start cssload-loader -->
<div class="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<!-- end cssload-loader -->

<!-- start cssload-loader -->
<div class="preloader" id="cargando">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<!-- end cssload-loader -->

<!--======================================
        START HEADER AREA
    ======================================-->
<section class="header-menu-area course-dashboard-header">
    <div class="header-menu-fluid">
        <div class="header-menu-content course-dashboard-menu-content">
            <div class="container-fluid">
                <div class="main-menu-content d-flex align-items-center">
                    <div class="logo-box">
                        <a href="#" class="logo" title="Aduca"><img src="{{ asset('/recursos/web/images/convenios/logo-curso.png') }}" alt="logo"></a>
                    </div>
                    <div class="course-dashboard-title">
                        <a href="javascript:">{{ $curso->titulo }}</a>
                        <input type="hidden" id="idcurso_general" value="{{ $curso->idcurso }}">
                    </div>
                    <div class="menu-wrapper">
                        <div class="logo-right-button">
                            <ul class="d-flex align-items-center">
                                <li><a href="#" class="theme-btn theme-btn-light" data-toggle="modal" data-target=".share-modal-form"><i class="la la-share mr-1"></i>Compartir</a></li>
                                <li><a href="{{ route('miscursos') }}" class="theme-btn theme-btn-light"><i class="la la-arrow-left mr-1"></i>Regresar a mis cursos</a></li>
                            </ul>
                        </div><!-- end logo-right-button -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end row -->
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->
    </div><!-- end header-menu-fluid -->
</section><!-- end header-menu-area -->
<!--======================================
        END HEADER AREA
======================================-->



<!--======================================
        START COURSE-DASHBOARD
======================================-->
<section class="course-dashboard">
    <div class="course-dashboard-wrap">
        <div class="course-dashboard-container d-flex">
            <div class="course-dashboard-column" >


                
                <div id="html-clase-novista" style="display: none">
                    <div class="lecture-viewer-text-content">
                        <div class="lecture-viewer-text-body">
                            <h2 class="widget-title font-size-35 pb-4">{{ $curso->titulo }}</h2>
                            <p>{{ $curso->descripcion }}</p>
                            <p>{{ $curso->descripcion_larga }}</p>
                            <div class="lecture-viewer-content-detail">
                                
                                <ul class="list-items pb-4">
                                    
                                    @if (Auth::user()->idrol == 2)
                                        <li>Hola.</li>
                                        <li>Bienvenido : {{ strtoupper(Auth::user()->usuario) }}</li>
                                        <li><strong>Antes de comenzar a ver el curso debes tener en cuenta lo siguiente :</strong></li>
                                        <li><i class="fa fa-check-circle"></i> Marca las clases vistas de acuerdo a tu avance como completadas.</li>
                                        <li><i class="fa fa-check-circle"></i> Los trabajos asignados por cada módulo son opcionales. Se recomienda completarlos ya que serán tomados en cuenta al momento de la evaluación final de curso (CERTFICACIÓN).</li>
                                        <li><i class="fa fa-check-circle"></i> Al hacer preguntas de una determinada clase : Considera plantearlas de manera clara y entendible.</li>
                                        <li><i class="fa fa-check-circle"></i> Los recursos de cada clase son descargables.</li>
                                    @endif
                                    @if (Auth::user()->idrol == 1)
                                        <li>Hola.</li>
                                        <li>Bienvenido : {{ strtoupper(Auth::user()->usuario) }}</li>
                                        <li><strong>Antes de comenzar a ver el curso debes tener en cuenta lo siguiente :</strong></li>
                                        <li><i class="fa fa-check-circle"></i> Marca las clases vistas de acuerdo a tu avance como completadas.</li>
                                        <li><i class="fa fa-check-circle"></i> Responde las preguntas propuestas por el alumno.</li>
                                        <li><i class="fa fa-check-circle"></i> Sube los materiales utilizados en cada clase.</li>
                                    @endif
    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                <div id="htmlDetCurso"></div>
                               
                <!-- HTML DEL VIDEO Y DETALLE DE CADA CURSO -->

                

                







                <div class="section-block"></div>
                <div class="footer-area section-bg padding-top-40px padding-bottom-40px">
                    <div class="container-fluid">
                        <div class="copyright-content copyright-content-2">
                            <div class="row align-items-center">
                                <div class="col-lg-4 column-lmd-half column-td-full">
                                    <div class="copyright-content-inner">
                                        <a href="javascript:">
                                            <img src="{{ asset('recursos/web/images/logo.png')}}" alt="footer logo" class="footer__logo">
                                        </a>
                                        <p class="copy__desc">Derechos reservados. &copy; 2021 CAPACITÁNDOME</p>
                                    </div>
                                </div>
                                
                            </div><!-- end row -->
                        </div><!-- end copyright-content -->
                    </div><!-- end container-fluid -->
                </div><!-- end footer-area -->
            </div><!-- end course-dashboard-column -->
            
            <div class="course-dashboard-sidebar-column">
                <button class="sidebar-open" type="button"><i class="la la-angle-left"></i> Contenido del curso</button>
                <div class="course-dashboard-sidebar-wrap">
                    <div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
                        <h3 class="widget-title font-size-20">Contenido del curso</h3>
                        <button class="sidebar-close" type="button"><i class="la la-times"></i></button>
                    </div><!-- end course-dashboard-side-heading -->
                    <div class="course-dashboard-side-content">
                        <div class="accordion course-item-list-accordion" id="accordionCourseMenu">
                            @php
                                $cont = 1;
                            @endphp
                            @foreach ($clases as $clase)
                            <div class="card">
                                <div class="card-header" id="collapseMenu{{$clase['idseccion']}}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$clase['idseccion']}}" aria-expanded="true" aria-controls="collapse{{$clase['idseccion']}}">
                                            <span class="widget-title font-size-15 font-weight-semi-bold">Sección {{ $cont ++ }}: {{ $clase['titulo'] }}</span>
                                            
                                            @if ($clase['proyectoFinal'] != 3)
                                                <div class="course-duration">
                                                    <span>{{ $clase['cant_clases'] }} clases</span>
                                                </div>
                                            @endif
                                            
                                        </button>
                                    </h2>
                                </div>
                                
                                <div id="collapse{{$clase['idseccion']}}" class="collapse" aria-labelledby="collapseMenu{{$clase['idseccion']}}" data-parent="#accordionCourseMenu">
                                    <div class="card-body">
                                        <div class="course-content-list">
                                            <ul class="course-list">
                                                @php
                                                    $autoi = 1;
                                                @endphp
                                                @foreach ($clase['clases'] as $item)
                                                    <li class="course-item-link" id="video_clase_active"> <!-- ACTIVE -->
                                                        <a href="#">
                                                            <div class="course-item-content-wrap">

                                                                {{--@if (Auth::user()->idrol == 2)--}}
                                                                    @if ($item['url_video'] != "" || $item['url_video'] != null)
                                                                    <div class="custom-checkbox">
                                                                        @php
                                                                            $visto = '';
                                                                            if ($item['visto']==1) {
                                                                                $visto = 'checked';
                                                                            }
                                                                        @endphp
                                                                        
                                                                        <input type="checkbox" id="check_{{$item['idclase']}}" {{ $visto }} onclick="checkSesionVista({{ $item['idclase'] }})">
                                                                        <label for="check_{{$item['idclase']}}"></label>
                                                                        
                                                                    </div>                                                                        
                                                                    @else
                                                                    <div class="custom-checkbox">
                                                                        <input type="checkbox" id="check_{{$item['idclase']}}" disabled>
                                                                        <label for="check_{{$item['idclase']}}"></label>
                                                                    </div>
                                                                    @endif                                                                        
                                                                {{--@endif--}}

                                                                <div class="course-item-content" onclick="getRecursosSeccion({{$idcurso}},{{$item['idclase']}})">
                                                                    <h4 class="widget-title font-size-15 font-weight-medium">{{ $autoi ++ }}. {{ $item['titulo'] }}</h4>
                                                                    <div class="courser-item-meta-wrap">
                                                                        {{--<p class="course-item-meta"><i class="la la-play-circle"></i> $item['minutos_video']</p>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>    
                                                    @if (Auth::user()->idrol == 2)
                                                        @if ($loop->last)
                                                            <li class="course-item-link">
                                                                <a href="#">
                                                                    <div class="course-item-content-wrap">
                                                                        <div class="course-item-content">
                                                                           {{--@if ($item['entregable'] == 1 && $clase['tarea'] == 1)
                                                                                <div class="text-center">
                                                                                    <a href="{{ asset('/storage/archivos/'.$clase['archivo_tarea'].'') }}" target="_blank" class="btn btn-info" style="color: white">
                                                                                        <i class="la la-eye" style="color: white"></i> Ver tarea
                                                                                    </a>
                                                                                    <a href="#" class="btn btn-danger" onclick="elimarTarea({{$clase['idseccion']}})">
                                                                                        <i class="la la-trash" style="color: white"></i> Eliminar
                                                                                    </a>
                                                                                </div>
                                                                            @endif--}}{{-- && $clase['tarea'] == 0--}}

                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    @if ($item['entregable'] == 1)
                                                                                        {{--<a href="javascript:" class="btn btn-success btn-block" data-toggle="modal" data-target=".modal-subir-tarea" onclick="getIdSeccion({{$clase['idseccion']}})">
                                                                                            <i class="la la-plus"></i> Mis tareas
                                                                                        </a>--}}
                                                                                        <a href="{{route('misTareas', array($curso->idcurso,$clase['idseccion']))}}" class="btn btn-success btn-block">
                                                                                            <i class="la la-plus"></i> Mis tareas
                                                                                        </a>
                                                                                    @endif

                                                                                    @if ($item['entregable'] == 3)
                                                                                        <a href="{{route('proyectofinal', array($curso->idcurso,$clase['idseccion']))}}" class="btn btn-primary btn-block"> 
                                                                                            <i class="la la-pencil"></i> PROYECTO FINAL
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-lg-6">
                                                                                    @if ($clase['examen'] == 1)
                                                                                        <a href="{{route('resolverExamenEst',$clase['idexamen'])}}" class="btn btn-primary btn-block">
                                                                                            <i class="la la-book"></i> Examen
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        
                                                                        </div>                                                                        
                                                                    </div>
                                                                </a>
                                                            </li>                                                                            
                                                        @endif
                                                    @endif                                                
                                                @endforeach 
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                

                            </div>
                            @endforeach
                            @if (Auth::user()->idrol == 2)
                                @if(empty($usuario_curso_calificado))
                                <div class="row mt-3 ml-5">
                                    <a href="{{route('calificacion_curso',array($curso->idcurso))}}">
                                        <button class="btn btn-success">
                                            <p>Calificanos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="la la-star" style="color: yellow"></i></p>                              
                                        </button>
                                    </a>
                                </div>
                                @else
                                <div class="row mt-3 ml-5">
                                    <button class="btn btn-success">
                                        <p>Calificado&nbsp;&nbsp;&nbsp;&nbsp;{{$usuario_curso_calificado->promedioCalificacion}}&nbsp;<i class="la la-star" style="color: yellow"></i></p>                              
                                    </button>
                                </div>
                                @endif
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div><!-- end course-dashboard-sidebar-column -->
        </div><!-- end course-dashboard-container -->
    </div><!-- end course-dashboard-wrap -->
</section><!-- end course-dashboard -->
<!--======================================
        END COURSE-DASHBOARD
======================================-->

<!-- start scroll top -->
<div id="scroll-top">
    <i class="fa fa-angle-up" title="Go top"></i>
</div>
<!-- end scroll top -->

<div class="modal-form copy-to-clipboard-modal" id="">
    <div class="modal fade share-modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top mb-0">
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0"></span>
                    </button>
                    <h4 class="modal-title widget-title font-size-20">Compartir este curso</h4>
                </div>
                <div class="copy-to-clipboard-wrap p-4 text-center">
                    <div class="copy-to-clipboard mb-3">
                        <div class="contact-form-action d-flex align-items-center">
                            <span class="success-message">Copiado!</span>
                            <input type="text" class="form-control copy-input" value="https://capacitandome.iiap.gob.pe/miaprendizaje/{{$curso->idcurso}}">
                            <div class="copy-tooltip">
                                <button class="theme-btn theme-btn-light copy-text">Copiar</button>
                            </div>
                        </div>
                    </div><!-- end copy-to-clipboard -->
                    <ul class="">
                        <li>
                            <div class="fb-share-button" data-href="https://capacitandome.iiap.gob.pe/miaprendizaje/{{$curso->idcurso}}" data-layout="button_count" data-size="large">
                                <a target="_blank" 
                                href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fcapacitandome.iiap.gob.pe%2Fmiaprendizaje%2F{{$curso->idcurso}}&amp;src=sdkpreparse" 
                                class="fb-xfbml-parse-ignore"> <i class="fa fa-facebook"></i> Compartir</a></div>
                        </li>
                    </ul>
                </div>
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->

<div class="modal-form copy-to-clipboard-modal">
    <div class="modal fade modal-comentario" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top mb-0">
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0"></span>
                    </button>
                    <h4 class="modal-title widget-title font-size-20">Gracias</h4>
                </div>
                <div class="copy-to-clipboard-wrap p-4 text-center">
                    <h4>
                        TU PREGUNTA HA SIDO REGISTRADA, REVISA TUS NOTIFICACIONES PARA VERIFICAR LA RESPUESTA DEL CURSO
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div><!-- end modal-form -->

<div class="modal-form copy-to-clipboard-modal">
    <div class="modal fade clase-no-vista-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top mb-0">
                    <h4 class="modal-title widget-title font-size-20">IMPORTANTE</h4>
                </div>
                <div class="copy-to-clipboard-wrap p-4 text-center">
                    <h4 id="texto_clase_no_vista"></h4>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <a href="{{route('miscursos')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Regresar a mis cursos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-form copy-to-clipboard-modal">
    <div class="modal fade modal-respuesta" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top mb-0">
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0"></span>
                    </button>
                    <h4 class="modal-title widget-title font-size-20">Gracias</h4>
                </div>
                <div class="copy-to-clipboard-wrap p-4 text-center">
                    <h4>
                        TU RESPUESTA HA SIDO REGISTRADA.
                    </h4>
                </div>
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->


@if (Auth::user()->idrol == 1)
<div class="modal-form">
    <div class="modal fade upload-photo-modal-form" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-top">
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0"></span>
                    </button>
                    <h4 class="modal-title widget-title font-size-20">Registrar archivo</h4>
                </div>
                <div class="contact-form-action">
                    <div class="row">
                        <div class="col-lg-12" id="error-frm"></div>
                        <div class="col-lg-12" id="success-frm"></div>
                    </div>
                    <form action="#" autocomplete="off" enctype="multipart/form-data" id="frm-archivo">
                        @csrf                        
                        <div class="input-box">
                            <label class="label-text">Titulo<span class="primary-color-2 ml-1">*</span></label>
                            <div class="form-group">
                                <input class="form-control" type="text" id="titulo_archivo" name="titulo_archivo" placeholder="Ingrese titulo">
                                <i class="la la-plus-circle input-icon"></i>
                            </div>
                        </div>
                        <div class="input-box">
                            <label class="label-text">Tipo archivo</label>
                            <div class="form-group">
                                <select class="form-control" id="tipo-archivo">
                                    <option value="" selected disabled>SELECCIONE..</option>
                                    <option value="1">ARCHIVO</option>
                                    <option value="2">URL</option>
                                </select>
                                <i class="la la-arrow-right input-icon"></i>
                            </div>
                        </div>
                        <div class="input-box" style="display: none" id="form-archivo">
                            <label class="label-text">Archivo<span class="primary-color-2 ml-1">*</span></label>
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="archivo" name="archivo">
                                </div>
                            </div>
                        </div>
                        <div class="input-box" style="display: none" id="form-url">
                            <label class="label-text">URL<span class="primary-color-2 ml-1">*</span></label>
                            <div class="form-group">
                                <input class="form-control" type="text" id="url" name="url" placeholder="Ingrese enlace">
                                <i class="la la-link input-icon"></i>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="progress" id="div_barra_progress">
                                    <div id="barra_progress" class="progress-bar progress-bar-striped" role="progressbar"
                                        aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"
                                        style="min-width: 2em; width: 0%;">
                                        0%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-box text-right">
                            <button type="button" onclick="cancelar()" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="theme-btn" >Guardar</button>
                        </div>
                    </form>
                </div>
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->
@endif

@if (Auth::user()->idrol == 2)
<div class="modal-form">
    <div class="modal fade modal-subir-tarea" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-top" style="background:#28a745;">
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0" style="color:white"></span>
                    </button>
                    <h4 class="modal-title widget-title font-size-20" style="color:white"> <i class="la la-edit"></i> Subir tarea</h4>
                </div>
                <div class="contact-form-action">
                    {{--<div class="row">
                        <div class="col-lg-12" id="error-frm_t"></div>
                        <div class="col-lg-12" id="success-frm_t"></div>
                    </div>--}}
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-lg-12 pt-2 pb-2" id="error-frm_t"></div>
                            <div class="col-lg-12 pt-2 pb-2" id="success-frm_t"></div>

                            <form action="#" autocomplete="off" enctype="multipart/form-data" id="frm-archivo_t">
                                @csrf                        
                                <input type="hidden" name="idseccion_t" id="idseccion_t">
                                <div class="input-box">
                                    <label class="label-text">TITULO<span class="primary-color-2 ml-1">*</span></label>
                                    <div class="form-group">
                                        <input class="form-control" type="text" id="titulo_archivo_t" name="titulo_archivo_t" placeholder="Ingrese titulo">
                                        <i class="la la-pencil input-icon"></i>
                                    </div>
                                </div>
                                <div class="input-box">
                                    <label class="label-text">ARCHIVO<span class="primary-color-2 ml-1">*</span> | Máximo : <span class="text-danger font-size-9"> 200mb</span></label>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <input type="file" class="form-control-file" name="archivo_t" id="archivo_t">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="progress" id="div_barra_progress">
                                            <div id="barra_progress" class="progress-bar progress-bar-striped" role="progressbar"
                                                aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"
                                                style="min-width: 2em; width: 0%;">
                                                0%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-box text-right">
                                    <button type="button" onclick="cancelar_t()" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="theme-btn" >Guardar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <table class="table table-bordered">
                                <thead style="background:#28a745;color:white">
                                  <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col">TITULO</th>
                                    <th scope="col" class="text-center">NOTA</th>
                                    <th scope="col" class="text-center">DOC</th>
                                    <th scope="col" class="text-center"><i class="fa fa-cogs"></i></th>
                                  </tr>
                                </thead>
                                <tbody id="tablaMisTareas">
                                </tbody>
                                <tfoot id="tablaTareasVacia">
                                    <tr class="text-center">
                                        <td colspan="5">Aún no existen tareas registradas</td>
                                    </tr>
                                </tfoot>
                              </table>
                        </div>
                    </div>
                    
                </div>
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->
@endif



<!-- template js files -->
<script src="{{ asset('/recursos/web/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('/recursos/web/js/popper.min.js') }}"></script>
<script src="{{ asset('/recursos/web/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/recursos/web/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('/recursos/web/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/recursos/web/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('/recursos/web/js/isotope.js') }}"></script>
<script src="{{ asset('/recursos/web/js/waypoint.min.js') }}"></script>
<script src="{{ asset('/recursos/web/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('/recursos/web/js/fancybox.js') }}"></script>
<script src="{{ asset('/recursos/web/js/wow.js') }}"></script>
<script src="{{ asset('/recursos/web/js/plyr.js') }}"></script>
<script src="{{ asset('/recursos/web/js/smooth-scrolling.js') }}"></script>
<script src="{{ asset('/recursos/web/js/jquery.filer.min.js') }}"></script>
<script src="{{ asset('/recursos/web/js/date-time-picker.js') }}"></script>
<script src="{{ asset('/recursos/web/js/emojionearea.min.js') }}"></script>
<script src="{{ asset('/recursos/web/js/copy-text-script.js') }}"></script>
<script src="{{ asset('/recursos/web/js/tooltipster.bundle.min.js') }}"></script>
<script src="{{ asset('/recursos/web/js/main.js') }}"></script>
<script>
    var player  = new Plyr('#player');  
</script>
<script src="{{ asset('/recursos/ajax/web/miaprendizaje.js') }}"></script>
</body>
</html>