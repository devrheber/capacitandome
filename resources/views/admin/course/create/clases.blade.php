@extends('layouts.app_admin')

@section('tituloPagina','Gestión de clases')

@section('styles')
@endsection

@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <h5 class="text-dark font-weight-bold my-1 mr-5">SECCION: {{ $seccion->titulo }}</h5>
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Actions-->
            <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a> 
            <a href="{{ asset('/admin/course/secciones/' . $seccion->idcurso) }}" class="btn btn-light-primary font-weight-bolder btn-sm">
                <i class="fas fa-list"></i> Ver secciones
            </a>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar-->
    </div>
</div>
@endsection

@section('contenido')
<div class="container">

    <div class="card card-custom" id="cardSecciones">
        <div class="card-body p-0">

            <div class="row">

                <div class="col-md-6">    
                    <div class="card card-custom gutter-b">
                        <div class="card-header" style="min-height: 50px;">
                            <div class="card-title">
                                <h3 class="card-label"> CREAR NUEVA CLASE <!--<small>sub title</small>--> </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('clase_guardar') }}" method="POST" autocomplete="off">

                                @csrf
                                <input type="hidden" name="idclase" id="idclase">
                                <input type="hidden" name="idseccion" value="{{ $seccion->idseccion }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label>Título  <span class="text-danger">*</span></label>
                                            <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Ingrese titulo de la seccion..." value="{{ old('titulo') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label>Descripción</label>
                                            <textarea class="form-control" placeholder="Opcional" name="descripcion" id="descripcion" cols="30" rows="4" placeholder="Ingrese una descripción...">{{ old('descripcion') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label>URL del video  <span class="text-danger">*</span></label>
                                            <input type="text" name="url_video" id="url_video" class="form-control" placeholder="Ingrese URL del video..." value="{{ old('url_video') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="frame_video">
                                        
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

                                    <div class="col-md-12 mt-2">
                                        <button type="submit" class="btn btn-primary float-right" id="btn_guardar">
                                            <i class="fas fa-save"></i> GUARDAR
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
                                <h3 class="card-label text-primary"> LISTA DE CLASES </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover" id="table_clases">
                                        <thead class="table-primary">
                                            <tr>
                                                <th style="width: 5%">#</th>
                                                <th style="width: 70%">CLASES</th>
                                                <th style="width: 25%">ACCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($seccion->Clases as $key => $clase)
                                            <tr id="tr_{{ $clase->idclase }}">
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $clase->titulo }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" onclick="editar({{ $clase->idclase }})" class="btn btn-light-warning font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                                        <i class="fas fa-edit p-0"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="desactivar({{ $clase->idclase }})" class="btn btn-light-danger font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                        <i class="fas fa-times p-0"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach

                                            @if (count($seccion->Clases) == 0)
                                            <tr>
                                                <td class="text-center" colspan="3">Aún no hay clases creadas...</td>
                                            </tr>
                                            @endif
                                            

                                            {{-- <tr>
                                                <td colspan="3"> Sin registros de secciones...</td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                                

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <input type="hidden" name="requisito[]" value="hola">
        </div>
        <!--end::Wizard-->
    </div>



</div>
@endsection

@section('modal')
@endsection

@section('script')

<script>

    function clase() {

        activar_form(false);
        
        $("#btn_nuevo").on('click', function () {
            activar_form(true);
        });

        $("#btn_cancelar").on('click', function () {
            limpiar();
            activar_form(false);
        });

        $("#url_video").on('change', function () {
            if ($(this).val() != '' || $(this).val() != null) {
                var frame = `<iframe width="450" height="300" src="${$(this).val()}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`
                $("#frame_video").html(frame)
            }else{
                $("#frame_video").html('')
            }
        });
    }

    function activar_form(flat) {
        if (flat) {
            $("#btn_nuevo").hide();

            $("#btn_guardar").show();
            $("#btn_limpiar").show();
            $("#btn_cancelar").show();

            $("#titulo").prop( "disabled", false );
            $("#descripcion").prop( "disabled", false );
            $("#url_video").prop( "disabled", false );

        }else{
            $("#btn_nuevo").show();

            $("#btn_guardar").hide();
            $("#btn_limpiar").hide();
            $("#btn_cancelar").hide();

            $("#titulo").prop( "disabled", true );
            $("#descripcion").prop( "disabled", true );
            $("#url_video").prop( "disabled", true );

        }
    }

    var card = new KTCard('cardSecciones');
    function editar(idclase) {

        activar_form(true);
        KTApp.block(card.getSelf(), {
            overlayColor: '#F3F6F9',type: 'loader',state: 'primary',opacity: 0.8,size: 'lg',message: 'Espere por favor...'
        });
        $.get(`/admin/course/secciones/clases/mostrar/${idclase}`, function (data, status) {
            data = JSON.parse(data);

            $("#idclase").val(data.idclase);
            $("#titulo").val(data.titulo);
            $("#descripcion").val(data.descripcion);
            $("#url_video").val(data.url_video);
            KTApp.unblock(card.getSelf());
        });
    }

    function limpiar() {
        $("#idclase").val('');
        $("#titulo").val('');
        $("#descripcion").val('');
        $("#url_video").val('');
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
                
                $.get(`/admin/course/secciones/clases/eliminar/${idclase}`, function (data, status) {
                    data = JSON.parse(data);

                    console.log(data);

                    if (data.status == true) {

                        Swal.fire('Eliminado', '', 'success');

                        

                        $(`#tr_${idclase}`).remove();

                        var rowCount = $('#table_clases tr').length;

                        if (rowCount <= 1) {
                            $('#table_clases').append('tr><td class="text-center" colspan="3">Aún no hay clases creadas...</td></tr>');
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

    clase();

</script>
@endsection
