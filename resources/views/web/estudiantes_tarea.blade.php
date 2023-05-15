<div class="sidebar-widget cardSeccion">                 
    <div class="contact-form-action" >
        @if (count($tareaEstudiante) > 0)
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="mb-2" style="color:#28a745;"><i class="fa fa-user"></i> {{$persona->apellidos." ".$persona->nombre}}</h5>
                    <hr>
                </div>
                <div class="col-lg-12">
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
                </div>
                <div class="col-lg-12 text-center" id="cargando" style="display: none">
                    <span class="text-center"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br>Cargando...</span>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive">                                                        
                            <table class="table table-sm table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Título</th>                                                                    
                                    <th scope="col" class="text-center">Nota</th>
                                    <th scope="col" class="text-center">Tarea</th>
                                    <th scope="col" class="text-center">Arch. Corregido</th>
                                    <th scope="col" class="text-center">Estado</th>
                                    <th scope="col" class="text-center"><i class="fa fa-cogs"></i></th>
                                </tr>
                                </thead>
                                @php
                                    $autoi = 1;
                                @endphp
                                <tbody>
                                    @foreach ($tareaEstudiante as $item)
                                    <form action="{{route('evaluarTarea')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <tr>
                                            <input type="hidden" name="identregable" value="{{$item->identregable}}">
                                            <input type="hidden" name="idusuario" value="{{$item->idusuario}}">
                                            <input type="hidden" name="idseccion" value="{{$item->idseccion}}">
                                            <input type="hidden" name="archivo_actual" value="{{$item->archivo}}">
                                            <td scope="row">{{$autoi++}}.</td>
                                            <td>
                                                {{$item->nombre}}                                                                                
                                            </td>
                                            <td class="text-center">
                                                <input type="text" style="height: 30px;width: 60px;padding: 2px;text-align: center" onkeypress="ValidaSoloNumeros()" name="nota" class="form-control" value="{{$item->nota}}" required>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('DescargarArchivo',array("iduser"=>$item->idusuario,"arch"=>$item->archivo))}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Descargar"><i class="fa fa-download"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <input type="file" name="archivo">
                                            </td>
                                            <td class="text-center">
                                                @if ($item->nota != 0)
                                                    <span style="font-size: 13px" class="text-success">Revisado</span>                                                           
                                                @else
                                                    <span style="font-size: 13px" class="text-danger">No revisado</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button type="submit" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right" title="Guardar Archivo | Nota"><i class="fa fa-save"></i></button>
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach                                                 
                                </tbody>
                            </table>
                        
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h4> <i class="fa fa-edit"></i> Seleccione un estudiante para ver sus tareas.</h4>
                    <img src="/recursos/web/images/img_tareas.png" width="100" alt="">
                </div>
            </div>
        @endif
    </div>
</div>