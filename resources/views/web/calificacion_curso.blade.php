<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Calificación del Curso</title>

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
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>

    <div class="preloader" id="cargando">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>

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
    </section>

    <section class="my-courses-area padding-top-30px padding-bottom-90px">
        <div class="container">
            <div class="row" style="display: flex; justify-content: center;">
                <div class="my-course-content-wrap">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" role="tabpanel">
                            <div class="my-course-content-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(Session::has('success'))
                                            <div class="alert alert-success my-3">
                                                <div class="alert-close">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                    </button>
                                                </div>
                                                {{Session::get('success')}}
                                            </div>
                                        @endif

                                        @if(Session::has('error'))
                                            <div class="alert alert-danger">
                                                <div class="alert-close">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                    </button>
                                                </div>
                                                {{Session::get('error')}}
                                            </div>
                                        @endif

                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card">
                                        <div class="card-header" style="background: green;">
                                            <h3 style="color: white;">Calificación del Curso: {{$curso->titulo}}</h3>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('store_encuesta_curso')}}" method="POST" class="needs-validation" novalidate>
                                                @csrf
                                                <input id="user_id" name="user_id" value="{{ auth()->user()->idusuario }}" type="hidden">
                                                <input id="idcurso" name="idcurso" value="{{ $curso->idcurso }}" type="hidden">
                                                <div class="row-md-10">
                                                    <p>* Evalue el curso entre 1 y 5 teniendo en cuenta el siguiente significado de las puntuaciones: <br></p>
                                                </div>
                                                <div class="row" style="display: flex; justify-content: center;">
                                                    <p style="font-weight: bold;">1-> Nada&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2-> Poco&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3-> Suficiente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4-> Mucho&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5-> Totalmente</p>
                                                </div>

                                                <h5>
                                                    <br>
                                                </h5>
                                                <!--preguntas-->
                                                @foreach($encuesta->pregunta_encuestas as $index => $pregunta)
                                                    <div class="form-group">
                                                        <input type="hidden" name="pregunta[]" value="{{$pregunta->id}}">
                                                        <input type="hidden" class="form-control" id="q1value" name="q1value" required>
                                                        <h5 class="card-title">
                                                            <strong>
                                                                {{ $index + 1 }}.&nbsp;&nbsp;{{ $pregunta->nombre }}
                                                            </strong>
                                                        </h5>

                                                        @if($pregunta->tipo_pregunta == 1)
                                                            <div class="form-check form-check-inline" style="margin-left: 30px;">
                                                                <input class="form-check-input" type="radio" name="respuesta_{{$index}}" id="q1_{{$index}}" value="1" style="width: 1.5rem; height: 1.5rem;" />
                                                                <label class="form-check-label" for="q1_{{$index}}">1</label>
                                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="respuesta_{{$index}}" id="q2_{{$index}}" value="2" style="width: 1.5rem; height: 1.5rem;" />
                                                                <label class="form-check-label" for="q2_{{$index}}">2</label>
                                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="respuesta_{{$index}}" id="q3_{{$index}}" value="3" style="width: 1.5rem; height: 1.5rem;" />
                                                                <label class="form-check-label" for="q3_{{$index}}">3</label>
                                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="respuesta_{{$index}}" id="q4_{{$index}}" value="4" style="width: 1.5rem; height: 1.5rem;" />
                                                                <label class="form-check-label" for="q4_{{$index}}">4</label>
                                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="respuesta_{{$index}}" id="q5_{{$index}}" value="5" style="width: 1.5rem; height: 1.5rem;" />
                                                                <label class="form-check-label" for="q5_{{$index}}">5</label>
                                                            </div>
                                                        @else
                                                            <input class="form-control" id="pregunta_{{$index}}" name="respuesta_{{$index}}"/>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                    <div class="row-md-50" style="display: flex;">
                                                        <div class="col-5 pd-0">
                                                            <p style="font-size: 10px;">* Las respuestas se guardarán a nombre de:&nbsp;</p>
                                                        </div>
                                                        <div class="col-12">
                                                            <p style="color: lightseagreen; font-size: 12px;">{{$nombre->nombreusuario}}</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <!--button-->
                                                    <div class="row" style="display: flex; justify-content: center;">
                                                        <button type="submit" class="btn btn-primary" style="width: 40%;">Enviar</button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




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
        var player = new Plyr('#player');
    </script>
    <script src="{{ asset('/recursos/ajax/web/miaprendizaje.js') }}"></script>


</body>

</html>
