@extends('layouts.app_admin')
@section('tituloPagina','reporte de pagos')
@section('styles')
@endsection
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list"></i> CURSOS DICTADOS POR CAPACITÁNDOME</h5>
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
                <span class="card-icon">
                    <i class="fa fa-bell text-primary"></i>
                </span>
                <h4 class="card-label">Presione el botón (+) para ver los estudiantes inscritos</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 ml-auto">
                    <form action="{{ route('admin_listpagos') }}" method="GET" autocomplete="off">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <a class="btn btn-secondary font-weight-bold" href="{{ route('admin_listpagos') }}"><i class="la la-refresh"></i></a>
                            </div>
                                <input type="text" class="form-control" name="search" placeholder="Buscar por curso"/>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Buscar <i class="la la-search"></i></button>
                            </div>
                           </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive-lg">
                <table class="table table-bordered" id="">
                    <thead class="bg-secondary">
                        <tr>
                            <th>N°</th>
                            <th>Portada</th>
                            <th>Curso</th>
                            <th class="text-center">Plan</th>
                            <th class="text-center">Cant. alumnos</th>
                            <th class="text-center">Ver inscritos</th>
                        </tr>
                    </thead>
                    @php
                        $autoi = 1;
                    @endphp
                    <tbody>
                        @foreach ($pagos as $cursocomprado)
                            <tr>
                                <td>{{ $autoi ++ }}</td>
                                <td>
                                    <div class="symbol symbol-60 symbol-2by3 flex-shrink-0 mr-4">
                                        <div class="symbol-label" style="background-image: url('storage/cursos/{{ $cursocomprado->portada }}')"></div>
                                    </div>
                                </td>
                                <td>{{ $cursocomprado->titulo }}</td>   
                                <td class="text-center">
                                    @if ($cursocomprado->plan == 'pago')
                                        <span class='btn btn-success btn-sm'><strong>{{ strtoupper($cursocomprado->plan) }}</strong></span>
                                    @else
                                        <span class='btn btn-warning btn-sm'><strong>{{ strtoupper($cursocomprado->plan) }}</strong></span>
                                    @endif
                                </td>                         
                                <td class="text-center">{{ $cursocomprado->cant_vendido }}</td>
                                <td class="text-center">
                                    <a href="admin/listpagosdet/{{ $cursocomprado->idcurso }}" class='btn btn-light-info font-weight-bold btn-sm' 
                                        data-toggle='tooltip' data-placement='top' data-original-title='Ver estudiantes'><i class='fa fa-plus-circle'></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (count($pagos) == 0 && $search_titulo !="")
                    <div class="alert alert-danger" role="alert">
                        <h6>
                            No existen resultados para : <strong>"{{$search_titulo}}"</strong> ||
                            <a href="{{ route('admin_listpagos') }}" class="btn btn-light btn-hover-warning font-weight-bold">
                                <i class="flaticon2-refresh"></i> Restablecer
                            </a>
                        </h6>
                    </div>
                @endif
                {{ $pagos->links('vendor.pagination.paginate-admin') }}
            </div>
        </div>
    </div>
    <!--end::Card-->


</div>
<!--end::Container-->
@endsection

@section('modal')
@endsection

@section('script')
@endsection