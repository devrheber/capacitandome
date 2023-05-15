@extends('layouts.app_admin')
@section('tituloPagina','personal')
@section('styles')
    <link href="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list"></i> PERSONAS</h5>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a>
            <a href="{{route('admin_personas')}}" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="fas fa-list"></i> Persona</a>
        </div>
    </div>
</div>
@endsection
@section('contenido')
<!--begin::Container-->
<div class="container">

    <!--begin::Card-->
    <div class="card card-custom" id="cardPersonas">
        <div class="card-header py-3">
            <div class="card-title">
                <span class="card-icon">
                    <i class="fa fa-list text-primary"></i>
                </span>
                <h3 class="card-label">Lista de personas</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin_personas_create') }}" class="btn btn-primary font-weight-bolder">
                    <i class="la la-plus-circle"></i> Nueva persona
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                {{--<div class="col-lg-12">
                    <p><strong class="text-danger">Importante:</strong> BUSCAR A UNA DETERMINADA PERSONA POR <strong>"APELLIDOS"</strong></p>
                </div>--}}
                <div class="col-lg-12">
                    <form action="#" method="GET" autocomplete="off">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label for="fdep">Departamento</label>
                                        <select class="form-control" name="fdep" id="fdep">
                                            <option value="todos">Todos</option>
                                            @foreach ($departamentos as $departamento)
                                                <option value="{{$departamento->iddepartamento}}">{{$departamento->departamento}}</option>
                                            @endforeach                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="est">Tipo persona</label>
                                        <select class="form-control" name="est" id="est">
                                            <option value="todos">Todos</option>
                                            <option value="0">Estudiantes(Pago)</option>
                                            <option value="1">Becarios (Gratis)</option>
                                            <option value="2">Docentes</option>                                          
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="buscarpersona">Buscar por apellido</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="buscarpersona" name="search" placeholder="BUSCAR POR APELLIDO"/>
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" type="button"><i class="la la-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-12" id="paginatePersonas">
                    
                </div>
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
    <script src="{{ asset('/recursos/admin/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('/recursos/ajax/admin/persona/list.js') }}"></script>
@endsection