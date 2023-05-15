@extends('layouts.app_admin')
@section('tituloPagina','Certificaciones')
@section('styles')
@endsection
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list"></i> CERTIFICACIÓN</h5>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{route('admin_index_certificacion')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="la la-book"></i> Cursos</a>
            <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a>
        </div>
    </div>
</div>
@endsection
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                        </button>
                    </div>
                    <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">
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
        </div>

        <div class="col-lg-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="d-flex">
                        <!--begin: Pic-->
                        <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                            <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                <span class="font-size-h3 symbol-label font-weight-boldest">CURSO</span>
                                {{--<input type="hidden" value="14" id="value_idcurso">--}}
                            </div>
                        </div>
                        <!--end: Pic-->
                        <!--begin: Info-->
                        <div class="flex-grow-1">
                            <!--begin: Title-->
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <div class="mr-3">
                                    <!--begin::Name-->
                                    <a href="javascript:" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                        Curso : {{$curso->titulo}}
                                    <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                                    <!--end::Name-->
                                    @php
                                        $puntos_exam        = ($mallacurricular->puntaje_examen_final * 20) / 100;
                                        $puntos_proy_final  = ($mallacurricular->puntaje_trabajo_final * 20) / 100;
                                    @endphp 
                                    <!--begin::Contacts-->
                                    <div class="d-flex flex-wrap my-2">
                                        <a href="javascript:" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <span class="mr-1">
                                                <i class="fa fa-book-reader"></i> Examen : {{$mallacurricular->puntaje_examen_final}}% = {{$puntos_exam }} puntos
                                            </span>
                                        </a>
                                        <a href="javascript:" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <span class="mr-1">
                                                <i class="fa fa-book-reader"></i> Proyecto final : {{$mallacurricular->puntaje_trabajo_final}}% = {{$puntos_proy_final}} puntos
                                            </span>
                                        </a>
                                    </div>
                                    <!--end::Contacts-->
                                </div>
                                <div class="my-lg-0 my-1">
                                    <a href="javascript:" class="btn btn-sm btn-success mr-3">{{strtoupper($curso->plan)}}</a>
                                </div>
                            </div>
                        </div>
                        <!--end: Info-->
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom card-stretch gutter-b" id="cardCertificado">
                <div class="card-body">
                    <form action="#" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="searh_estudiante" placeholder="Buscar nombre o apellido"/>
                                        <input type="hidden" value="{{$idcurso}}" id="idcurso">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button"><i class="la la-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive-lg" id="tabla_paginate_certifi"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        <!--end::Card-->
        </div>
    </div>
</div>
@endsection

@section('modal')

<div class="modal fade" id="ModalCertificado" aria-modal="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-medal p-0"></i> Importar Certificado</h5>
            </div>
            <div class="modal-body">
                <div class="bd-intro ps-lg-4">
                    <div class="d-md-flex  justify-content-between">
                        <h1 class="bd-title" id="cursoModal"></h1>
                    </div>
                    <p class="bd-lead" id="estudianteModal"></p>
                </div>
                <br>

                <form action="#" id="frm-certificado" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <input type="hidden" name="idUser" id="idUser">
                        <input type="hidden" name="idCurso" id="idCurso">
                        <div class="col-lg-12 text-center" id="registrando" style="display: none">
                            <span class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br>Guardando...</span>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="certificado" name="certificado">
                            </div>
                        </div>
                        <hr>
                        <br>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> GUARDAR</button>
                            <button type="button" class="btn btn-secondary float-right mr-2" data-dismiss="modal">CANCELAR</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>

    function estudiantes() {

        listar_estudiantes();
        $("#searh_estudiante").on('keyup', function () {
            listar_estudiantes();
        });
        $("#frm-certificado").on("submit", function (e) {
            e.preventDefault();
            guardarCertificado(e);
        })
    }

    var card = new KTCard('cardCertificado');
    function listar_estudiantes() {

        let searh_estudiante = $("#searh_estudiante").val();
        let idcurso = $("#idcurso").val();

        $.ajax({
            url: `admin/tablaPagCertificados?idcurso=${idcurso}&searh_estudiante=${searh_estudiante}`, 
            beforeSend: function( xhr ) {  
                    KTApp.block(card.getSelf(), {
                        overlayColor: '#F3F6F9',type: 'loader',state: 'primary',opacity: 0.8,size: 'lg',message: 'Cargando. Espere por favor...'
                    });
            }
            })
            .done(function( data ) {
                $("#tabla_paginate_certifi").html(data);
                KTApp.unblock(card.getSelf());
            });
    }
    function ModalCertificado(idUser, idCurso, nombre, curso){
        $("#ModalCertificado").modal('show');
        $("#cursoModal").text('Curso: ' + curso);
        $("#estudianteModal").text('Estudiante: ' + nombre);
        $("#idUser").val(idUser);
        $("#idCurso").val(idCurso);
    }

    function guardarCertificado(e) {
        e.preventDefault();
        var formData = new FormData($("#frm-certificado")[0]);
        
        $.ajax({
            url: "/guardarcertificado",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $("#registrando").show();
            },
            success: function(datos) {
                $("#registrando").hide();
                listar_estudiantes(page=1);
                $("#ModalCertificado").modal('hide');
                datos = JSON.parse(datos);  
                //console.log(datos);              
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
    estudiantes();
</script>
@endsection