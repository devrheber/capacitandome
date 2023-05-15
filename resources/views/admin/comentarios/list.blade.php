@extends('layouts.app_admin')
@section('tituloPagina','comentarios')
@section('styles')
    <link href="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list"></i> REPORTE COMENTARIOS</h5>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="javascript:" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a>
            <a href="javascript:" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="fas fa-list"></i> Lista de comentarios</a>
        </div>
    </div>
</div>
@endsection
@section('contenido')
<!--begin::Container-->
<div class="container-fluid">

    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <span class="card-icon">
                    <i class="fa fa-list text-primary"></i>
                </span>
                <h3 class="card-label">ÚLTIMOS COMENTARIOS DE CAPACITÁNDOME</h3>
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="tablaComents">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>FECHA</th>
                        <th>Nombre y apellidos</th>
                        <th>CORREO</th>
                        <th>TELEFONO</th>
                        <th>MENSAJE</th>
                        <th>ESTADO</th>
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
<!--end::Container-->
@endsection

@section('modal')
@endsection

@section('script')
    <script src="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('/recursos/ajax/admin/comentarios/comentarios.js') }}"></script>
@endsection