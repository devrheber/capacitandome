@extends('layouts.app_webLogueado')
@section('tituloPagina','Revisión proyecto final')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <style>.hover:hover{background: #58c772;color: white;border-radius: 5px;}</style>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="hover p-2" href="{{route('miscursos')}}"><i class="fa fa-home"></i> INICIO</a></li>
                      <li class="breadcrumb-item active" aria-current="page">REVISAR PROY. FINAL</li>
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
                                <h3 style=""><i class="fa fa-check"></i> Seleccione un estudiante para revisar su proyecto final.</h3>
                            </div>
                        </div>
                                              
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="sidebar-widget cardSeccion">                 
                                    <div class="contact-form-action">
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form action="#" autocomplete="off">
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
                                            <div class="col-lg-12">
                                                @if(Session::has('success'))
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        {{ Session::get('success') }}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endif

                                                @if(Session::has('error'))
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        {{ Session::get('success') }}
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="row mt-3">
                                            
                                            <div class="col-lg-12" id="revisarProyFinal_paginate">
                                                
                                                  
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>  
                            
                        </div>
                        
                    </div>
                </div>
            </div><!-- end col-lg-12 -->
        </div>
    </div><!-- end container -->
</section><!-- end my-courses-area -->
<!-- ================================
       START MY COURSES
================================= -->
@endsection

<div class="modal fade" id="ModalNotaProFinal" aria-modal="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus-circle"></i> Calificar proyecto final</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="frm-revisarproy" autocomplete="off">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="identregable" id="identregable">
                        <input type="hidden" name="idusuario" id="idusuario">
                        <input type="hidden" name="idcurso" value="{{$curso->idcurso}}">
                        <div class="col-lg-12 text-center" id="registrando" style="display: none">
                            <span class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br>Guardando...</span>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th>CURSO</th>
                                    <td>{{$curso->titulo}}</td>
                                </tr>
                                <tr>
                                    <th>ESTUDIANTE</th>
                                    <td id="estudiante"></td>
                                </tr>
                                <tr>
                                    <th>NOTA FINAL</th>
                                    <td><input type="text" onkeypress="ValidaSoloNumeros()" name="nota" id="nota" class="form-control"></td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <br>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> GUARDAR</button>
                            <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">CANCELAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        
        listarPaginate(page=1);
        $("#buscar").on('keyup', function () {
            //if ($(this).val() != "") {
                listarPaginate(page = 1);
            //}            
        });

        $(document).on("click", '.paginate-go', function(e) {
            e.preventDefault();
            listarPaginate($(this).attr('href').split('page=')[1]);
        });

        $("#frm-revisarproy").on("submit", function (e) {
            e.preventDefault();
            guardarNotaProyFinal(e);
        })
    })
    function ValidaSoloNumeros() {
        if ((event.keyCode < 48) || (event.keyCode > 57)) 
        event.returnValue = false;
    }
    function listarPaginate(page=1) {
        $.ajax({
            url: `/listaproyectopag/${$("#idcurso").val()}?page=${page}&filtro_search=${$("#buscar").val()}`,
                beforeSend: function( xhr ) {  
                    console.log("cargando.."); 
            }
        })
        .done(function( data ) {
            $("#revisarProyFinal_paginate").html(data);
        });
    }
    function modalProyFinal(identregable,idusuario,idcurso, nota, estudiante){
        if (identregable != "" && idusuario != "" && idcurso != "") {
            $("#ModalNotaProFinal").modal('show');
            $("#estudiante").text(estudiante);
            $("#identregable").val(identregable);
            $("#idusuario").val(idusuario);
            $("#nota").val(nota);
        }
    }

    function guardarNotaProyFinal(e) {
        e.preventDefault();
        var formData = new FormData($("#frm-revisarproy")[0]);
        
        $.ajax({
            url: "/revisarproyecto",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $("#registrando").show();
            },
            success: function(datos) {
                $("#registrando").hide();
                listarPaginate(page=1);
                $("#ModalNotaProFinal").modal('hide');
                datos = JSON.parse(datos);                
                if (datos.data == 'ok') {                    
                    toastr.success(datos.msj,'REGISTRO EXITOSO');
                } else {
                    toastr.success(datos.msj,'HA OCURRIDO UN ERROR');
                }
            },
            error: function (jqXhr) {
                window.location.reload();
            }
        });
    }

</script>
@endsection
