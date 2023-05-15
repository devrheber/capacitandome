@extends('layouts.app_web')
@section('tituloPagina','Detalle curso')
@section('styles')
<link rel="stylesheet" href="{{ asset('/recursos/web/css/plyr.css') }}">
@endsection
@section('contenido')

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area breadcrumb-detail-area" style="background-image: url('{{ asset('/storage/cursos/'.$cursoId->url_portada_det.'') }}');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content breadcrumb-detail-content">
                    <div class="section-heading">
                        <span class="badge-label">Nuevo</span>
                        <h2 class="section__title mt-1">{{ $cursoId->titulo }}</h2>
                        <h4 class="widget-title mt-2">{{ $cursoId->descripcion }}</h4>
                    </div>
                    <?php
                        $date_i = date_create($cursoId->fecha_inicio);
                        $date_f = date_create($cursoId->fecha_final);
                        $fecha_inicio_i = date_format($date_i, 'd-m-Y');
                        $fecha_final_f = date_format($date_f, 'd-m-Y');
                    ?>
                    <ul class="breadcrumb__list mt-2">
                        <li><span style="color:#F68A03">Exclusivo para tí :</span></li>
                            <li>Inicio : {{ $fecha_inicio_i }}&nbsp;&nbsp;&nbsp;|</li>
                        <li>Final :{{ $fecha_final_f }}</li>
                    </ul>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START COURSE DETAIL
