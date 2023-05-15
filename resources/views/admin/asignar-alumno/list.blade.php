@extends('layouts.app_admin')
@section('tituloPagina','Asignar alumno.')
@section('styles')
    <link href="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list"></i> REGISTRO DE ALUMNOS A UN CURSO COMPRADO.</h5>
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

    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header py-3">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="fa fa-edit text-primary"></i>
                        </span>
                        <h3 class="card-label">ASIGNAR ALUMNO</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" autocomplete="off" id="form-asig-alumno">
                                <input type="hidden" name="idventa" id="idventa">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p><strong class="text-danger">Importante:</strong></p>
                                        <ul>
                                            <li>Asegúrese de <strong>LIMPIAR EL FORMULARIO</strong> para agregar un nuevo registro.</li>
                                            <li>Al momento de <strong>EDITAR UN REGISTRO</strong> y desea agregar un <strong>NUEVO</strong> limpiar el formulario.</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row py-2 rounded px-4 mr-2" style="background: rgb(244, 247, 247)">
                                    <div class="col-lg-5 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="idcurso">CURSO</label>
                                            <select class="form-control selectpicker" name="idcurso" id="idcurso" data-live-search="true">
                                                <option value="" selected disabled>SELECCIONE UN CURSO</option>
                                                @foreach ($cursos as $curso)
                                                    <option value="{{ $curso->idcurso }}" {{ old('idcurso') == $curso->idcurso ? "selected" : "" }}>
                                                        {{ $curso->titulo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="idpersona">PERSONA</label>
                                            <select name="idpersona" id="idpersona" class="form-control selectpicker" data-live-search="true">
                                                <option value="" selected disabled>SELECCIONE UN CURSO</option>
                                                @foreach ($estudiantes as $estudiante)
                                                    <option value="{{ $estudiante->idpersona }}" {{ old('idpersona') == $estudiante->idpersona ? "selected" : "" }}>
                                                        {{ $estudiante->nombre." ".$estudiante->apellidos." - ".$estudiante->tipo_persona }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-12 col-xs-12 pt-2">
                                        <div class="form-group">
                                            <label for=""></label>
                                            <div class="btn-group d-flex" role="group">
                                                <button type="button" class="btn btn-secondary" onclick="limpiar()"><i class="la la-refresh"></i></button>
                                                <button type="submit" class="btn btn-primary"><i class="la la-plus-circle"></i></button>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered table-head-custom table-checkable" id="tablaAsigAlumno">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>FECHA</th>
                                            <th>NOMBRE Y APELLIDOS</th>
                                            <th>CURSO</th>
                                            <th>COSTO</th>
                                            <th>ACCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!--end::Container-->
@endsection

@section('modal')
@endsection

@section('script')
    <script src="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('/recursos/ajax/admin/asignar-alumno/main.js') }}"></script>
@endsection