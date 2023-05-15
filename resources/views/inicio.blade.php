@extends('layouts.app_web')

@section('tituloPagina','inicio')

@section('styles')
    <!-- styles -->
@endsection

@section('contenido')
    <!--================================
            START SLIDER AREA
    =================================-->
    {{--
    <section class="slider-area">
        <div class="single-slide-item single-slide-item-2 slide-bg4">
            <div id="perticles-js-2"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h3 class="section__title">CAPACITÁNDOME <br>
                                La mejor experiencia de aprendizaje</h3>
                            <p class="section__desc">
                                Estudia desde cero o especialízate en las áreas con mayor demanda laboral
                            </p>
                        </div>
                        <div class="hero-search-form">
                            <div class="contact-form-action">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <a href="{{ route('cursos') }}" class="theme-btn">Especializaciones</a>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- end contact-form-action -->
                        </div>
                    </div><!-- col-lg-12 -->
                </div><!-- row -->
            </div><!-- container -->
            <div class="our-post-content">
                <span class="hw-circle"></span>
                <span class="hw-circle"></span>
                <span class="hw-circle"></span>
                <div class="how-we-work-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="our-post-item">
                                    <i class="la la-laptop icon-element"></i>
                                    <div class="our__text">
                                        <h4 class="widget-title">Capacitación online</h4>
                                        <p>Explore una variedad de temas nuevos</p>
                                    </div><!-- our__text -->
                                </div><!-- our-post-item -->
                            </div><!-- col-lg-4 -->
                            <div class="col-lg-4">
                                <div class="our-post-item">
                                    <i class="la la-users icon-element"></i>
                                    <div class="our__text">
                                        <h4 class="widget-title">Docentes especializados</h4>
                                        <p>Encuentra el instructor adecuado para tí</p>
                                    </div><!-- our__text -->
                                </div><!-- our-post-item -->
                            </div><!-- col-lg-4 -->
                            <div class="col-lg-4">
                                <div class="our-post-item">
                                    <i class="la la-graduation-cap icon-element"></i>
                                    <div class="our__text">
                                        <h4 class="widget-title">Sé un profesional de calidad</h4>
                                        <p>Aprende con nosotros</p>
                                    </div><!-- our__text -->
                                </div><!-- our-post-item -->
                            </div><!-- col-lg-4 -->
                        </div><!-- row -->
                    </div>
                </div><!-- end how-we-work-wrap -->
            </div><!-- our-post-content -->
        </div><!-- end single-slide-item -->
    </section> --}}

    <section class="slider-area">    
        <div class="hero-slide owl-dot-and-nav">
            <div class="single-slide-item" style="background-image: url('/recursos/web/images/slider-img4.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-heading">
                                <h2 class="section__title text-white">Te ayudamos aprender <br> lo que amas</h2>
                                <p class="section__desc">Domina las habilidades con un aprendizaje profundo.
                                    <br>Aplica lo que aprendes con cuestionarios a tu propio ritmo y proyectos prácticos.
                                </p>
                            </div>
                            <div class="btn-box d-flex align-items-center">
                                <a href="{{route('cursos')}}" class="theme-btn theme-btn-hover-light">Especializaciones</a>
                                {{--<a href="#" class="btn-text video-play-btn ml-4" data-fancybox="video" data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk" data-speed="700">
                                    Watch Preview<i class="la la-play icon-btn ml-2"></i>
                                </a>--}}
                            </div>
                        </div><!-- col-lg-12 -->
                    </div><!-- row -->
                </div><!-- container -->
            </div><!-- end single-slide-item -->
            <div class="single-slide-item" style="background-image: url('/recursos/web/images/slider-img3.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-heading text-center">
                                <h4 class="section__title text-white">Únete a CAPACITÁNDOME<br> y aprende con nosotros!</h4>
                                <p class="section__desc" style="opacity: 0.9;">
                                    <br>
                                    <br>
                                </p>
                            </div>
                            <div class="btn-box d-flex align-items-center justify-content-center">
                                <a href="{{route('cursos')}}" class="theme-btn theme-btn-hover-light">Especializaciones</a>
                                {{--<a href="#" class="btn-text video-play-btn ml-4" data-fancybox="video" data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk" data-speed="700">
                                    Watch Preview<i class="la la-play icon-btn ml-2"></i>
                                </a>--}}
                            </div>
                        </div><!-- col-lg-12 -->
                    </div><!-- row -->
                </div><!-- container -->
            </div><!-- end single-slide-item -->
            
            
            <div class="single-slide-item" style="background-image: url('/recursos/web/images/slider-img2.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-heading text-right">
                                <h2 class="section__title text-white">Aprende en cualquier momento,<br> y cualquier lugar</h2>
                                <p class="section__desc">Tenemos los mejores cursos y docentes especializados
                                    <br>para fortalecer tu aprendizaje.
                                </p>
                            </div>
                            <div class="btn-box hero-btn-right d-flex align-items-center justify-content-end">
                                {{--<a href="#" class="btn-text video-play-btn mr-4" data-fancybox="video" data-src="https://www.youtube.com/watch?v=cRXm1p-CNyk" data-speed="700">
                                <i class="la la-play icon-btn mr-2"></i>Watch Preview
                                </a>--}}
                                <a href="{{route('cursos')}}" class="theme-btn theme-btn-hover-light">Especializaciones</a>
                            </div>
                        </div><!-- col-lg-12 -->
                    </div><!-- row -->
                </div><!-- container -->
            </div><!-- end single-slide-item -->
        </div><!-- end hero-slide -->
    </section><!-- end slider-area -->
    <!--================================
        END SLIDER AREA
    =================================-->

    <!--======================================
            START FEATURE AREA
    ======================================-->
    <section class="feature-area text-center">
        <div class="container">
            <div class="feature-content-wrap">
                <div class="row">
                    <div class="col-lg-4 column-td-half">
                        <div class="info-box info-box-color-1">
                            <div class="hover-overlay"></div>
                            <div class="icon-element mx-auto">
                                <i class="la la-laptop icon-element"></i>
                            </div>
                            <h3 class="info__title">Capacitación online</h3>
                            <p class="info__text">Explore una variedad de temas nuevos</p>
                            <a href="{{ route('cursos') }}" class="text-btn">Especializaciones</a>
                        </div><!-- end info-box -->
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-4 column-td-half">
                        <div class="info-box info-box-color-2">
                            <div class="hover-overlay"></div>
                            <div class="icon-element mx-auto">
                                <i class="la la-users"></i>
                            </div>
                            <h3 class="info__title">Docentes especializados</h3>
                            <p class="info__text">Encuentra el instructor adecuado para tí</p>
                            <a href="{{ route('cursos') }}" class="text-btn">Especializaciones</a>
                        </div><!-- end info-box -->
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-4 column-td-half">
                        <div class="info-box info-box-color-3">
                            <div class="hover-overlay"></div>
                            <div class="icon-element mx-auto">
                                <i class="la la-graduation-cap icon-element"></i>
                            </div>
                            <h3 class="info__title">Sé un profesional de calidad</h3>
                            <p class="info__text">Aprende con nosotros</p>
                            <a href="{{ route('cursos') }}" class="text-btn">Especializaciones</a>
                        </div><!-- end info-box -->
                    </div><!-- end col-lg-3 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container -->
    </section><!-- end feature-area -->
    <!--======================================
            END FEATURE AREA
        ======================================-->
    <!--
    <section class="choose-area section-padding text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h5 class="section__meta">Nosotros</h5>
                        <h2 class="section__title">¿Quiénes somos?</h2>
                        <span class="section-divider"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="team-single-img">
                        {{-- <img src="{{ asset('/recursos/web/images/iiap.png') }}" height="380px" alt="team image" class="team__img"> --}}
                    </div>
                </div>
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
                            </div>
                        </div>
                        <div class="team-single-content padding-top-10px text-left">
                            <div class="row">
                                <div class="col-lg-12 column-td-half">
                                    <div class="team-single-item">
                                        <div class="logo-right-button">
                                            <a href="/contactanos" class="theme-btn">
                                            <i class="fa fa-plus-circle"></i> MÁS INFORMACIÓN
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <div class="section-block"></div>

    <!--======================================
        START COURSE AREA
    ======================================-->
    <section class="course-area">
        <div class="card-content-wrapper padding-top-40px padding-bottom-115px text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading">
                            <h5 class="section__meta">Capacitaciones</h5>
                            <h2 class="section__title">Nuestras capacitaciones</h2>
                            <span class="section-divider"></span>
                        </div><!-- end section-heading -->
                    </div><!-- end col-lg-6 -->
                </div><!-- end row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="tab1">
                                <div class="row">
                                    @php
                                        $cont = 1;
                                    @endphp

                                    @foreach ($cursos as $curso)
                                        @php $cont ++ @endphp
                                        
                                        <div class="col-lg-4 column-td-half">
                                            <div class="card-item card-preview" data-tooltip-content="#tooltip_content_{{$cont + 1}}">
                                                <div class="card-image">
                                                    <a href="{{ route('cursoid', $curso->idcurso) }}" class="card__img">
                                                        <img style="height: 247px !important;" src="{{ asset('/storage/cursos/'.$curso->portada.'') }}" alt="">
                                                    </a>
                                                    
                                                    <div class="card-badge">
                                                        @if ($curso->plan == 'gratis')
                                                            <span class="badge-label">Gratis</span>
                                                        @else
                                                            <span class="badge-label">Lo más vendido</span>
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
                                                    <p class="card__author">
                                                        <a href="javascript:" class="text-center"><i class="la la-laptop"></i> Modalidad {{ $curso->modalidad }}</a>
                                                    </p>
                                                    <div class="card-action">
                                                        <ul
                                                            class="card-duration d-flex justify-content-between align-items-center">
                                                            <li>
                                                                <span class="meta__date">
                                                                    <i class="la la-play-circle"></i> {{ $curso->total_clases }} Clases
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="meta__date">
                                                                    <i class="la la-clock-o"></i> {{ $curso->hora_duracion }} Horas
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div><!-- end card-action -->
                                                    <div
                                                        class="card-price-wrap d-flex justify-content-between align-items-center">
                                                        <span class="card__price">s/.{{ $curso->precio }}</span>
                                                        @if ($curso->plan == 'gratis')
                                                            <a href="{{ route('index_suscribirme', $curso->idcurso) }}" class="text-btn"><i class="la la-check" style="font-size: 30px !important"></i></a>
                                                        @else
                                                            <a href="{{ route('checkout', $curso->idcurso) }}" class="text-btn"><i class="la la-shopping-cart" style="font-size: 30px !important"></i></a>
                                                        @endif
                                                    </div><!-- end card-price-wrap -->
                                                </div><!-- end card-content -->
                                            </div><!-- end card-item -->
                                        </div><!-- end col-lg-4 -->

                                        <div class="tooltip_templates">
                                            <div id="tooltip_content_{{$cont + 1}}">
                                                <div class="card-item">
                                                    <div class="card-content">
                                                        <p class="card__author">
                                                            <a href="javascript:">{{ $curso->categoria }}</a>
                                                        </p>
                                                        <h3 class="card__title">
                                                            <a href="{{ route('cursoid', $curso->idcurso) }}">{{ $curso->titulo }}</a>
                                                        </h3>
                                                        <p class="card__label">
                                                            <span class="card__label-text mr-1"><i class="la la-laptop"></i> Modalidad {{ $curso->modalidad }}</span>
                                                            <span class="mr-1">|</span><a href="javascript:" class="mr-1">Plataforma</a> <span>| {{ ($curso->plataforma == 1) ? 'Zoom' : 'Meet'  }}</span>
                                                        </p>
                                                        <div class="card-para mb-3">
                                                            <p class="font-size-14 line-height-24">
                                                                {{ $curso->descripcion }}
                                                            </p>
                                                        </div>
                                                        <a href="javascript:" class="card__label-text mr-1">Incluye :</a>
                                                        <ul class="list-items mb-3 font-size-14">
                                                            <li>Recursos de clase</li>
                                                            <li>Certificado</li>
                                                            <li>Acceso indefinido</li>
                                                        </ul>
                                                        <div class="card-action">
                                                            <ul class="card-duration d-flex justify-content-between align-items-center">
                                                                <li><span class="meta__date"><i class="la la-play-circle"></i> {{ $curso->total_clases }} Clases</span></li>
                                                                <li><span class="meta__date"><i class="la la-clock-o"></i> {{ $curso->hora_duracion }} Horas</span></li>
                                                            </ul>
                                                        </div><!-- end card-action -->
                                                        <div class="btn-box w-100 text-center mb-3">
                                                            <a href="{{ route('cursoid', $curso->idcurso) }}" class="theme-btn d-block">VER DETALLE</a>
                                                        </div>
                                                        <div class="card-price-wrap d-flex justify-content-between align-items-center">
                                                            <span class="card__price">s/.{{ $curso->precio }}</span>
                                                            <a href="{{ route('checkout', $curso->idcurso) }}" class="text-btn"><i class="la la-shopping-cart" style="font-size: 30px !important"></i></a>
                                                        </div><!-- end card-price-wrap -->
                                                    </div><!-- end card-content -->
                                                </div><!-- end card-item -->
                                            </div>
                                        </div><!-- end tooltip_templates -->
                                    @endforeach                                    
                                </div><!-- end course-block -->
                            </div><!-- end tab-pane -->
                        </div><!-- end tab-content -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="btn-box mt-4 text-center">
                            <a href="{{ route('cursos') }}" class="theme-btn">Ver todos los cursos</a>
                        </div><!-- end btn-box -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end card-content-wrapper -->
    </section><!-- end courses-area -->
    <!--======================================
        END COURSE AREA
    ======================================-->

    <div class="section-block"></div>

    <!--======================================
        START CATEGORY AREA
    ======================================-->
    <section class="category-area padding-top-120px category-area2 text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h5 class="section__meta">DOCENTES</h5>
                        <h2 class="section__title">Nuestros mejores docentes</h2>
                        <span class="section-divider"></span>
                    </div><!-- end section-heading -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
            <div class="row margin-top-28px">

                {{--@foreach ($categorias as $categoria)
                    <div class="col-lg-4 column-td-half">
                        <div class="category-item category-item-layout-2">
                            <a href="javascript:" class="category-content">
                                <i class="{{ $categoria->icono }} icon-element"></i>
                                <h3 class="cat__title">{{ $categoria->categoria }}</h3>
                            </a><!-- end category-content -->
                        </div><!-- end category-item -->
                    </div>
                @endforeach--}}

                
                    <div class="col-lg-4">
                        <div class="section-heading">
                            <p class="section__desc">
                                Los mejores docentes: Especialistas con experiencia profesional, empresarial y amplio conocimiento de su materia.
                            </p>
                        </div><!-- end section-heading -->
                        <div class="btn-box">
                            <a href="{{ route('cursos') }}" class="theme-btn">VER CAPACITACIONES</a>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="testimonial-subtitle pb-3">
                            <h3 class="widget-title font-weight-medium"> {{--Más de count($docentes)--}} Nuestros docentes te esperan para guiarte en tu aprendizaje.</h3>
                        </div>
                        <div class="testimonial-carousel-2">
                            
                            @foreach ($docentes as $docente)
                                <div class="testimonial-item testimonial-item-layout-2">
                                    <div class="testimonial__desc">
                                        <p class="testimonial__desc-desc" style="height: 170px !important;text-align:justify;font-size: 12px;">
                                            {{$docente->perfil}}
                                        </p>
                                    </div><!-- end testimonial__desc -->
                                    <div class="testimonial-header">
                                        @if ($docente->foto != "" || $docente->foto != null)
                                            <img src="{{ asset('/storage/personas/'.$docente->foto.'') }}" alt="small-avatar">
                                        @else
                                            <img src="{{ asset('/recursos/web/images/testi-img2.jpg') }}" alt="small-avatar">
                                        @endif
                                        <div class="testimonial__name mt-2" style="height: 80px !important">
                                            <h5 class="testimonial__name-title">{{$docente->nombre." ".$docente->apellidos}}</h5>
                                            <!--<span class="testimonial__name-meta">{{$docente->carrera}}</span>-->
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div><!-- end testimonial-carousel-2 -->
                    </div><!-- end col-lg-8 -->
                </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end category-area -->
    <!--======================================
        END CATEGORY AREA
    ======================================-->

    <!-- ================================
    START FUNFACT AREA
    ================================= -->
    <section class="funfact-area text-center overflow-hidden padding-top-85px padding-bottom-85px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 column-td-half">
                    <div class="counter-item">
                        <span class="la la-bullhorn count__icon"></span>
                        <h4 class="count__title counter">8{{--$total_cursos--}}</h4>
                        <p class="count__meta">Certificaciones</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-4 column-td-half">
                    <div class="counter-item">
                        <span class="la la-globe count__icon"></span>
                        <h4 class="count__title counter text-color">853{{--$total_alumnos--}}</h4>
                        <p class="count__meta">Alumnos</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-3 -->
                <div class="col-lg-4 column-td-half">
                    <div class="counter-item">
                        <span class="la la-users count__icon"></span>
                        <h4 class="count__title counter text-color-2">28{{--$total_docente--}}</h4>
                        <p class="count__meta">Docentes</p>
                    </div><!-- end counter-item -->
                </div><!-- end col-lg-3 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end funfact-area -->
    <!-- ================================
    END FUNFACT AREA
    ================================= -->

    <!--======================================
        START GET-START AREA
    ======================================-->
    <section class="get-start-area get-start-area2 padding-top-120px padding-bottom-110px overflow-hidden">
        <div class="box-icons">
            <div class="box-one"></div>
            <div class="box-two"></div>
            <div class="box-three"></div>
            <div class="box-four"></div>
        </div><!-- end box-icons -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="get-start-content">
                        <div class="section-heading">
                            <h5 class="section__meta section__metalight">¡Capacítate con nosotros!</h5>
                            <h6 class="section__title text-white">
                                Diplomados, talleres y cursos de especialización
                                dirigido a profesionales y público en general.
                            </h6>
                            <span class="section-divider section-divider-light"></span>
                        </div><!-- end section-heading -->
                        <div class="btn-box margin-top-20px">
                            <a href="{{ route('cursos') }}" class="theme-btn theme-btn-hover-light">Las mejores capacitaciones</a>
                        </div>
                    </div><!-- end get-start-content -->
                </div><!-- end col-lg-10 -->
            </div><!-- end row -->
        </div><!-- end container -->
        <div class="box-icons2">
            <div class="box-one"></div>
            <div class="box-two"></div>
            <div class="box-three"></div>
            <div class="box-four"></div>
            <div class="box-five"></div>
        </div><!-- end box-icons2 -->
    </section><!-- end get-start-area -->
    <!--======================================
        END GET-START AREA
    ======================================-->

    <!-- ================================
    START CLIENTLOGO AREA
    ================================= -->
    <section class="clientlogo-area overflow-hidden padding-top-120px padding-bottom-100px text-center">
        <div class="stroke-line">
            <span class="stroke__line"></span>
            <span class="stroke__line"></span>
            <span class="stroke__line"></span>
        </div>
        
        {{--<div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="client-logo-heading">
                        <div class="section-heading">
                            <h5 class="section__meta">Alianzas Estratégicas</h5>
                            <h2 class="section__title">Empresas que confían en nosotros</h2>
                            <span class="section-divider"></span>
                            <p class="section__desc">
                                Convenios realizados en función del desarrollo productivo y trasferencia de conocimientos tecnológicos.
                            </p>
                            
                        </div><!-- end section-heading -->
                    </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="client-logo-2">
                        <div class="row">
                            <div class="col-lg-6 column-td-half">
                                <div class="client-logo-item client-logo-item-2">
                                    <a href="javascript:">
                                        <img src="{{ asset('/recursos/web/images/convenios/fondecyt.png') }}" style="119px !important; height:80px !important;" alt="brand image">
                                    </a>
                                </div><!-- end client-logo-item -->
                            </div>
                            <div class="col-lg-6 column-td-half">
                                <div class="client-logo-item client-logo-item-2">
                                    <a href="javascript:">
                                        <img src="{{ asset('/recursos/web/images/convenios/upeu.png') }}" style="119px !important; height:80px !important;" alt="brand image">
                                    </a>
                                </div><!-- end client-logo-item -->
                            </div>
                            <div class="col-lg-6 column-td-half">
                                <div class="client-logo-item client-logo-item-2">
                                    <a href="javascript:"><img src="{{ asset('/recursos/web/images/convenios/pnipa.jpg') }}" style="119px !important; height:80px !important;" alt="brand image"></a>
                                </div><!-- end client-logo-item -->
                            </div>
                            <div class="col-lg-6 column-td-half">
                                <div class="client-logo-item client-logo-item-2">
                                    <a href="javascript:"><img src="{{ asset('/recursos/web/images/convenios/u-t.jpg') }}" style="119px !important; height:80px !important;" alt="brand image"></a>
                                </div><!-- end client-logo-item -->
                            </div>
                            <div class="col-lg-6 column-td-half">
                                <div class="client-logo-item client-logo-item-2">
                                    <a href="javascript:"><img src="{{ asset('/recursos/web/images/convenios/unifslb.png') }}" style="119px !important; height:80px !important;" alt="brand image"></a>
                                </div><!-- end client-logo-item -->
                            </div>
                        </div>
                    </div><!-- end client-logo -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container -->--}}
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h5 class="section__meta">Alianzas Estratégicas</h5>
                        <h2 class="section__title">Nuestros Convenios</h2>
                        <span class="section-divider"></span>
                        <p class="section__desc">
                            Convenios realizados en función del desarrollo productivo y trasferencia de conocimientos tecnológicos.
                        </p>
                    </div><!-- end section-heading -->
                </div><!-- end col-md-12 -->
            </div><!-- end row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="client-logo margin-top-30px">
                        <div class="client-logo-item" style="margin-right: 20px">
                            <a href="javascript:"><img src="{{ asset('/recursos/web/images/convenios/fondecyt.png') }}" style="height: 80px !important" alt="Fondecyt"></a>
                        </div><!-- end client-logo-item -->
                        <div class="client-logo-item" style="margin-right: 20px">
                            <a href="javascript:"><img src="{{ asset('/recursos/web/images/convenios/upeu.png') }}" style="height: 60px !important" alt="Upeu"></a>
                        </div><!-- end client-logo-item -->
                        <div class="client-logo-item" style="margin-right: 20px">
                            <a href="javascript:"><img src="{{ asset('/recursos/web/images/convenios/pnipa.jpg') }}" style="height: 70px !important" alt="PNIPA"></a>
                        </div><!-- end client-logo-item -->
                        <div class="client-logo-item" style="margin-right: 20px">
                            <a href="javascript:"><img src="{{ asset('/recursos/web/images/convenios/u-t.jpg') }}" style="height: 70px !important" alt=""></a>
                        </div><!-- end client-logo-item -->
                        <div class="client-logo-item" style="margin-right: 20px">
                            <a href="javascript:"><img src="{{ asset('/recursos/web/images/convenios/unifslb.png') }}" style="height: 70px !important" alt="unifslb"></a>
                        </div>
                    </div><!-- end client-logo -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div>

        <div class="stroke-line2">
            <span class="stroke__line"></span>
            <span class="stroke__line"></span>
            <span class="stroke__line"></span>
        </div>
    </section><!-- end clientlogo-area -->
    <!-- ================================
    END CLIENTLOGO AREA
    ================================= -->

    <div class="section-block"></div>

    <!--======================================
        START REGISTER AREA
    ======================================-->
    <section class="register-area register-area2 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="register-heading">
                        <div class="section-heading">
                            <h5 class="section__meta">CONTACTO</h5>
                            <h2 class="section__title">Envíanos un mensaje y ponte en contacto con nosotros.</h2>
                            <span class="section-divider"></span>
                            <p class="section__desc mb-2">
                                No dudes en ponerte en contacto con nosotros 
                                mediante la información de contacto a continuación, 
                                o envíanos un mensaje mediante el formulario.
                            </p>
                            <ul class="list-items pb-3" style="list-style: none !important;">
                                <li><i class="la la-phone"></i>924755807</li>
                                <li><i class="la la-envelope"></i>iiapam@iiap.gob.pe</li>
                                <li><i class="la la-map-marker"></i>Jr. Ayacucho N° 1171 2° Piso</li>
                                <li><i class="la la-whatsapp"></i>924755807</li>
                            </ul>
                            
                        </div><!-- end section-heading -->
                        <!--<div class="btn-box">
                        <a href="#" class="theme-btn">get started</a>
                    </div> -->
                    </div><!-- end register-heading -->
                </div><!-- end col-lg-7 -->
                <div class="col-lg-5">
                    <div class="register-form">
                        <div class="contact-form-action">
                            <h3 class="widget-title">Déjanos un mensaje</h3>
                            <form method="post" autocomplete="off" id="frm-mensaje">
                                {{ csrf_field() }}
                                <div id="error-frm" style="display: none;background: red;padding: 5px;border-radius: 5px;margin-bottom: 8px;">
                                    <p style="font-size: 13px;color:white;">
                                        Nombre, telefono y mensaje son requeridos.
                                    </p> 
                                </div> 
                                <div id="success-frm" style="display: none;background: #51be78;padding: 5px;border-radius: 5px;margin-bottom: 8px;">
                                    <p style="font-size: 13px;color:white;">
                                        Mensaje enviado correctamente.
                                    </p> 
                                </div> 
                                <div class="input-box">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="nombre_apellido"
                                            placeholder="Nombre(s) y apellidos">
                                        <span class="la la-user input-icon"></span>
                                    </div>
                                </div><!-- end input-box -->
                                <div class="input-box">
                                    <div class="form-group">
                                        <input class="form-control" type="email" name="correo"
                                            placeholder="Correo electronico">
                                        <span class="la la-envelope-o input-icon"></span>
                                    </div>
                                </div><!-- end input-box -->
                                <div class="input-box">
                                    <div class="form-group">
                                        <input class="form-control" type="number" name="telefono" placeholder="Telefono">
                                        <span class="la la-phone input-icon"></span>
                                    </div>
                                </div><!-- end input-box -->
                                <div class="input-box">
                                    <div class="form-group">
                                        <textarea class="form-control" type="text" name="mensaje"
                                            placeholder="Escribenos un mensaje"></textarea>
                                        <span class="la la-book input-icon"></span>
                                    </div>
                                </div><!-- end input-box -->
                                                            
                                <div class="btn-box">
                                    <button id="btn-mensaje" class="theme-btn" type="button">ENVIAR</button>
                                </div><!-- end btn-box -->
                            </form>
                        </div><!-- end contact-form-action -->
                    </div>
                </div><!-- end col-lg-5 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end register-area -->
    <!--======================================
        END REGISTER AREA
    ======================================-->
@endsection

@section('modal')
@endsection

@section('script')
    <script src="{{ asset('/recursos/ajax/web/inicio.js') }}"></script>
@endsection