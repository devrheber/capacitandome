@extends('layouts.app_admin')
@section('tituloPagina','reporte de pagos')
@section('styles')
@endsection
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list"></i> Seleccione un curso</h5>
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
    <style>.hover:hover{background: #a3f5b6 !important;cursor: pointer;}</style>
    <div class="row">
        @foreach ($curso as $item)
        <div class="col-xl-4">
            <a href="{{route('admin_certificacionId',$item->idcurso)}}">
                <div class="card card-custom card-stretch gutter-b hover">
                    <div class="card-body d-flex align-items-center py-0 mt-8">
                        <div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h5 mb-2 text-hover-primary">{{$item->titulo}}</span>
                            <span class="font-weight-bold text-muted font-size-lg">Estudiantes : <strong>{{$item->cursos}}</strong></span>
                        </div>
                        <i class="icon-5x flaticon-clipboard align-self-end h-100px text-success"></i>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection