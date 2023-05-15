@extends('layouts.app_admin')
@section('tituloPagina','Persona')
@section('styles')
@endsection
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-edit"></i> ACTUALIZAR</h5>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a>
            <a href="{{route('admin_index_macurricular')}}" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="fas fa-list"></i> Cursos</a>
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
                    <i class="flaticon2-user text-primary"></i>
                </span>
                <h3 class="card-label">ACTUALIZAR PUNTAJE DEL CURSO</h3>
            </div>
        </div>
        <div class="card-body">
            <style>
                .error-select{border: 1px solid red !important;border-radius: .42rem !important;}
            </style>
            
            <form action="{{route('admin_update_macurricular',[$mallacur->idmalla_curricular])}}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <p><strong>Importante:</strong> Asignar puntaje en <strong>porcentaje(%)</strong> para examen y trabajo final. La suma de estos debe ser igual a <strong>100%</strong></p>
                        <p><strong>Ejemplo:</strong> <span>Examen 30% + Trabajo 70% = 100%</span></p>
                        <strong><p class="text-danger">Ingrese los porcentajes solo número en el formulario.</p></strong>
                    </div>
                </div>

                <div class="row">                   
                    <div class="col-lg-12">
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                <div class="alert-close">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                    </button>
                                </div>
                                {{Session::get('error')}}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Curso <span class="text-danger">*</span></label>
                            <select id="idcurso" name="idcurso" class="form-control selectpicker {{ $errors->first('idcurso') ? 'error-select' : '' }}" data-live-search="true">
                                <option value="">Seleccione</option>
                                @foreach ($cursos as $item)
                                    <option value="{{ $item->idcurso }}" {{ $mallacur->idcurso == $item->idcurso ? "selected" : "" }}>
                                        {{ $item->titulo }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->first('idcurso'))
                                <span class="form-text text-danger">{{ $errors->first('idcurso') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Examen final(%) <span class="text-danger">*</span></label>
                            <input type="number" name="examen_final" class="form-control {{ $errors->first('examen_final') ? 'is-invalid' : '' }}"
                                placeholder="Ingrese porcentaje examen final" value="{{ $mallacur->puntaje_examen_final }}">
                            @if ($errors->first('examen_final'))
                                <span class="form-text text-danger">{{ $errors->first('examen_final') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Trabajo final(%) <span class="text-danger">*</span></label>
                            <input type="number" name="trabajo_final" class="form-control {{ $errors->first('trabajo_final') ? 'is-invalid' : '' }}"
                                placeholder="Ingrese porcentaje trabajo final" value="{{ $mallacur->puntaje_trabajo_final }}">
                            @if ($errors->first('trabajo_final'))
                                <span class="form-text text-danger">{{ $errors->first('trabajo_final') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-12 mb-4 text-right">
                        <a href="{{route('admin_index_macurricular')}}" class="btn btn-warning"><i class="la la-close"></i> Cancelar</a>
                        <button type="submit" class="btn btn-primary"><i class="la la-plus-circle"></i> Registrar</button>
                    </div>
                </div>
            </form>
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
