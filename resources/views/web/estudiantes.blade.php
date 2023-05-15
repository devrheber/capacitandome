@extends('layouts.app_webLogueado')
@section('tituloPagina','Mis cursos')
@section('styles')

@endsection
@section('contenido')

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area my-courses-bread" style="height: 210px;background-color: #233d63 !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content my-courses-bread-content">
                    <div class="section-heading">
                        <h2 class="section__title">"{{$curso->titulo}}"</h2>
                        <input type="hidden" id="idcurso" value="{{$curso->idcurso}}">
                        <h2 style="color:#28a745; text-align: center">SECCIÓN : {{$seccion->titulo}}</h2>
                        <input type="hidden" id="idseccion" value="{{$seccion->idseccion}}">
                    </div>
                </div><!-- end breadcrumb-content -->
                <div class="my-courses-tab">
                    <div class="section-tab section-tab-2">
                        <ul class="nav nav-tabs" role="tablist" id="review">
                            <li role="presentation">
                                <a href="#all-courses" role="tab" data-toggle="tab" class="active" aria-selected="true">
                                    TAREAS
                                </a>
                            </li>                                                  
                        </ul>
                    </div>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START MY COURSES
================================= -->
<section class="my-courses-area padding-top-30px padding-bottom-90px">
    <style>@media screen and (max-width: 600px) {.container-fluid {/*background-color: olive;color: white;*/padding: 20px;}}</style>
    <div class="container-fluid padding-left-90px padding-right-90px">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <style>.hover:hover{background: #58c772;color: white;border-radius: 5px;}</style>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="hover p-2" href="{{route('revisarTarea',$curso->idcurso)}}"><i class="fa fa-home"></i> SECCIONES</a></li>
                      <li class="breadcrumb-item active" aria-current="page">REVISAR TAREAS</li>
                    </ol>
                  </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="my-course-content-wrap">
                    <div class="my-course-content-body">

                        <div class="row">
                            <div class="col-lg-12 mt-2 mb-3">
                                <h3 style=""><i class="fa fa-check"></i> Seleccione un estudiante para revisar su tarea.</h3>
                            </div>
                        </div>
                                              
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <div class="sidebar-widget cardSeccion">                 
                                    <div class="contact-form-action">
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form method="GET" action="#" autocomplete="off">
                                                    <div class="row">                                                        
                                                        <div class="col-lg-10">
                                                            <input type="text" class="form-control mb-2" style="height: 40px !important" id="buscar" placeholder="Buscar por apellido">
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <button type="button" class="btn btn-outline-primary btn-block mb-2"><i class="fa fa-search"></i></button>
                                                        </div>                                                        
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            
                                            <div class="col-lg-12" id="estudiante_paginate">
                                                {{--PAGINATE ESTUDIANTES--}} 
                                            </div>

                                        </div>
                                        
                                    </div>
                                </div>
                            </div>  

                            
                            <div class="col-lg-6" id="estudiantes_tarea">

                                <div class="row">
                                    <div class="sidebar-widget cardSeccion">                 
                                        <div class="contact-form-action" >
                                            <div class="col-lg-12 text-center">
                                                <h4> <i class="fa fa-edit"></i> Seleccione un estudiante para ver sus tareas.</h4>
                                                <img src="/recursos/web/images/img_tareas.png" width="100" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>


                        </div>                        
                    </div>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end my-courses-area -->
<!-- ================================
       START MY COURSES
================================= -->


@endsection

@section('script')
<script>
    //listaEstudiantes RUTA
    $(document).ready(function () {
        listarPaginate(page=1);
        console.log($("#idcurso").val()+" - "+$("#idseccion").val());
    })
    function ValidaSoloNumeros(event) {
        if ((event.keyCode < 48) || (event.keyCode > 57)) 
        event.returnValue = false;
    }

    $("#buscar").on('keyup', function () {
        listarPaginate(page = 1);
        //console.log($("#buscar").val());
    });

    $(document).on("click", '.paginate-go', function(e) {
        e.preventDefault();
        listarPaginate($(this).attr('href').split('page=')[1]);
    });

    function listarPaginate(page=1) {
        $.ajax({
            url: `/estpaginate/${$("#idcurso").val()}/${$("#idseccion").val()}?page=${page}&filtro_search=${$("#buscar").val()}`,
                beforeSend: function( xhr ) {  
                    console.log("Cargando..."); 
            }
        })
        .done(function( data ) {
            $("#estudiante_paginate").html(data);
        });
    }
    function listaTareaEstudiante(idcurso,idseccion,idusuario) {
        if (idcurso != "" && idseccion != "" && idusuario != "") {
            $.ajax({
                url: `/listartareasest/${idcurso}/${idseccion}/${idusuario}`,
                    beforeSend: function( xhr ) {  
                        $("#cargando").show(); 
                }
            })
            .done(function( data ) {
                $("#estudiantes_tarea").html(data);
                $("#cargando").hide(); 
            });
        }
    }
</script>
@endsection

