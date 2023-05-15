@extends('layouts.app_admin')
@section('tituloPagina','Editar encuesta')

@section('styles')
@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5" id="txt_titulo"><i class="fa fa-edit"></i> {{ $encuesta->titulo}}</h5>
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="la la-home"></i> Inicio</a>
                <a href="/admin/encuestas" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="la la-book"></i> Encuestas</a>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->

        </div>
    </div>
@endsection

@section('contenido')
    <div class="container">

        <div class="card card-custom">

            <div class="card-header py-3">
                <div class="card-title">
                <span class="card-icon">
                    <i class="fa fa-edit text-primary"></i>
                </span>
                    <h3 class="card-label">Recursos de la encuesta <small>(Los campos notificados son requeridos)</small></h3>
                </div>
            </div>

            <div class="card-body">

                <style>
                    .error-select{border: 1px solid red !important;border-radius: .42rem !important;}
                </style>

                <form name="form_curso" method="POST" action="{{ route('admin_encuesta_recursos') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="idencuesta" value="{{ $encuesta->id }}">

                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table" id="table_recursos">
                                <thead>
                                    <tr>
                                        <th style="width: 100px">#</th>
                                        <th>Pregunta</th>
                                        <th style="width: 150px">Opción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($encuesta->pregunta_encuestas as $index => $pregunta)
                                        <tr>
                                            <td>Pregunta {{$index + 1}}</td>
                                            <td>
                                                <input type="hidden" id="idpregunta[]" value="{{$pregunta->id}}">
                                                <textarea name="pregunta[]" class="form-control">{{$pregunta->nombre}}</textarea>
                                            </td>
                                            <td>
                                                <select name="estado[]" class="form-control">
                                                    <option value="0" {{$encuesta->estado == 1 ? 'selected' : ''}}>DESHABILITADO</option>
                                                    <option value="1" {{$encuesta->estado == 1 ? 'selected' : ''}}>HABILITADO</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12 text-right pt-3">
                            <button type="button" class="btn btn-lg btn-success" id="btnAgregarPregunta"><i class="la la-plus"></i> Agregar pregunta</button>
                            <a href="/admin/encuestas" class="btn btn-lg btn-warning"><i class="la la-close"></i> Cancelar</a>
                            <button type="submit" class="btn btn-lg btn-primary"><i class="la la-pencil-square-o"></i> Actualizar</button>
                        </div>



                    </div>

                </form>
            </div>
            <!--end::Wizard-->
        </div>



    </div>
@endsection

@section('modal')
@endsection

@section('script')
    <script>
        $('#btnAgregarPregunta').click(function () {
            let pregunta = '<tr>';
                pregunta += '<td>Nueva PREGUNTA</td>' +
                        '<td>' +
                            '<input type="hidden" id="idpregunta[]" value="0">' +
                                '<textarea name="pregunta[]" class="form-control" placeholder="Ingrese su pregunta"></textarea>' +
                        '</td>' +
                    '<td>' +
                        '<button type="button" class="btn btn-sm btn-danger eliminar_pregunta"><i class="la la-trash"></i></button>'
                    '</td>';
            pregunta += '</tr>';
            $('#table_recursos tbody').append(pregunta);
        });

        $('body').on('click', '.eliminar_pregunta', function () {
            $(this).parent().parent().remove();
        });
    </script>
@endsection
