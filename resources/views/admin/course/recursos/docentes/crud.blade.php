@extends('layouts.app_admin')

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
                <h5 class="text-primary font-weight-bold my-1 mr-5">
                    <i class="fas fa-chalkboard-teacher"></i> DOCENTES DEL CURSO
                </h5>
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->

        <div class="d-flex align-items-center">
            <a href="/admin/courses" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="la la-book"></i> CURSO</a>
            <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="la la-home"></i> INICIO</a>
        </div>
    </div>
</div>
@endsection

@section('contenido')
<div class="container">

    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <div class="d-flex align-items-center">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
                        <img src="{{ asset('/storage/cursos/'.$curso->portada.'') }}" alt="image">
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="d-flex flex-column mr-auto">
                        <!--begin: Title-->
                        <a href="javascript:" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{$curso->titulo}}</a>
                        <span class="text-muted font-weight-bold"><i class="far fa-calendar-alt"></i> {{$curso->fecha_inicio}} | <i class="far fa-calendar-alt"></i> {{$curso->fecha_final}}</span>
                        <!--end::Title-->
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Lista de docentes</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tablaDocentes">
                                    <thead style="">
                                        <tr>
                                            <th style="width: 5%">N°</th>
                                            <th style="width: 70%">COMUNIDAD</th>
                                            <th style="width: 25%" class="text-center"><i class="fa fa-cogs"></i></th>
                                        </tr>
                                    </thead>
                                    @php
                                        $autoi = 1;
                                    @endphp
                                    <tbody>
                                        @foreach ($docentes as $item)
                                            <tr id="tr_{{ $item->iddocente }}">
                                                <td>{{ $autoi++ }}.</td>
                                                <td>{{ $item->nombre." ".$item->apellidos }}</td>
                                                <td class="text-center">
                                                    <a href="javascript:" onclick="mostrarComunidad({{ $item->iddocente }})" 
                                                        class="btn btn-light-warning font-weight-bold btn-sm" data-toggle="tooltip" 
                                                        data-placement="top" data-original-title="Editar curso"><i class="fas fa-edit p-0"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="eliminarComunidad({{$item->iddocente}})" 
                                                        class="btn btn-light-danger font-weight-bold btn-sm" data-toggle="tooltip" 
                                                        data-placement="top" title="" data-original-title="Eliminar curso"><i class="fas fa-trash p-0"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if (count($docentes) == 0)
                                            <tr><td class="text-center" colspan="5">Aún no hay docentes registrados...</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-custom gutter-b">
                                <div class="card-header">
                                 <div class="card-title">
                                  <h3 class="card-label">Seleccione un docente</h3>
                                 </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('guardEditarDocentes')}}" method="post" id="">
                                        @csrf
                                        <input type="hidden" name="iddocentes" id="iddocentes" value="">
                                        <input type="hidden" name="idcurso" id="idcurso" value="{{$curso->idcurso}}">
                                        <div class="row">
                                            <div class="col-md-12">                                               
                                                                
                                                @if(Session::has('success'))                                                        
                                                    <div class="alert alert-custom alert-success fade show" role="alert">
                                                        <div class="alert-icon"><i class="la la-check"></i></div>
                                                        <div class="alert-text">{{Session::get('success')}}</div>
                                                        <div class="alert-close">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                    
                                                @if(Session::has('error'))
                                                    <div class="alert alert-custom alert-danger fade show" role="alert">
                                                        <div class="alert-icon"><i class="la la-close"></i></div>
                                                        <div class="alert-text">{{Session::get('error')}}</div>
                                                        <div class="alert-close">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-4">
                                                    <select class="form-control selectpicker {{ $errors->first('idpersona') ? 'error-select' : '' }}" id="idpersona" name="idpersona" data-live-search="true">
                                                        <option value="" selected disabled>Seleccione...</option>
                                                        @foreach ($personas as $index => $item)
                                                            <option value="{{ $item->idusuario }}">
                                                                {{ ($index+1).") ".$item->nombre." ".$item->apellidos}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->first('idpersona'))
                                                        <span class="form-text text-danger" id="errorTitulo">{{ $errors->first('idpersona') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button type="button" onclick="limpiar()" class="btn btn-secondary font-weight-bold mr-2"><i class="la la-close"></i> LIMPIAR</button>
                                                <button type="submit" class="btn btn-primary font-weight-bold mr-2"><i class="la la-plus-circle"></i> GUARDAR</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Wizard-->
    </div>

</div>
@endsection

@section('modal')
@endsection

@section('script')
<script src="{{ asset('/recursos/admin/assets/js/pages/features/miscellaneous/toastr.js') }}"></script>

<script>
    function mostrarComunidad(iddocentes) {
    $.get("/admin/mostrardocentes/"+iddocentes, function(respuesta) {
        respuesta = JSON.parse(respuesta);
        $("#iddocentes").val(respuesta.iddocente);
        $('#idpersona').val(respuesta.idusuario);
        $('#idpersona').selectpicker('refresh');
        console.log(respuesta);
    })
}

function limpiar() {
    $("#iddocentes").val('');
    $('#idpersona').val('');
    $('#idpersona').selectpicker('refresh');
    $("#idpersona").removeClass('error-select');
    $("#errorTitulo").html('');
    toastr.info('Formulario reseteado.')
}

function eliminarComunidad(iddocentes) {
    Swal.fire({
        title: '¿Seguro que quiere eliminar este registro?',
        text: "No se podra recuperar",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f64e60',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.get(`/admin/eliminardocentes/${iddocentes}`, function (data) {
                data = JSON.parse(data);
                console.log(data.message);
                if (data.status == true) {
                    Swal.fire('Eliminado', '', 'success');
                    $(`#tr_${iddocentes}`).remove();
                    var rowCount = $('#tablaDocentes tr').length;
                    if (rowCount <= 1) {
                        $('#tablaDocentes').append('<tr><td class="text-center" colspan="5">Aún no hay registros...</td></tr>');
                    }
                }else{
                    alert('Ocurrio un error, se refescara la página');
                    location.reload();
                }
            });

        }
    });
}
</script>

@endsection
