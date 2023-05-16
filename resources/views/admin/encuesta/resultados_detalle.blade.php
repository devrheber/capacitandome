@extends('layouts.app_admin')

@section('tituloPagina','Detalle de encuesta resuelta')

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
                    <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list mr-1"></i> DETALLE DEL ENCUESTA RESUELTA</h5>
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
                    <h3 class="card-label">Lista de preguntas resueltas</h3>
                </div>
            </div><!-- .card-header -->

            <div class="card-body">
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Pregunta</th>
                            <th>Respuesta/Puntos</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($respuestas as $respuesta)
                            <tr>
                                <td>{{ $respuesta->pregunta->nombre }}</td>
                                <td>{{ $respuesta->respuesta }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
@endsection

@section('script')
@endsection
