@extends('layouts.app_admin')

@section('tituloPagina','Notas del estudiante')

@section('styles')
@endsection

@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h3 class="text-dark font-weight-bold my-1 mr-5">CURSO: {{ $curso->titulo }}</h3>
                <input type="hidden" id="idcurso" value="{{ $curso->idcurso }}">
            </div>
        </div>

        <div class="d-flex align-items-center">
            <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a>
            <a href="{{ asset('/admin/courses') }}" class="btn btn-light-primary font-weight-bolder btn-sm">
                <i class="fas fa-book"></i>
                Ver Cursos
            </a>
        </div>

    </div>
</div>
@endsection

@section('contenido')
<div class="container">
                                
    <div class="card card-custom" id="cardEstudiantes">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label text-primary"> Notas del estudiante</h3>
                <small>(El promedio es la sumatoria de los exámenes resueltos)</small>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-center">
                                    <a href="javascript:" class="btn btn-light-info"><i class="fas fa-book-reader p-0"></i></a>
                                </td>
                                <td>
                                    <span>Gestión de exámenes</span><br>
                                    <small class="text-primary">(Ver resolución de exámenes del estudiante)</small>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:" class="btn btn-light-info"><i class="fas fa-star-half-alt p-0"></i></a>
                                </td>
                                <td>
                                    <span>Notas estudiantes</span><br>
                                    <small class="text-primary">(Ver notas de exámenes del estudiante)</small>
                                </td>
                            </tr>                            
                        </table>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <form action="#" autocomplete="off">
                        <div class="form-group">
                            <label for=""><strong>Buscar por nombre o apellido.</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Ingrese nombre o apellidos..." id="searh_estudiante">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row" id="table_lista_estudiantes">
                
            </div>

        </div>
    </div>

</div>
@endsection

@section('modal')

<div class="modal fade" id="ModalNotas" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" id="contentModalNotas">

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

    }

    var card = new KTCard('cardEstudiantes');
    function listar_estudiantes(page=1) {
        let searh_estudiante = $("#searh_estudiante").val();
        let idcurso = $("#idcurso").val();
        $.ajax({
            url: `admin/course/estudiantes/curso/lista?idcurso=${idcurso}&searh_estudiante=${searh_estudiante}`,
                beforeSend: function( xhr ) {  
                    KTApp.block(card.getSelf(), {
                        overlayColor: '#F3F6F9',type: 'loader',state: 'primary',opacity: 0.8,size: 'lg',message: 'Espere por favor...'
                    }); 
            }
        })
        .done(function( data ) {
            $("#table_lista_estudiantes").html(data);
            $('[data-toggle="tooltip"]').tooltip();
            KTApp.unblock(card.getSelf());
        });
    }

    function mostrarNotas(idest, idcurso){

        $.get('admin/course/estudiantes/notas/' + idest + '/' + idcurso, function(data){
            $("#ModalNotas").modal('show');
            $("#contentModalNotas").html(data);
        });

    }

    estudiantes();

</script>
@endsection
