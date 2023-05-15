@extends('layouts.app_admin')

@section('tituloPagina','Gestión de secciones')

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
                <h5 class="text-dark font-weight-bold my-1 mr-5">
                    CURSO: {{ $curso->titulo }} 
                    <small class="text-muted ml-3 mr-1">
                        <i class="far fa-calendar-alt"></i>
                        {{ $curso->fecha_inicio  }}
                    </small>
                    <small class="text-muted">
                        al
                    </small>
                    <small class="text-muted ml-1 mr-3">
                        <i class="far fa-calendar-alt"></i>
                        {{ $curso->fecha_inicio }}
                    </small>
                </h5>
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Actions-->
            <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a> 
            <a href="{{ asset('/admin/courses') }}" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="fas fa-list"></i> Lista de cursos</a>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar-->

    </div>
</div>
@endsection

@section('contenido')
<div class="container">

    <div class="card card-custom" id="cardSecciones">
        <div class="card-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="text-center">
                                        <a href="javascript:" class="btn btn-light-info"><i class="fas fa-book-reader p-0"></i></a>
                                    </td>
                                    <td>Gestión clases (<span>Registrar clases y sus videos respectivos.</span>)</td>
                                </tr>                            
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">

                    <div class="col-md-6">
                        <div class="card card-custom gutter-b">
                            <div class="card-header" style="min-height: 50px;">
                                <div class="card-title">
                                    <h3 class="card-label"><i class="fa fa-edit"></i> CREAR NUEVA SECCIÓN <!--<small>sub title</small>--> </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                <form action="{{ route('seccion_guardar') }}" method="POST" autocomplete="off">

                                    @csrf
                                    <input type="hidden" name="idseccion" id="idseccion">
                                    <input type="hidden" name="idcurso" value="{{ $curso->idcurso }}">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group mb-4">
                                                <label>Nombre sección  <span class="text-danger" style="font-size: 13px">(Encabezado de cada sección)</span></label>
                                                <input type="text" name="nombre_seccion" id="nombre_seccion" class="form-control" placeholder="Ejem: MÓDULO-SECCIÓN-CURSO" value="{{ (old('nombre_seccion')) ? old('nombre_seccion') : 'SECCIÓN' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mb-4">
                                                <label>Título  <span class="text-danger">*</span></label>
                                                <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ingrese titulo de la seccion..." value="{{ old('titulo') }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mb-4">
                                                <label>Descripción</label>
                                                <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="4" placeholder="Opcional">{{ old('descripcion') }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mb-4">
                                                <label>¿Requiere entregable?  <span class="text-danger">*</span></label>
                                                <select class="form-control" name="entregable" id="entregable">
                                                    <option value="2" {{ old('entregable') == 2 ? 'selected' : '' }}>NO</option>
                                                    <option value="1" {{ old('entregable') == 1 ? 'selected' : '' }}>SI</option>
                                                    <option value="3" {{ old('entregable') == 3 ? 'selected' : '' }}>PROYECTO FINAL</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                    <div class="alert-close">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                        </button>
                                                    </div>
                                                    <strong>Error!</strong> Revise los campos obligatorios.<br><br>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            @if(Session::has('success'))
                                                <div class="alert alert-success">
                                                    <div class="alert-close">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                        </button>
                                                    </div>
                                                    {{Session::get('success')}}
                                                </div>
                                            @endif

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

                                        <div class="col-md-12">

                                            <button type="submit" class="btn btn-primary float-right" id="btn_guardar">
                                                <i class="la la-plus-circle"></i> GUARDAR
                                            </button>
                                            {{-- <button type="button" onclick="limpiar()" class="btn btn-warning float-right mr-2" id="btn_limpiar">
                                                    LIMPIAR
                                            </button> --}}

                                            <button type="button" class="btn btn-info float-right mr-2" id="btn_nuevo">
                                                NUEVO
                                            </button>

                                            <button type="button" class="btn btn-secondary float-right mr-2" id="btn_cancelar">
                                                CANCELAR
                                            </button>
                                        </div>
                                        
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-custom gutter-b">
                            <div class="card-header" style="min-height: 50px;">
                                <div class="card-title">
                                    <h3 class="card-label text-success"> LISTA DE SECCIONES </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-hover" id="table_secciones">
                                            <thead class="table-success">
                                                <tr>
                                                    <th style="width: 5%">#</th>
                                                    <th style="width: 65%">SECCIÓN</th>
                                                    <th style="width: 30%" class="text-center">ACCIÓN</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($curso->Secciones as $key => $seccion)
                                                <tr id="tr_{{ $seccion->idseccion }}">
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $seccion->titulo }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ asset('/admin/course/secciones/clases/' . $seccion->idseccion)  }}" class="btn btn-light-info font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Ver clases"><i class="fas fa-book-reader p-0"></i></a>
                                                        <a href="javascript:void(0)" onclick="editar({{ $seccion->idseccion }})" class="btn btn-light-warning font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit p-0"></i></a>
                                                        <a href="javascript:void(0)" onclick="desactivar({{ $seccion->idseccion }})" class="btn btn-light-danger font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash p-0"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                                @if (count($curso->Secciones) == 0)
                                                <tr>
                                                    <td class="text-center" colspan="3">Aún no hay secciones creadas...</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
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
<script>

    function secciones() {

        activar_form(false);
        
        $("#btn_nuevo").on('click', function () {
            activar_form(true);
        });

        $("#btn_cancelar").on('click', function () {
            limpiar();
            activar_form(false);
        });

       

    }

    function activar_form(flat) {
        if (flat) {
            $("#btn_nuevo").hide();

            $("#btn_guardar").show();
            $("#btn_limpiar").show();
            $("#btn_cancelar").show();

            $("#nombre_seccion").prop( "disabled", false );
            $("#titulo").prop( "disabled", false );
            $("#descripcion").prop( "disabled", false );
            $("#entregable").prop( "disabled", false );

        }else{
            $("#btn_nuevo").show();

            $("#btn_guardar").hide();
            $("#btn_limpiar").hide();
            $("#btn_cancelar").hide();

            $("#nombre_seccion").prop( "disabled", true );
            $("#titulo").prop( "disabled", true );
            $("#descripcion").prop( "disabled", true );
            $("#entregable").prop( "disabled", true );

        }
    }

    var card = new KTCard('cardSecciones');
    function editar(idclase) {

        activar_form(true);
        KTApp.block(card.getSelf(), {
            overlayColor: '#F3F6F9',type: 'loader',state: 'primary',opacity: 0.8,size: 'lg',message: 'Espere por favor...'
        });
     
        $.get(`/admin/course/secciones/seccion/mostrar/${idclase}`, function (data, status) {
            data = JSON.parse(data);

            $("#idseccion").val(data.idseccion);
            $("#nombre_seccion").val(data.nombre_seccion);
            $("#titulo").val(data.titulo);
            $("#descripcion").val(data.descripcion);
            $("#entregable").val(data.entregable);
            KTApp.unblock(card.getSelf());
        });
    }

    function limpiar() {
        $("#idseccion").val('');
        $("#nombre_seccion").val('');
        $("#titulo").val('');
        $("#descripcion").val('');
        $("#entregable").val(2);
    }

    function desactivar(idclase) {
        Swal.fire({
            title: '¿Seguro que quiere eliminar este registro?',
            text: "No se podra recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f64e60',
            // cancelButtonColor: '#f64e60',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $.get(`/admin/course/secciones/seccion/eliminar/${idclase}`, function (data, status) {
                    data = JSON.parse(data);

                    console.log(data);

                    if (data.status == true) {

                        Swal.fire('Eliminado', '', 'success');

                        

                        $(`#tr_${idclase}`).remove();

                        var rowCount = $('#table_secciones tr').length;

                        if (rowCount <= 1) {
                            $('#table_secciones').append('tr><td class="text-center" colspan="3">Aún no hay secciones creadas...</td></tr>');
                        }

                    }else{
                        alert('Ocurrio un error, se refescara la pagina');
                        location.reload();
                    }

                });

                // location.reload();
            }else{

            }
        })
    }

    secciones();

</script>
@endsection
