<!DOCTYPE html>
<html lang="es">

<head>
    @include('layouts.include.web.head')
    
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
    <!-- Facebook -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v8.0" nonce="K7AUSHO5"></script>
    <!-- end cssload-loader -->
    {{-- @include('layouts.include.web.header') --}}

    <!-- ================================
        START BREADCRUMB AREA
    ================================= -->
    <section class="breadcrumb-area" style="height: 180px;background-color: #233d63 !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="section__title">{{ $examen->titulo }}</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="#">{{ $examen->Curso->titulo }}</a></li>
                            <li class="active__list-item">{{ $examen->Seccion->titulo }}</li>
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
            START COURSE AREA
    ======================================-->
    <section class="course-area padding-top-50px padding-bottom-120px">
        <div class="course-wrapper">
            <div class="container">

                <input type="hidden" id="idexamen" value="{{ $examen->idexamen }}">
                <input type="hidden" id="fecha_final" value="{{ $examen->fecha_final }}">
                
                {{-- <div class="row">
                    <div class="col-md-12">
                        <p class="text-info float-right" id="countdown"></p>
                    </div>
                </div> --}}

                <div class="row">
                    
                     <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('miscursos')}}">REGRESAR A MIS CURSOS</a></li>
                              <li class="breadcrumb-item active" aria-current="page">EXAMEN</li>
                            </ol>
                          </nav>
                    </div>
                    <div class="col-lg-12">
                        <div class="filter-bar">

                          

                            <div class="row">
                                <div class="col-md-12">
                                    <span class="h1 my-2 text-info">NOTA: {{ $resolver_examen->calificacion_final }}/{{ $resolver_examen->calificion_total }}</span>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-muted mb-4">
                                        {{ $examen->descripcion }}
                                    </h3>
                                </div>
                               
                            </div>

                            

                            @foreach ($examen->preguntas as $index => $pregunta)
                                
                            <div class="row">
                                <div class="col-md-12">
                                    @php
                                        $respuesta_correcta = '';
                                        $alternativa_correcta = false;
                                    @endphp

                                    

                                    <h4 class=""> <b>{{ ($index + 1) }}.-</b> <span class="font-weight-bold">{{ $pregunta->nombre }}</span> <i class="text-muted h6"> ({{ $pregunta->puntos }} puntos)</i></h4>
                                
                                    @foreach ($pregunta->alternativas as $alternativa)

                                        @php
                                            $flat_respuesta = false;
                                        @endphp

                                        @if ($resolver_examen)
                                            @foreach ($resolver_examen->DetalleResolverExamen as $detalle_resolver_examen)
                                                @if ($detalle_resolver_examen->idpregunta == $alternativa->idpregunta && $detalle_resolver_examen->idalternativa == $alternativa->idalternativa)
                                                    @php
                                                        $flat_respuesta = true;
                                                    @endphp

                                                    @if ($alternativa->correcta == 1)
                                                        @php
                                                            $alternativa_correcta = true;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif

                                        <ul class="ml-4">
                                            <li class="h5 my-2">
                                                <span class="badge {{ ($flat_respuesta) ? 'badge-primary' : '' }}">{{ $alternativa->nombre }}</span>
                                                
                                            </li>

                                        
                                        </ul>

                                        @if ($alternativa->correcta == 1)
                                            @php
                                                 $respuesta_correcta = $alternativa->nombre ;
                                            @endphp
                                        @endif
                                    @endforeach


                                    {{-- <p><span class="{{ ($alternativa->correcta == 1)? 'badge badge-success' :'' }}">{{ $alternativa->nombre }}</span></p> --}}

                                    <div class="{{ ($alternativa_correcta) ? 'alert alert-success': 'alert alert-danger' }} alert-dismissible show" role="alert">
                                        <span class="alert-inner--icon">
                                            <i class="ni ni-bell-55"></i>
                                        </span>
                                        <span class="alert-inner--text ml-1 pt-0">
                                            @if ($alternativa_correcta)
                                                Bien +{{ $pregunta->puntos }} puntos, la respuesta es: {{ $respuesta_correcta }}
                                            @else
                                                Mal, la respuesta es: {{ $respuesta_correcta }}
                                            @endif
                                            
                                            
                                            <strong> </strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success btn-lg mt-4">
                                        <i class="fa fa-save"></i> Entregar examen
                                    </button>
                                </div>
                            </div> --}}
                        </div><!-- end filter-bar -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
    </section><!-- end courses-area -->
    <!--======================================
            END COURSE AREA
    ======================================-->





    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="fa fa-angle-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    

    @include('layouts.include.web.scripts')

  

</body>

</html>
