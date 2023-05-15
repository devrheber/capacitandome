<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-head-custom table-bordered">
            <thead>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">TÍTULO</th>
                    <th scope="col">T.CLASES</th>
                    <th scope="col">DURACIÓN</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">PLAN</th>
                    <th scope="col" class="text-center">ESTADO</th>
                    <th scope="col" class="text-center">ACCIÓN</th>
                </tr>
            </thead>
            <tbody>                
                @foreach ($cursos as $index => $curso)
                    <tr id="tr_{{ $curso->idcurso }}" class="@if ($curso->estado == 0) fila-desactivada @endif">
                        <td style="vertical-align: middle;" scope="row">{{ $cursos->perPage()*($cursos->currentPage()-1)+($index+1)}}</td>
                        <td style="max-width: 340px; vertical-align: middle;" scope="row"><strong>{{ $curso->titulo }}</strong></td>
                        <td style="vertical-align: middle;" scope="row">{{ $curso->total_clases." clases" }}</td>
                        <td style="vertical-align: middle;" scope="row">{{ $curso->hora_duracion." horas" }}</td>
                        <td style="vertical-align: middle;" scope="row">s/.{{ $curso->precio }}</td>
                        <td style="vertical-align: middle;" scope="row">
                            @if ($curso->plan == 'gratis')
                                <span class="label font-weight-bold label-lg  label-light-warning label-inline">GRATIS</span>
                            @else
                                <span class="label font-weight-bold label-lg  label-light-success label-inline">PAGO</span>
                            @endif                        
                        </td>
                        <td style="vertical-align: middle; max-width: 480px;" scope="row" class="text-center second_td">
                            <div class="btn-group">
                                <button type="button" class="btn dropdown-toggle text-white status-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $curso->course_status() }}
                                </button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" onclick="desactivar({{ $curso->idcurso }}, 1)" href="javascript:void(0)">Habilitado</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" onclick="desactivar({{ $curso->idcurso }}, 0)" href="javascript:void(0)">Deshabilitado</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" onclick="desactivar({{ $curso->idcurso }}, 2)" href="javascript:void(0)">Publicar</a>
                                </div>
                            </div>
                        </td>
                        <td style="vertical-align: middle;" scope="row" class="text-center">
                            <a href="{{ asset('admin/course/editar/' . $curso->idcurso ) }}" class="btn btn-light-warning font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><i class="fas fa-edit p-0"></i></a>

                            <a href="javascript:void(0)" onclick="mostrarModal({{ $curso->idcurso }})" class="btn btn-light-success btn-sm my-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Registrar recursos del curso"><i class="fas fa-plus-circle p-0"></i></a>
                        </td>
                    </tr>
                @endforeach
    
                @if (count($cursos) <= 0)
                    <tr>
                        <td colspan="7">
                            <center>
                                NO HAY REGISTROS
                            </center>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    {{ $cursos->links('vendor.pagination.paginate-admin') }}
</div>

<script>
    $(document).ready(function() {
        // Recorrer cada botón de estado
        $('.status-btn').each(function() {
            let estado = $(this).text().trim(); // Obtener el estado del curso
            
            // Seleccionar el botón y remover las clases CSS existentes antes de agregar la nueva clase correspondiente
            let btn = $(this);
            btn.removeClass('btn-success btn-primary btn-danger border-white');

            if (estado == "Deshabilitado") {
                btn.addClass('btn-danger border-white');
            } else if (estado == "Habilitado") {
                btn.addClass('btn-primary');
            } else if (estado == "Publicado") {
                btn.addClass('btn-info');
            }
        });
    });
</script>