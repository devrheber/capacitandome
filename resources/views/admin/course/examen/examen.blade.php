@extends('layouts.app_admin')

@section('tituloPagina','Exámenes del Curso')

@section('styles')
    <link href="{{ asset('/recursos/admin/assets/css/pages/wizard/wizard-1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">CURSO: {{ $examen->titulo }}</h5>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a>
            <a href="{{ asset('/admin/courses') }}" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="fas fa-list"></i> Ver Cursos</a>
        </div>

    </div>
</div>
@endsection

@section('contenido')
<div class="container">

    <div class="card card-custom gutter-b">
        <div class="card-header" style="min-height: 40px;">
            <div class="card-title">
                <h3 class="card-label text-primary"><i class="fa fa-list"></i> LISTA DE EXÁMENES </h3>
            </div>
            <div class="card-toolbar">
                <a href="admin/course/examen/agregar/{{ $examen->idcurso }}" class="btn btn-primary font-weight-bolder">
                    <i class="fa fa-plus-circle"></i> NUEVO EXAMEN
                </a>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <td class="text-center">
                                <a href="javascript:" class="btn btn-info"><i class="fas fa-question-circle p-0"></i></a>
                            </td>
                            <td>Registrar preguntas</td>
                            <td class="text-center">
                                <a href="javascript:" class="btn btn-info"><i class="fas fa-eye p-0"></i></a>
                            </td>
                            <td>Pre-visualizar examen</td>
                            <td class="text-center">
                                <a href="javascript:" class="btn btn-info"><i class="fas fa-list-ol p-0"></i></a>
                            </td>
                            <td>Notas del estudiante</td>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-hover table-bordered" id="table_examen">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Título</th>
                                <th scope="col">Sección</th>
                                <th scope="col">Fecha final</th>
                                <th scope="col" class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($examen->examenes as $key => $exam)
                            <tr id="tr_{{ $exam->idexamen }}">
                                <td scope="col">{{ $key+1 }}</td>
                                <td scope="col">{{ $exam->titulo }}</td>
                                <td scope="col"><strong>{{ $exam->Seccion->titulo }}</strong></td>
                                {{--<td>{{ $exam->descripcion }}</td>--}}
                                <td scope="col">{{ $exam->fecha_final }}</td>
                                <td scope="col" class="text-center">
                                    <a href="{{ asset('/admin/course/examen/preguntas/' . $exam->idexamen)  }}" class="btn btn-light-info font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Ver preguntas"><i class="fas fa-question-circle p-0"></i></a>
                                    {{-- <a href="{{ asset('/admin/course/examen/resuelto/' . $exam->idexamen . '/') }}" class="btn btn-light-info font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Ver resoluciones"><i class="fas fa-file-contract p-0"></i></a> --}}
                                    <a href="{{ asset('/admin/course/ver/examen/' . $exam->idexamen) }}" class="btn btn-light-info font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Previsualizar"><i class="fas fa-eye p-0"></i></a>
                                    {{-- <a href="javascript:void(0)" onclick="mostrarNotasEstudiantes({{ $exam->idexamen }})" class="btn btn-light-info font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Ver Notas de los estudiantes">
                                        <i class="fas fa-list-ol p-0"></i>
                                    </a> --}}
                                    <a href="{{ asset('/admin/notas/estudiantes/examen/' . $exam->idexamen) }}" class="btn btn-light-info font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Ver Notas de los estudiantes">
                                        <i class="fas fa-list-ol p-0"></i>
                                    </a>
                                    <a href="{{ asset('admin/course/mostrar/examen/' . $exam->idexamen) }}" class="btn btn-light-warning font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="fas fa-edit p-0"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="desactivar({{ $exam->idexamen }})" class="btn btn-light-danger font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                        <i class="fas fa-times p-0"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                            @if (count($examen->examenes) == 0)
                            <tr>
                                <td class="text-center" colspan="5">Aún no hay exámenes registrados...</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>


            </div>

        </div>
    </div>

</div>
@endsection

@section('modal')

<div class="modal fade" id="ModalNotasEstudianteExamen" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" id="contentModalNotasEstudianteExamen">

        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('/recursos/admin/assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
<script src="{{ asset('/recursos/admin/assets/js/pages/features/miscellaneous/toastr.js') }}"></script>

<script>

    function examen() {

        //

    }

    function mostrarNotasEstudiantes(id){

        $.get('/ver/notas/estudiantes/examen/' + id, function(data){

            $('#ModalNotasEstudianteExamen').modal('show');

            $('#contentModalNotasEstudianteExamen').html(data);

        });

    }

    function desactivar(idexamen) {
        Swal.fire({
        title: '¿Seguro que quiere eliminar este registro?',
        text: "No se podra recuperar",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f64e60',
        confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.get(`/admin/course/eliminar/examen/${idexamen}`, function (data, status) {
                    data = JSON.parse(data);

                    console.log(data);

                    if (data.status == true) {

                        Swal.fire('Eliminado', '', 'success');



                        $(`#tr_${idexamen}`).remove();

                        var rowCount = $('#table_examen tr').length;

                        if (rowCount <= 1) {
                            $('#table_examen').append('tr><td class="text-center" colspan="5">Aún no hay exámenes creados...</td></tr>');
                        }

                    }else{
                        alert('Ocurrio un error, se refescara la pagina');
                        location.reload();
                    }

                });

                // location.reload();
            }else{

            }
        })
    }

    examen();

</script>
@endsection
