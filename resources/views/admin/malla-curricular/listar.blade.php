@extends('layouts.app_admin')
@section('tituloPagina','Certificaciones')
@section('styles')
@endsection
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list"></i> Configuración de puntaje del curso.</h5>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a>
        </div>
    </div>
</div>
@endsection
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header py-3">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="fa fa-list text-primary"></i>
                        </span>
                        <h3 class="card-label">Lista de cursos</h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Button-->
        
                    
                    <a href="{{route('admin_create_macurricular')}}" class="btn btn-primary font-weight-bolder"> <i class="fa fa-plus-circle"></i> REGISTRAR</a>
                    <!--end::Button-->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="#" method="GET" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">                        
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Buscar curso..." id="buscar_curso">
                                            </div>                                                                                
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-12">
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
                        </div>

                        <div class="col-lg-12" id="tabla_paginate_malla">

                        </div>
                    </div>
                </div>
            </div>
        <!--end::Card-->
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        listarPaginate();

        $("#buscar_curso").on('keyup', function () {
            listarPaginate(page = 1,$(this).val());
        });

        $(document).on("click", '.paginate-go', function(e) {
            e.preventDefault();
            listarPaginate($(this).attr('href').split('page=')[1]);
        });
        
    });

    function listarPaginate(page=1) {
        $.ajax({
            url: `/admin/mallaCurPaginate?page=${page}&filtro_search=${$("#buscar_curso").val()}`,
                beforeSend: function( xhr ) {  
                    console.log("cargando.."); 
            }
        })
        .done(function( data ) {
            $("#tabla_paginate_malla").html(data);
            //console.log(data);
        });
    }

    function eliminar(idmalla_curricular) {
        Swal.fire({
            title: '¿Seguro que quiere eliminar este registro?',
            text: "No se podra recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f64e60',
            // cancelButtonColor: '#f64e60',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.get(`admin/macurricular/delete/${idmalla_curricular}`, function (data, status) {
                    data = JSON.parse(data);
                    //tabla.ajax.reload();
                    if (data.status == true) {
                        Swal.fire('Eliminado', '', 'success');
                        var rowCount = $('#tablaMalla tr').length;
                        listarPaginate(page=1);
                        if (rowCount <= 1) {
                            $('#tablaMalla').append('tr><td class="text-center" colspan="5">Aún no hay cursos registrados...</td></tr>');
                        }

                    }else{
                        alert('Ocurrio un error, se refescara la página');
                        location.reload();
                    }

                });

            }else{

            }
        });
    }
</script>
@endsection