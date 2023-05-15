<!DOCTYPE html>
<html lang="es">

<head>
    @include('layouts.include.web.head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">
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
                            <h4 class="section__title">{{ $examen->titulo }}</h4>
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

                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('miaprendizaje',$examen->idcurso)}}">MI APRENDIZAJE</a></li>
                              <li class="breadcrumb-item active" aria-current="page">EXAMEN</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-info float-right" id="countdown"></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="filter-bar">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="text-muted mb-4">
                                        {{ $examen->descripcion }}
                                    </h3>
                                </div>
                                {{-- <div class="col-md-2">
                                    <input type="hidden" id="fecha_final" value="{{ $examen->fecha_final }}">
                                    <i class="fa fa-calendar"></i> 
                                    Expira {{ \Carbon\Carbon::parse($examen->fecha_final)->diffForHumans() }} 
                                    <br>
                                    <small> {{ \Carbon\Carbon::parse($examen->fecha_final)->format('d/m/Y H:i:s') }} </small>
                                </div> --}}
                            </div>

                            {{-- <div class="row">
                                {{ $examen }}
                            </div> --}}

                            @foreach ($examen->preguntas as $index => $pregunta)
                                
                            <div class="row">
                                <div class="col-md-12">

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
                                                @endif
                                            @endforeach
                                        @endif
                                        

                                    <ul class="ml-4">
                                        <li class="h5 my-2">
                                            <div class="custom-control custom-radio mb-3">
                                                
                                                <input class="custom-control-input alternativa" 
                                                       id="alternativa_{{ $alternativa->idalternativa }}" 
                                                       name="alternativa_{{ $alternativa->idpregunta }}"
                                                       type="radio" value="{{ $alternativa->idalternativa }}" data-idpregunta="{{ $pregunta->idpregunta }}" {{ ($flat_respuesta) ? 'checked' : ''  }}>

                                                <label class="custom-control-label" for="alternativa_{{ $alternativa->idalternativa }}">
                                                    <span>{{ $alternativa->nombre }}</span>
                                                </label>
                                            </div>
                                        </li>

                                       
                                    </ul>
                                    @endforeach

                                   
                                </div>
                            </div>
                            @endforeach

                            <div class="row">
                                <div class="col-md-12">
                                    <button id="btn_terminar_examen" class="btn btn-success btn-lg mt-4">
                                        <i class="fa fa-save"></i> Terminar examen
                                    </button>
                                </div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js"></script>
    <script>

        function alternativa() {
      
            $(".alternativa").on('click', function () {
                let idexamen      = $("#idexamen").val();
                let idpregunta    = $(this).data("idpregunta");
                let idalternativa = $(this).val();

                var formData = new FormData();
                    formData.append('idexamen', idexamen);
                    formData.append('idpregunta', idpregunta);
                    formData.append('idalternativa', idalternativa);

                $.ajax({
                    url: "/resolver/examen/guardar",
                    type: "POST",
                    contentType: "application/json",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        response = JSON.parse(response);

                        console.log(response);
                    }
                });
            });

            $("#btn_terminar_examen").on('click', function () {


                Swal.fire({
                    title: '¿Seguro de terminar su examen?',
                    text: 'Asegúrese de haber respondido todas las preguntas',
                    icon: 'warning',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Si, terminar`,
                    denyButtonText: `No, continuar resolviendo`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        let idexamen = $("#idexamen").val();

                        var formData = new FormData();
                            formData.append('idexamen', idexamen);

                        $.ajax({
                            url: "/resolver/examen/terminar",
                            type: "POST",
                            contentType: "application/json",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                response = JSON.parse(response);

                                if (response.status == true) {
                                    
                                    Swal.fire(response.message, '', 'success')

                                    location.reload();

                                }else{
                                   

                                    Swal.fire(response.message, '', 'error')
                                }
                            }
                        });

                    } else if (result.isDenied) {
                        // Swal.fire('Changes are not saved', '', 'info')
                    }
                })

                
            });


            setInterval(cuenta_regresiva, 1000);

        }


        function cuenta_regresiva() {
            var end = new Date($("#fecha_final").val());

            var _second = 1000;
            var _minute = _second * 60;
            var _hour = _minute * 60;
            var _day = _hour * 24;
            var timer;

            var now = new Date();
            var distance = end - now;

            if (distance < 0) {

                clearInterval(timer);
                document.getElementById('countdown').innerHTML = 'Ha culminado!';

                return;
            }
            
            var days = Math.floor(distance / _day);
            var hours = Math.floor((distance % _day) / _hour);
            var minutes = Math.floor((distance % _hour) / _minute);
            var seconds = Math.floor((distance % _minute) / _second);

            document.getElementById('countdown').innerHTML = 'Te quedan: ';
            document.getElementById('countdown').innerHTML += days + ' dias, ';
            document.getElementById('countdown').innerHTML += hours + ' horas, ';
            document.getElementById('countdown').innerHTML += minutes + ' minutos y ';
            document.getElementById('countdown').innerHTML += seconds + ' segundos';

        }

        alternativa();


    </script>

</body>

</html>
