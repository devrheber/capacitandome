@extends('layouts.app_admin')
@section('tituloPagina','reportes')
@section('styles')
    {{--<link href="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />--}}
@endsection
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list"></i> ESTUDIANTES INSCRITOS</h5>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a>
            <a href="/admin/pagos" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="fas fa-book"></i> Cursos dictados</a>
        </div>
    </div>
</div>
@endsection
@section('contenido')
<!--begin::Container-->
<div class="container">

    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="d-flex">
                <!--begin: Pic-->
                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                    <!--<div class="symbol symbol-50 symbol-lg-120">
                        <img alt="IMG CURSO" src="{{ asset('/storage/cursos/'.$curso->portada.'') }}">
                    </div>-->
                    <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                        <span class="font-size-h3 symbol-label font-weight-boldest">CURSO</span>
                        <input type="hidden" value="{{$curso->idcurso}}" id="value_idcurso">
                    </div>
                </div>
                <!--end: Pic-->
                <!--begin: Info-->
                <div class="flex-grow-1">
                    <!--begin: Title-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="mr-3">
                            <!--begin::Name-->
                            <a href="javascript:" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                Curso : {{$curso->titulo}}
                            <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                            <!--end::Name-->
                            <!--begin::Contacts-->
                            <div class="d-flex flex-wrap my-2">
                                <a href="javascript:" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <span class="mr-1">
                                        <i class="fa fa-user-graduate"></i> {{$total_estudiantes}} Estudiantes
                                    </span>
                                </a>
                                <a href="javascript:" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <span class="mr-1">
                                        <i class="fa fa-calendar-alt"></i> {{Carbon\Carbon::parse($curso->fecha_inicio)->format('d-m-Y')}} | {{Carbon\Carbon::parse($curso->fecha_final)->format('d-m-Y')}}
                                    </span>
                                </a>
                            </div>
                            <!--end::Contacts-->
                        </div>
                        <div class="my-lg-0 my-1">
                            <a href="javascript:" class="btn btn-sm btn-success mr-3">{{strtoupper($curso->plan)}}</a>
                        </div>
                    </div>
                    <!--end: Title-->
                    <!--
                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                        <div class="flex-grow-1 font-weight-bold text-dark-50 py-5 py-lg-2 mr-5">{{$curso->descripcion}}</div>
                    </div>
                    -->
                </div>
                <!--end: Info-->
            </div>
            
        </div>
    </div>

    

    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom card-stretch gutter-b" id="cardAlumnos">
                <div class="card-body pt-6 pb-3">
                    <form action="#" method="GET" autocomplete="off">
                        <div class="col-lg-12">
                            <div class="row">
                                <input type="hidden" id="idcurso" value="{{$curso->idcurso}}">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <select class="form-control" name="f_dep" id="f_dep">
                                            <option value="todos">Todos</option>
                                            @foreach ($departamentos as $departamento)
                                                <option value="{{$departamento->iddepartamento}}">{{$departamento->departamento}}</option>
                                            @endforeach                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="filtro_buscar" placeholder="Buscar por apellido"/>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button"><i class="la la-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive-lg" id="paginateAlumnos">
                        
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <div class="col-lg-4">

        </div>
    </div>


</div>
<!--end::Container-->
@endsection

@section('modal')
@endsection

@section('script')
    {{--<script src="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>--}}
    <script src="{{ asset('/recursos/ajax/admin/pagos/pagos.js') }}"></script>
@endsection