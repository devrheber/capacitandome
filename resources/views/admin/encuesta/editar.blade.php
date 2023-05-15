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
                    <h3 class="card-label">Datos de la encuesta <small>(Los campos notificados son requeridos)</small></h3>
                </div>
            </div>

            <div class="card-body">

                <style>
                    .error-select{border: 1px solid red !important;border-radius: .42rem !important;}
                </style>

                <form name="form_curso" method="POST" action="{{ route('admin_encuesta_editar') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" name="idencuesta" value="{{ $encuesta->id }}">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label>Titulo <span class="text-danger">*</span></label>
                                <input type="text" id="titulo" name="titulo" class="form-control {{ $errors->first('titulo') ? 'is-invalid' : '' }}" placeholder="Ingrese titulo de la encuesta..." value="{{ $encuesta->titulo }}">

                                @if ($errors->first('titulo'))
                                    <span class="form-text text-danger">{{ $errors->first('titulo') }}</span>
                                @endif

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label>Curso  <span class="text-danger">*</span></label>
                                <select class="form-control {{ $errors->first('idcurso') ? 'is-invalid' : '' }}" name="idcurso">
                                    <option value="" selected disabled>Seleccione..</option>
                                    @foreach ($cursos as $item)
                                        <option value="{{$item->idcurso}}" {{ ($item->idcurso == $encuesta->curso_id)? 'selected' :'' }}>{{$item->titulo}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->first('idcurso'))
                                    <span class="form-text text-danger">{{ $errors->first('idcurso') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label>Descripción<span class="text-danger">*</span></label>
                                <textarea class="form-control {{ $errors->first('descripcion') ? 'is-invalid' : '' }}" id="descripcion" name="descripcion" cols="30" rows="5">{{  $encuesta->descripcion }}</textarea>

                                @if ($errors->first('descripcion'))
                                    <span class="form-text text-danger">{{ $errors->first('descripcion') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12 text-right pt-3">
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

@endsection
