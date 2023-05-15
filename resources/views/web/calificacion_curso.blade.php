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
                                    <div class="card">
                                        <div class="card-header" style="background: green;">
                                            <h3 style="color: white;">Calificación del Curso: {{$curso->titulo}}</h3>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('store_calificacion_curso')}}" method="POST" class="needs-validation" novalidate>
                                                @csrf
                                                <input id="idusuario" name="idusuario" value="{{ auth()->user()->idusuario }}" type="hidden">
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
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="q1value" name="q1value" required>
                                                    <h5 class="card-title">
                                                        <strong>
                                                            1.&nbsp;&nbsp;¿Qué tan interesante considera el contenido del curso?
                                                        </strong>
                                                    </h5>
                                                    <div class="form-check form-check-inline" style="margin-left: 30px;">
                                                        <input class="form-check-input" type="radio" name="pregunta1Opciones" id="q11" value="1" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q11">1</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta1Opciones" id="q12" value="2" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q12">2</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta1Opciones" id="q13" value="3" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q13">3</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta1Opciones" id="q14" value="4" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q14">4</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta1Opciones" id="q15" value="5" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q15">5</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="q2value" name="q2value" value="">
                                                    <h5 class="card-title">
                                                        <strong>
                                                            2.&nbsp;&nbsp;¿Qué tan claros fueron los objetivos del curso?
                                                        </strong>
                                                    </h5>
                                                    <div class="form-check form-check-inline" style="margin-left: 30px;">
                                                        <input class="form-check-input" type="radio" name="pregunta2Opciones" id="q21" value="1" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q21">1</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta2Opciones" id="q22" value="2" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q22">2</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta2Opciones" id="q23" value="3" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q23">3</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta2Opciones" id="q24" value="4" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q24">4</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta2Opciones" id="q25" value="5" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q25">5</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="q3value" name="q3value" value="">
                                                    <h5 class="card-title">
                                                        <strong>
                                                            3.&nbsp;&nbsp;¿Cómo calificarías al docente del curso?
                                                        </strong>
                                                    </h5>
                                                    <div class="form-check form-check-inline" style="margin-left: 30px;">
                                                        <input class="form-check-input" type="radio" name="pregunta3Opciones" id="q31" value="1" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q31">1</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta3Opciones" id="q32" value="2" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q32">2</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta3Opciones" id="q33" value="3" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q33">3</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta3Opciones" id="q34" value="4" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q34">4</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta3Opciones" id="q35" value="5" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q35">5</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="q4value" name="q4value" value="">
                                                    <h5 class="card-title">
                                                        <strong>
                                                            4.&nbsp;&nbsp;¿El nivel de curso se ajusta a sus necesidades?
                                                        </strong>
                                                    </h5>
                                                    <div class="form-check form-check-inline" style="margin-left: 30px;">
                                                        <input class="form-check-input" type="radio" name="pregunta4Opciones" id="q41" value="1" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q41">1</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta4Opciones" id="q42" value="2" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q42">2</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta4Opciones" id="q43" value="3" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q43">3</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta4Opciones" id="q42" value="4" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q42">4</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta4Opciones" id="q42" value="5" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q42">5</label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="q5value" name="q5value" value="">
                                                    <h5 class="card-title">
                                                        <strong>
                                                            5.&nbsp;&nbsp;¿El curso le ha resultado útil?
                                                        </strong>
                                                    </h5>
                                                    <div class="form-check form-check-inline" style="margin-left: 30px;">
                                                        <input class="form-check-input" type="radio" name="pregunta5Opciones" id="q51" value="1" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q51">1</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta5Opciones" id="q52" value="2" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q52">2</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta5Opciones" id="q53" value="3" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q53">3</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta5Opciones" id="q54" value="4" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q54">4</label>
                                                    </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="pregunta5Opciones" id="q55" value="5" style="width: 1.5rem; height: 1.5rem;" />
                                                        <label class="form-check-label" for="q55">5</label>
                                                    </div>

                                                    <div class="form-group">
                                                        <h5 class="card-title">
                                                            <strong>
                                                                6.&nbsp;&nbsp;¿Que actividad o sección le resultó más interesante?
                                                            </strong>
                                                        </h5>
                                                        <input class="form-control" id="q6value" name="q6value"/>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" id="q7value" name="q7value" value="">
                                                        <h5 class="card-title">
                                                            <strong>
                                                                7.&nbsp;&nbsp;¿Cuál sería la valoración del material audiovisual del curso?
                                                            </strong>
                                                        </h5>
                                                        <div class="form-check form-check-inline" style="margin-left: 30px;">
                                                            <input class="form-check-input" type="radio" name="pregunta7Opciones" id="q71" value="1" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q71">1</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta7Opciones" id="q72" value="2" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q72">2</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta7Opciones" id="q73" value="3" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q73">3</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta7Opciones" id="q74" value="4" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q74">4</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta7Opciones" id="q75" value="5" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q75">5</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" id="q8value" name="q8value" value="">
                                                        <h5 class="card-title">
                                                            <strong>
                                                                8.&nbsp;&nbsp;¿El formato del curso se ha ajustado a sus espectativas?
                                                            </strong>
                                                        </h5>
                                                        <div class="form-check form-check-inline" style="margin-left: 30px;">
                                                            <input class="form-check-input" type="radio" name="pregunta8Opciones" id="q81" value="1" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q81">1</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta8Opciones" id="q82" value="2" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q82">2</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta8Opciones" id="q83" value="3" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q83">3</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta8Opciones" id="q84" value="4" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q84">4</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta8Opciones" id="q85" value="5" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q85">5</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" id="q9value" name="q9value" value="">
                                                        <h5 class="card-title">
                                                            <strong>
                                                                9.&nbsp;&nbsp;¿Estaría interesado/a en inscribirse a otro curso de este docente?
                                                            </strong>
                                                        </h5>
                                                        <div class="form-check form-check-inline" style="margin-left: 30px;">
                                                            <input class="form-check-input" type="radio" name="pregunta9Opciones" id="q91" value="1" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q91">1</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta9Opciones" id="q92" value="2" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q92">2</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta9Opciones" id="q93" value="3" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q93">3</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta9Opciones" id="q94" value="4" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q94">4</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta9Opciones" id="q95" value="5" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q95">5</label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="hidden" class="form-control" id="q10value" name="q10value" value="">
                                                        <h5 class="card-title">
                                                            <strong>
                                                                10.&nbsp;&nbsp;¿Recomendaría este curso a otras personas?
                                                            </strong>
                                                        </h5>
                                                        <div class="form-check form-check-inline" style="margin-left: 30px;">
                                                            <input class="form-check-input" type="radio" name="pregunta10Opciones" id="q101" value="1" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q101">1</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta10Opciones" id="q102" value="2" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q102">2</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta10Opciones" id="q103" value="3" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q103">3</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta10Opciones" id="q104" value="4" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q104">4</label>
                                                        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="pregunta10Opciones" id="q105" value="5" style="width: 1.5rem; height: 1.5rem;" />
                                                            <label class="form-check-label" for="q105">5</label>
                                                        </div>
                                                    </div>
                                                    <!--user-->
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