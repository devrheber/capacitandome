<!DOCTYPE html>
<html lang="es">

<head>
    @include('layouts.include.web.head')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>

    <!-- ================================
        START BREADCRUMB AREA
    ================================= -->
    <section class="breadcrumb-area" style="height: 210px;background-color: #233d63 !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 style="color:#28a745">"{{$curso->titulo}}"</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item">
                                <strong>SECCIÓN :</strong> {{$seccion->titulo}}
                            </li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!--======================================
            START COURSE AREA
    ======================================-->
    <section class="course-area padding-top-50px padding-bottom-120px">
        <div class="course-wrapper">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('miaprendizaje',$curso->idcurso)}}"><i class="fa fa-home"></i> MI APRENDIZAJE</a></li>
                              <li class="breadcrumb-item active" aria-current="page">MIS TAREAS</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7">
                        <div class="filter-bar">                            
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="tablaTarea">
                                    <thead>
                                        <tr>
                                           <th scope="col">N°</th>
                                           <th scope="col">Título</th>
                                           <th class="text-center" scope="col">Nota</th>
                                           <th class="text-center" scope="col">Archivo</th>
                                           <th class="text-center" scope="col"><i class="fa fa-cogs"></i></th>
                                        </tr>
                                      </thead>
                                      @php
                                          $autoi = 1;
                                      @endphp
                                      <tbody>
                                        @foreach ($tareas as $item)
                                            <tr id="tr_{{$item->identregable}}">
                                                <th>{{$autoi ++}}.</th>
                                                <td>{{$item->nombre}}</td>
                                                <td class="text-center">
                                                    @if ($item->nota != 0)
                                                        {{$item->nota}}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->archivo != NULL || $item->archivo != '')
                                                    <a href="/storage/tareas/{{$item->archivo}}" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i></a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:" onclick="eliminar({{$item->identregable}})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                      </tbody>
                                </table>
                            </div>
                            @if (count($tareas) == 0)
                            <div class="text-center">
                                <h4 class="text-danger">AÚN NO TIENES TAREAS REGISTRADAS</h4>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="filter-bar">                            
                            <h4 class="mb-3">ADJUNTAR ARCHIVO</h4>
                            <hr>
                            @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <form action="{{route('registrarTarea')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                {{ csrf_field() }}
                                <input type="hidden" name="idseccion" value="{{$seccion->idseccion}}">
                                <div class="form-group">
                                    <label>Titulo <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control {{ $errors->first('titulo') ? 'is-invalid' : '' }}" name="titulo" placeholder="Ingrese titulo">
                                    @if ($errors->first('titulo'))
                                        <span class="form-text text-danger">{{ $errors->first('titulo') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="archivo">Archivo <span class="text-danger">*</span></label>
                                    <input type="file" name="archivo" class="form-control-file">
                                    @if ($errors->first('archivo'))
                                        <span class="form-text text-danger">{{ $errors->first('archivo') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">ENVIAR TAREA</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
    </section><!-- end courses-area -->
    <!--======================================
            END COURSE AREA
    ======================================-->





    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="fa fa-angle-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    

    @include('layouts.include.web.scripts')

  

</body>

<script>
    //$(document).ready(function(){
        function eliminar(identregable) {
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
                    
                    $.get(`/eliminartarea/${identregable}`, function (data, status) {
                        data = JSON.parse(data);
                        if (data.status == true) {
                            Swal.fire('Eliminado', '', 'success');
                            $(`#tr_${identregable}`).remove();
                            var rowCount = $('#tablaTarea tr').length;
                            if (rowCount <= 1) {
                                $('#tablaTarea').append('<tr><td class="text-center" colspan="5">Aún no hay tareas registradas...</td></tr>');
                            }
                        }else{
                            alert('Ocurrio un error, se refescara la página');
                            location.reload();
                        }

                    });

                }else{

                }
            });
        }
    //})
</script>

</html>
