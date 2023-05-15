<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-head-custom table-bordered">
            <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">TÍTULO</th>
                <th scope="col">CURSO</th>
                <th scope="col" class="text-center">ESTADO</th>
                <th scope="col" class="text-center">ACCIÓN</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($encuestas as $index => $encuesta)
                <tr id="tr_{{ $encuesta->id }}" class="@if ($encuesta->estado == 0) fila-desactivada @endif">
                    <td style="vertical-align: middle;" scope="row">{{ $encuestas->perPage()*($encuestas->currentPage()-1)+($index+1)}}</td>
                    <td style="max-width: 340px; vertical-align: middle;" scope="row"><strong>{{ $encuesta->titulo }}</strong></td>
                    <td style="vertical-align: middle;" scope="row">{{ $encuesta->curso->titulo }}</td>
                    <td style="vertical-align: middle; max-width: 480px;" scope="row" class="text-center second_td">
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle text-white status-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $encuesta->encuesta_estado() }}
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" onclick="desactivar({{ $encuesta->id }}, 1)" href="javascript:void(0)">Habilitado</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" onclick="desactivar({{ $encuesta->id }}, 0)" href="javascript:void(0)">Deshabilitado</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </div>
                    </td>
                    <td style="vertical-align: middle;" scope="row" class="text-center">
                        <a href="/admin/encuesta/editar/{{$encuesta->id}}" class="btn btn-light-warning font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><i class="fas fa-edit p-0"></i></a>

                        <a href="/admin/encuesta/recursos/{{$encuesta->id}}" class="btn btn-light-success btn-sm my-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Registrar recursos"><i class="fas fa-plus-circle p-0"></i></a>
                    </td>
                </tr>
            @endforeach

            @if (count($encuestas) <= 0)
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
    {{ $encuestas->links('vendor.pagination.paginate-admin') }}
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
