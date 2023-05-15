<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-head-custom table-bordered">
            <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">NOMBRES Y APELLIDOS</th>
                <th scope="col">DNI</th>
                <th scope="col">CURSO</th>
                <th scope="col">DOCENTE</th>
                <th scope="col">CALFICACIÓN</th>
                <th scope="col">FECHA</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($resultados as $index => $resultado)
                <tr id="tr_{{ $resultado->id }}">
                    <td style="vertical-align: middle;" scope="row">{{ $resultados->perPage()*($resultados->currentPage()-1)+($index+1)}}</td>
                    <td style="max-width: 340px; vertical-align: middle;" scope="row"><strong>{{ $resultado->user->Persona->nombre . ' ' . $resultado->user->Persona->apellidos }}</strong></td>
                    <td style="vertical-align: middle;" scope="row">{{ $resultado->id }}</td>
                    <td style="vertical-align: middle;" scope="row" class="text-center">
                        <a href="/admin/encuesta/editar/{{$resultado->id}}" class="btn btn-light-warning font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><i class="fas fa-edit p-0"></i></a>

                        <a href="/admin/encuesta/recursos/{{$resultado->id}}" class="btn btn-light-success btn-sm my-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Registrar recursos"><i class="fas fa-plus-circle p-0"></i></a>
                    </td>
                </tr>
            @endforeach

            @if (count($resultados) <= 0)
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