======================================-->
<section class="course-detail margin-bottom-110px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="course-detail-content-wrap margin-top-100px">
                    <div class="post-overview-card margin-bottom-50px">
                        <h3 class="widget-title">¿Qué aprenderás?</h3>
                        <ul class="list-items mt-3">
                            @foreach ($cursoTemas as $cursoTema)
                            <li><i class="la la-check-circle"></i>{{ $cursoTema->temas }}</li>
                            @endforeach
                        </ul>
                    </div><!-- end post-overview-card -->
                    <div class="requirement-wrap margin-bottom-40px">
                        <h3 class="widget-title">Requisitos</h3>
                        <ul class="list-items mt-3">
                            @foreach ($requisitos as $requisito)
                              <li>{{ $requisito->requisitos }}</li>  
                            @endforeach
                        </ul>
                    </div><!-- end requirement-wrap -->
                    <div class="description-wrap margin-bottom-40px">
                        <h3 class="widget-title">Descripción</h3>
                        <p class="mb-2 mt-3">
                            {{ $cursoId->descripcion_larga }}
                        </p>
                    </div><!-- end description-wrap -->
                    <div class="requirement-wrap margin-bottom-30px">
                        <h3 class="widget-title">¿Para quien va dirigido este curso?</h3>
                        <ul class="list-items mt-3 mb-3">
                            @foreach ($estudiantes as $estudiante)
                               <li>{{ $estudiante->comunidad }}</li> 
                            @endforeach
                        </ul>
                    </div><!-- end requirement-wrap -->
                    <div class="curriculum-wrap margin-bottom-60px">
                        <div class="curriculum-header d-flex align-items-center justify-content-between">
                            <div class="curriculum-header-left">
                                <h3 class="widget-title">Plan de estudios</h3>
                            </div>
                            <div class="curriculum-header-right">
                                <span class="curriculum-total__text"><strong>Total:</strong> {{ $cursoId->total_clases }} clases</span>
                                <span class="curriculum-total__hours"><strong>Total:</strong> {{ $cursoId->hora_duracion }} horas</span>
                            </div>
                        </div><!-- end curriculum-header -->
                        <div class="curriculum-content">
                            <div class="accordion accordion-shared" id="accordionExample">
                                @php
                                    $cont = 0;
                                @endphp
                                @foreach ($secioClase as $seccion)
                                @php
                                    $cont ++;
                                @endphp
                                @if ($seccion['cantidad'] > 0)
                                <div class="card">
                                    <div class="card-header" id="heading{{ $seccion['idseccion'] }}">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link d-flex align-items-center justify-content-between"
                                                type="button" data-toggle="collapse" data-target="#collapse{{ $seccion['idseccion'] }}"
                                                aria-expanded="true" aria-controls="collapse{{ $seccion['idseccion'] }}">
                                                <i class="fa fa-angle-up"></i>
                                                <i class="fa fa-angle-down"></i>
                                                {{ $seccion['titulo'] }}
                                                <span>{{ $seccion['cantidad'] }} clases </span>
                                            </button>
                                        </h2>
                                    </div><!-- end card-header -->
                                    @php
                                        $show = ($cont == 1) ? 'show' : '' ;
                                    @endphp
                                    <div id="collapse{{ $seccion['idseccion'] }}" class="collapse {{ $show }}" aria-labelledby="heading{{ $seccion['idseccion'] }}"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <ul class="list-items">
                                                
                                                @foreach ($seccion['clases'] as $clase)
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                            class="d-flex align-items-center justify-content-between">
                                                            <span><i class="fa fa-play-circle mr-2"></i>{{ $clase->titulo }}
                                                                <span class="badge-label badge-secondary"><i class="fa fa-lock"></i></span>
                                                            </span>
                                                            <span class="course-duration">{{ $clase->minutos_video }}</span>
                                                        </a>
                                                    </li> 
                                                @endforeach                                                
                                                
                                            </ul>
                                        </div><!-- end card-body -->
                                    </div><!-- end collapse -->
                                </div><!-- end card -->
                                @endif
                                @endforeach
                                
                                
                            </div><!-- end accordion -->
                        </div><!-- end curriculum-content -->
                    </div><!-- end curriculum-wrap -->
                    <div class="section-block"></div>
                    
                    <div class="instructor-wrap padding-top-50px padding-bottom-45px">
                        <h3 class="widget-title">Instructores</h3>

                        @foreach ($docentes as $docente)
                            <div class="instructor-content margin-top-30px d-flex">
                                <div class="instructor-img">
                                    <a href="javascript:" class="instructor__avatar">
                                        <img src="{{ asset('/storage/personas/'.$docente->foto.'') }}" alt="">
                                    </a>
                                    <ul class="list-items">
                                        @if ($docente->telefono != NULL)
                                            <li><span class="la la-phone"></span>{{ $docente->telefono }}</li>
                                        @endif
                                        @if ($docente->direccion != NULL)
                                            <li><span class="la la-map-marker"></span>{{ $docente->direccion }}</li>
                                        @endif
                                        <li><span class="la la-user"></span> Docente</li>
                                    </ul>
                                </div><!-- end instructor-img -->
                                <div class="instructor-details">
                                    <div class="instructor-titles">
                                        <h3 class="widget-title"><a href="javascript:">{{ $docente->nombre." ".$docente->apellidos  }}</a></h3>
                                        {{--<p class="instructor__subtitle">{{ $docente->carrera }}</p>--}}
                                        <p class="instructor__meta">{{ $docente->perfil }}</p>
                                    </div><!-- end instructor-titles -->
                                    <div class="instructor-desc">
                                        <p>{{ $docente->experiencia_laboral }}</p>
                                    </div><!-- end instructor-desc -->
                                </div><!-- end instructor-details -->
                            </div>
                        @endforeach
                    </div><!-- end instructor-wrap -->
                    
                    
                   
                    <div class="view-more-courses mt-5">
                        <h3 class="widget-title">Nuevos cursos</h3>
                        <div class="view-more-carousel margin-top-30px margin-bottom-50px">

                            @foreach ($cursos as $curso)
                                <div class="card-item">
                                    <div class="card-image">
                                        <a href="{{ route('cursoid', $curso->idcurso) }}" class="card__img"><img style="height: 247px !important;" src="{{ asset('/storage/cursos/'.$curso->portada.'') }}" alt=""></a>
                                        <div class="card-badge">
                                            @if ($curso->plan == 'pago')
                                                <span class="badge-label">Lo más vendido</span>
                                            @else
                                                <span class="badge-label">Gratis</span>
                                            @endif
                                        </div>
                                    </div><!-- end card-image -->
                                    <div class="card-content">
                                        <p class="card__label">
                                            <span class="card__label-text">{{ $curso->categoria }}</span>
                                        </p>
                                        <h3 class="card__title" style="height: 90px !important;">
                                            <a href="{{ route('cursoid', $curso->idcurso) }}">{{ $curso->titulo }}</a>
                                        </h3>
                                        <p class="card__author">
                                            @php
                                                $plataforma = ($curso->plataforma == 1) ? "Zoom" : "Meet" ;
                                            @endphp
                                            @php
                                                switch ($curso->modalidad) {
                                                    case '1':
                                                        $curso->modalidad = 'Online';
                                                        break;
                                                    case '2':
                                                        $curso->modalidad = 'Presencial';
                                                        break;
                                                    case '3':
                                                        $curso->modalidad = 'Online|Presencial';
                                                        break;
                                                    default:
                                                        $curso->modalidad = 'Virtual';
                                                        break;
                                                }
                                            @endphp
                                            <a href="javascript:">Modalidad {{ $curso->modalidad." | ".$plataforma  }}</a>
                                        </p>
                                        <div class="card-action">
                                            <ul class="card-duration d-flex justify-content-between align-items-center">
                                                <li>
                                                    <span class="meta__date">
                                                        <i class="la la-play-circle"></i> {{ $curso->total_clases }} Clases
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="meta__date">
                                                        <i class="la la-clock-o"></i> {{ $curso->hora_duracion }} horas
                                                    </span>
                                                </li>
                                            </ul>
                                        </div><!-- end card-action -->
                                        <div class="card-price-wrap d-flex justify-content-between align-items-center">
                                            <span class="card__price">s/.{{ $curso->precio }}</span>
                                            @if ($curso->plan == 'pago')
                                                <a href="{{ route('checkout', $curso->idcurso) }}" class="text-btn"><i class="la la-shopping-cart" style="font-size: 30px !important"></i></a>
                                            @else
                                                <a href="{{ route('index_suscribirme', $curso->idcurso) }}" class="text-btn"><i class="la la-check" style="font-size: 30px !important"></i></a>
                                            @endif
                                            
                                        </div><!-- end card-price-wrap -->
                                    </div><!-- end card-content -->
                                </div><!-- end card-item -->
                            @endforeach
                        </div><!-- end view-more-carousel -->
                    </div><!-- end view-more-courses -->
                    
                </div><!-- end course-detail-content-wrap -->
            </div><!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar-component">
                    <div class="sidebar">
                        <div class="sidebar-widget sidebar-preview">
                            <div class="sidebar-preview-titles">
                                <h3 class="widget-title">Vista previa del curso</h3>
                                <span class="section-divider"></span>
                            </div>
                            <div class="preview-video-and-details">
                                <div class="preview-course-video">
                                    <!--<div class="row">
                                        <div class="col-md-12">
                                            {{--<div class="plyr__video-embed" id="player"><iframe src="{{ $cursoId->url_video_intro }}"></iframe></div>--}}
                                            <img style="height: 247px !important;" src="{{ asset('/storage/cursos/'.$cursoId->portada.'') }}" alt="">
                                        </div>
                                    </div>-->
                                    <a href="javascript:void(0)" data-toggle="modal" data-target=".preview-modal-form">
                                        <img src="{{ asset('/storage/cursos/'.$cursoId->portada.'') }}" alt="course-img">
                                        <div class="play-button">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="-307.4 338.8 91.8 91.8" style=" enable-background:new -307.4 338.8 91.8 91.8;" xml:space="preserve">
                                                   <style type="text/css">
                                                       .st0{opacity:0.6;fill:#000000;border-radius: 100px;enable-background:new;}
                                                       .st1{fill:#FFFFFF;}
                                                   </style>
                                                <g>
                                                    <circle class="st0" cx="-261.5" cy="384.7" r="45.9"/><path class="st1" d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z"/>
                                                </g>
                                            </svg>
                                        </div>
                                    </a>
                                </div>
                                <div class="preview-course-content">
                                    <p class="preview-course__price d-flex align-items-center">
                                        <span class="price-current">s/.{{ $cursoId->precio }}</span>
                                    </p>
                                    <p class="preview-price-discount__text">
                                        @if ($cursoId->plan == 'pago')
                                            @if ($cursoId->idcurso == 17)
                                                <span class="discount-left__text-text">¡Aproveha!</span> Precio válido hasta el 30/05/2021 
                                            @else
                                                <span class="discount-left__text-text">¡Aproveha!</span> Precio válido hasta el {{ $fecha_inicio_i }}
                                            @endif
                                        @endif
                                    </p>
                                    @if ($cursoId->plan == 'pago')
                                        <div class="buy-course-btn mb-3 text-center">
                                            <a href="{{ route('checkout', $cursoId->idcurso) }}" class="theme-btn w-100 mb-3">
                                                <i class="la la-shopping-cart" style="font-size: 22px !important"> </i>Comprar este curso
                                        </a>
                                        </div>
                                    @else
                                        <div class="buy-course-btn mb-3 text-center">
                                            <a href="{{ route('index_suscribirme', $cursoId->idcurso) }}" class="theme-btn w-100 mb-3">
                                                <i class="la la-check" style="font-size: 18px !important"></i> Inscribirme al curso
                                            </a>
                                        </div>
                                    @endif
                                    
                                    <div class="preview-course-incentives">
                                        <h3 class="widget-title font-size-18">Este curso incluye :</h3>
                                        <ul class="list-items pb-3">
                                            <li><i class="la la-play-circle-o"></i>{{ $cursoId->hora_duracion }} horas de video</li>
                                            <li><i class="la la-file"></i>{{ $cursoId->total_clases }} clases</li>
                                            <li><i class="la la-file-text"></i>Recursos descargables</li>
                                            <li><i class="la la-television"></i>Acceso en móvil</li>
                                            @if ($cursoId->plan == 'pago')
                                            <li><i class="la la-certificate"></i>Certificado de finalización</li>
                                            @endif
                                        </ul>
                                        <div class="section-block"></div>
                                        <div
                                            class="video-content-btn d-flex align-items-center justify-content-between pb-3 pt-3">
                                            <button class="btn">
                                                <i class="la la-heart-o mr-1 bookmark-icon"></i>
                                                <span class="swapping-btn" data-text-swap="Me gusta"
                                                    data-text-original="Calificar">Calificar</span>
                                            </button>
                                            <button class="btn" data-toggle="modal" data-target=".share-modal-form">
                                                <i class="la la-share mr-1"></i>
                                                <span>Compartir</span>
                                            </button>
                                        </div>
                                    </div><!-- end preview-course-incentives -->
                                </div><!-- end preview-course-content -->
                            </div><!-- end preview-video-and-details -->
                        </div><!-- end sidebar-widget -->
                        <div class="sidebar-widget sidebar-feature">
                            <h3 class="widget-title">Detalles del curso</h3>
                            <span class="section-divider"></span>
                            <ul class="list-items">
                                <li>
                                    <span><i class="la la-clock-o"></i>Duración</span>
                                    <span>{{ $cursoId->total_clases }} Clases</span>
                                </li>
                                @if ($cursoId->plan == 'pago')
                                    <li>
                                        <span><i class="la la-play-circle-o"></i>Trabajo cada módulo</span>
                                        <span>Sí</span>
                                    </li>
                                @endif
                                <li>
                                    <span><i class="la la-file-text"></i>Recursos</span>
                                    <span>Sí</span>
                                </li>
                                @if ($cursoId->plan == 'pago')
                                    <li>
                                        <span><i class="la la-puzzle-piece"></i>Examenes</span>
                                        <span>sí</span>
                                    </li>
                                @endif
                                <li>
                                    <span> <i class="la la-language"></i>Idioma</span>
                                    <span>Español</span>
                                </li>
                                @if ($cursoId->plan == 'pago')
                                    <li>
                                        <span><i class="la la-certificate"></i>Certificado</span>
                                        <span>Sí</span>
                                    </li>
                                @endif
                                <style>
                                    .brochure {color: #ffffff !important;text-align: center;}
                                    .brochure:hover{color: #28a745 !important;}
                                </style>
                                
                                @if ($cursoId->brochure != NULL || $cursoId->brochure != "")
                                    <li>
                                        <a href="{{ asset('/storage/cursos/'.$cursoId->brochure.'') }}" target="_blank" class="theme-btn w-100 mb-3 brochure">Descargar Brochure</a>
                                    </li>
                                @endif
                                
                            </ul>
                        </div><!-- end sidebar-widget -->
                        
                        {{--<div class="sidebar-widget recent-widget">
                            <h3 class="widget-title">Últimos cursos</h3>
                            <span class="section-divider"></span>
                            {{ route('cursoid', $curso->idcurso) }}" class="card__img">
                            <img style="height: 247px !important;" src="{{ asset('/storage/cursos/'.$curso->portada.'') }}"
                            @foreach ($cursos as $curso)
                            <div class="recent-item">
                                <div class="recent-img">
                                    <a href="{{ route('cursoid', $curso->idcurso) }}">
                                        <img src="{{ asset('/storage/cursos/'.$curso->portada.'') }}" style="width: 85px !important;height: 80px !important;" alt="blog image">
                                    </a>
                                </div>
                                <div class="recentpost-body">
                                    <span class="recent__meta"> {{ $curso->fecha_inicio." | ".$curso->fecha_final }}</span>
                                    <h4 class="recent__link">
                                        <a href="{{ route('cursoid', $curso->idcurso) }}">{{ $curso->titulo }}</a>
                                    </h4>
                                    <p class="recent-course__price">s/.{{ $curso->precio }}</p>
                                </div>
                            </div>
                            @endforeach
                            
                            
                            <div class="btn-box text-center">
                                <a href="#" class="theme-btn d-block">ver todo</a>
                            </div>
                        </div> --}}
                        <div class="sidebar-widget tag-widget">
                            <h3 class="widget-title">Categorias</h3>
                            <span class="section-divider"></span>
                            <ul class="list-items">                                
                                @foreach ($categorias as $categoria)
                                    <li><a href="javascript:">{{ $categoria->categoria }}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- end sidebar-widget -->
                    </div><!-- end sidebar -->
                </div><!-- end sidebar-component -->
            </div><!-- end col-lg-4 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end course-detail -->
<!--======================================
        END COURSE DETAIL
======================================-->

<!-- end modal-shared -->
<div class="modal-form">
    <div class="modal fade modal-action-form" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-top">
                    <h4 class="modal-title widget-title font-size-20">Reply to review</h4>
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close mb-0"></span>
                    </button>
                </div>
                <div class="contact-form-action">
                    <form method="post">
                        <div class="input-box">
                            <div class="form-group">
                                <i class="la la-pencil input-icon"></i>
                                <textarea class="message-control form-control" name="message" placeholder="Write message here..." required></textarea>
                            </div>
                        </div>
                        <div class="btn-box text-right">
                            <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="theme-btn" >reply</button>
                        </div>
                    </form>
                </div><!-- end contact-form-action -->
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->

<div class="modal-form copy-to-clipboard-modal">
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
                            <input type="text" class="form-control copy-input" value="https://capacitandome.iiap.gob.pe/curso/{{ $cursoId->idcurso }}">
                            <div class="copy-tooltip">
                                <button class="theme-btn theme-btn-light copy-text">Enlace</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end modal-content -->
        </div><!-- end modal-dialog -->
    </div><!-- end modal -->
</div><!-- end modal-form -->

@if ($cursoId->url_video_intro != NULL || $cursoId->url_video_intro !="")
<div class="modal-form">
    <div class="modal fade preview-modal-form" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document" >
            <div class="modal-content" style="background: black !important">
                <!--<div class="modal-top">
                    <h5 class="modal-title"><i class="la la-plus-circle"></i> {{ $cursoId->titulo }}</h5>
                    <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="la la-close"></span>
                    </button>
                </div>-->
                <div class="modal-body">
                    <!--<video controls crossorigin playsinline poster="{{ asset('/storage/cursos/'.$cursoId->portada.'') }}" id="player">-->
                        {{--<source src="{{ $cursoId->url_video_intro }}" type="video/mp4" size="576"/>
                        <source src="{{ $cursoId->url_video_intro }}" type="video/mp4" size="720"/>
                        <source src="{{ $cursoId->url_video_intro }}" type="video/mp4" size="1080"/>--}}
                            <div class="plyr__video-embed" id="player">
                                <iframe
                                  src="{{ $cursoId->url_video_intro }}"
                                  allowfullscreen
                                  allowtransparency
                                  allow="autoplay"
                                ></iframe>
                            </div>
                    <!--</video>-->
                </div>
            </div>
        </div>
    </div><!-- end modal -->
</div>
@endif


@endsection

@section('script')
<script src="{{ asset('/recursos/web/js/plyr.js') }}"></script>
<script>
    var player = new Plyr('#player');
    var player = new Plyr('#player2');
    var player = new Plyr('#player3');
    var player = new Plyr('#player4');
</script>
@endsection
