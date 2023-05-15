@extends('layouts.app_admin')

@section('tituloPagina','Lista de resultados')

@section('styles')
    <style type="text/css">
        .fila-desactivada {
            background-color: #f64e60;
            color: #ffffff;
        }
    </style>
@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list mr-1"></i> RESULTADOS DE ENCUESTAS</h5>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a>
            </div>
        </div>
    </div>
@endsection

@section('contenido')
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header py-3">
                <div class="card-title">
                    <span class="card-icon"><i class="fa fa-list text-primary"></i></span>
                    <h3 class="card-label">Lista de resultados</h3>
                </div>
            </div><!-- .card-header -->

            <div class="card-body">
                <div class="form-row d-flex align-items-center">
                    <div class="col-md-9 col-xs-12">
                        <div class="form-group mb-9">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Buscar..." id="buscar">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row" id="table_resultados">

                </div>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
@endsection

@section('modal')
    <div class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Recursos del curso</h3>
                        </div>
                        <style>
                            .hoverModal:hover {
                                cursor: pointer;
                                background: rgba(236, 233, 233, 0.747);
                            }
                        </style>
                        <div class="col-xl-6">
                            <!--begin::Stats Widget 5-->
                            <div class="card card-custom card-stretch gutter-b hoverModal">
                                <a id="redirectRequisitos">
                                    <div class="card-body d-flex align-items-center py-0 mt-2">
                                        <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                                            <span class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">REQUISITOS</span>
                                            <span class="font-weight-bold text-success font-size-lg">Requisitos del cuso</span>
                                        </div>
                                        <i class="fas fa-clipboard-list" style="font-size: 50px"></i>
                                    </div>
                                </a>
                            </div>
                            <!--end::Stats Widget 5-->
                        </div>
                        <div class="col-xl-6">
                            <!--begin::Stats Widget 6-->
                            <div class="card card-custom card-stretch gutter-b hoverModal">
                                <a id="redirectTemas">
                                    <div class="card-body d-flex align-items-center py-0 mt-2">
                                        <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                                            <span class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">¿QUE APRENDERÉ?</span>
                                            <span class="font-weight-bold text-success font-size-lg">Temas del curso</span>
                                        </div>
                                        <i class="fas fa-book-reader" style="font-size: 50px"></i>
                                    </div>
                                </a>
                            </div>
                            <!--end::Stats Widget 6-->
                        </div>
                        <div class="col-xl-6">
                            <!--begin::Stats Widget 6-->
                            <div class="card card-custom card-stretch gutter-b hoverModal">
                                <a id="redirectComunidad">
                                    <div class="card-body d-flex align-items-center py-0 mt-2">
                                        <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                                            <span class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">¿DIRIGIDO A?</span>
                                            <span class="font-weight-bold text-success font-size-lg">Dirigido a:</span>
                                        </div>
                                        <i class="fas fa-user-graduate" style="font-size: 50px"></i>
                                    </div>
                                </a>
                            </div>
                            <!--end::Stats Widget 6-->
                        </div>

                        <div class="col-xl-6">
                            <!--begin::Stats Widget 6-->
                            <div class="card card-custom card-stretch gutter-b hoverModal">
                                <a id="redirectDocentes">
                                    <div class="card-body d-flex align-items-center py-0 mt-2">
                                        <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                                            <span class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">DOCENTES</span>
                                            <span class="font-weight-bold text-success font-size-lg">Docentes del curso</span>
                                        </div>
                                        <i class="fas fa-chalkboard-teacher" style="font-size: 50px"></i>
                                    </div>
                                </a>
                            </div>
                            <!--end::Stats Widget 6-->
                        </div>

                        <div class="col-lg-12">
                            <h3>Configuración del curso</h3>
                            <hr>
                        </div>

                        <div class="col-xl-6">
                            <!--begin::Stats Widget 6-->
                            <div class="card card-custom card-stretch gutter-b hoverModal">
                                <a id="redirectExamenes">
                                    <div class="card-body d-flex align-items-center py-0 mt-2">
                                        <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                                            <span class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">EXÁMENES</span>
                                            <span class="font-weight-bold text-success font-size-lg">Gestión de exámenes</span>
                                        </div>
                                        <i class="fas fa-book-reader" style="font-size: 50px"></i>
                                    </div>
                                </a>
                            </div>
                            <!--end::Stats Widget 6-->
                        </div>

                        <div class="col-xl-6">
                            <!--begin::Stats Widget 6-->
                            <div class="card card-custom card-stretch gutter-b hoverModal">
                                <a id="redirectCalificacion">
                                    <div class="card-body d-flex align-items-center py-0 mt-2">
                                        <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                                            <span class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">CALIFICACIONES</span>
                                            <span class="font-weight-bold text-success font-size-lg">Notas del estudiante</span>
                                        </div>
                                        <i class="fas fa-star-half-alt" style="font-size: 50px"></i>
                                    </div>
                                </a>
                            </div>
                            <!--end::Stats Widget 6-->
                        </div>

                        <div class="col-xl-12">
                            <!--begin::Stats Widget 6-->
                            <div class="card card-custom card-stretch gutter-b hoverModal">
                                <a id="redirectSecciones">
                                    <div class="card-body d-flex align-items-center py-0 mt-2">
                                        <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                                            <span class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">SECCIONES</span>
                                            <span class="font-weight-bold text-success font-size-lg">Seciones y clases</span>
                                        </div>
                                        <i class="fas fa-graduation-cap" style="font-size: 50px"></i>
                                    </div>
                                </a>
                            </div>
                            <!--end::Stats Widget 6-->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function index() {
            listar_resultados();

            $("#buscar").on('keyup', function () {
                listar_resultados();
            });

            $(document).on("click", '.paginate-go', function(e) {
                e.preventDefault();
                listar_resultados($(this).attr('href').split('page=')[1]);
            });
        }

        // Listar solo los cursos habilitados
        function listar_resultados(page = 1) {
            $.get(`/admin/encuestas/listar/resultado&page=${page}&filtro_search=${$("#buscar").val()}`, function (data, textStatus, jqXHR) {
                $("#table_resultados").html(data);

                $('[data-toggle="tooltip"]').tooltip()
            });
        }

        function desactivar(idcurso, estado) {
            Swal.fire({
                title: '¿Seguro que quiere cambiar el estado de este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f64e60',
                confirmButtonText: '¡Si, cambiar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get(`/admin/course/cambiarEstado/${idcurso}/${estado}`, function () {
                        Swal.fire('Estado cambiado', 'La página se recargará', 'success');
                    });

                    setTimeout(function() {
                        location.reload();
                    }, 1100); //Espera 1.1 segundos (1100 milisegundos) antes de recargar la página
                }else{

                }
            });
        }

        function mostrarModal(idcurso) {
            if (idcurso != "") {
                $("#exampleModal").modal('show');
                $("#redirectRequisitos").attr('href','/admin/requisitos/'+idcurso);
                $("#redirectTemas").attr('href','/admin/temas/'+idcurso);
                $("#redirectComunidad").attr('href','/admin/comunidad/'+idcurso);
                $("#redirectDocentes").attr('href','/admin/docentes/'+idcurso);

                /*Configuracion del curso*/
                $("#redirectExamenes").attr('href','/admin/course/examen/'+idcurso);
                $("#redirectCalificacion").attr('href','/admin/course/estudiantes/'+idcurso);
                $("#redirectSecciones").attr('href','/admin/course/secciones/'+idcurso);
            } else {
                alert("Recargar la página.");
            }
        }

        index();
    </script>
@endsection
