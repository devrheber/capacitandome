@extends('layouts.app_admin')
@section('tituloPagina','Archivos de clase')
@section('styles')
    <link href="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list"></i> REPORTE DE ARCHIVOS DE CLASE</h5>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="javascript:" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a>
        </div>
    </div>
</div>
@endsection
@section('contenido')
<!--begin::Container-->
<div class="container">

    <div class="row">
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header py-3">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="fa fa-edit text-primary"></i>
                        </span>
                        <h3 class="card-label">REGISTRAR ARCHIVO</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" autocomplete="off" id="form-archivo">
                        <input type="hidden" name="idrecurso" id="idrecurso">
                        @csrf
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
                        <div class="form-group">
                            <label for="idclase">MÓDULO</label>
                            <select class="form-control selectpicker" id="idseccion" name="idseccion" data-live-search="true">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="idclase">CLASE</label>
                            <select class="form-control selectpicker" id="idclase" name="idclase" data-live-search="true">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">TITULO</label>
                            <input type="text" class="form-control" placeholder="Ingrese titulo" name="titulo_archivo" id="titulo_archivo">
                        </div>
                        <div class="form-group">
                            <label for="">TIPO ARCHIVO</label>
                            <select class="form-control selectpicker" id="tipo-archivo" name="tipo-archivo">
                                <option value="" selected disabled>SELECCIONE..</option>
                                <option value="1">ARCHIVO</option>
                                <option value="2">URL</option>
                            </select>
                        </div>
                        <div class="form-group" style="display: none" id="input-archivo">
                            <label for="">ARCHIVO</label>
                            {{--<input type="file" class="form-control-file" id="archivo" name="archivo">--}}
                            <div class="custom-file">
                                <input type="hidden" name="archivo_antiguo" id="archivo_antiguo">
                                <input type="file" name="archivo" class="custom-file-input" id="archivo">
                                <label class="custom-file-label" for="file" id="text-archivo"></label>
                            </div>
                        </div>
                        <div class="form-group" style="display: none" id="input-url">
                            <label for="">URL</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="Ingrese URL del archivo.">
                        </div>
                        <div class="text-right">
                            <button type="button" onclick="limpiar()" class="btn btn-warning">
                                <i class="fa fa-trash"></i> LIMPIAR
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus-circle"></i> GUARDAR
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header py-3">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="fa fa-list text-primary"></i>
                        </span>
                        <h3 class="card-label" id="textClase"></h3>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom table-checkable" id="tablaRecClase">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>TITULO</th>
                                <th>ARCHIVO</th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>


</div>
<!--end::Container-->
@endsection

@section('modal')
@endsection

@section('script')
    <script src="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('/recursos/ajax/admin/arch-clases/main.js') }}"></script>
@endsection