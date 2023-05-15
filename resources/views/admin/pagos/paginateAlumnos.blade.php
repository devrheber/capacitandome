<table class="table table-bordered">
    <thead>
        <tr>
            <th>N°</th>
            <th>Fecha registro</th>
            <th>Nombre y apellidos</th>
            <th>Telefono</th>
            <th class="text-center">Cuenta</th>
            <th class="text-center">Acción</th>
        </tr>
    </thead>
    <tbody>
        @php
            $autoi = 1;
        @endphp
        @foreach ($ventas as $index => $vent)
            <tr>
                <td>{{ $ventas->perPage()*($ventas->currentPage()-1)+($index+1) }}</td>
                @php
                    setLocale(LC_ALL,'es_Es');
                    $fecha = \Carbon\Carbon::parse($vent->fecha_venta)->locale('es_Es');
                @endphp                                        
                <td>{{ Str::upper($fecha->translatedFormat('l j F Y H:i:s A')) }}</td>
                <td>{{$vent->nombre." ".$vent->apellidos}}</td>
                <td>{{$vent->telefono}}</td>
                <td class="text-center">
                    @if ($vent->estado == 1)
                        <span class="btn btn-success">Activo</span>
                    @elseif($vent->estado == 0)
                        <span class="btn btn-danger">Desactivado</span>
                    @endif
                </td>
                <td class="text-center">
                    @if ($vent->estado == 1)
                        <a href="javascript:" class='btn btn-light-danger font-weight-bold btn-sm' 
                            data-toggle='tooltip' onclick="desactivar({{$vent->idventa}})" data-placement='top' data-original-title='Desactivar cuenta'><i class='fa fa-plus-circle'></i>
                        </a>
                    @elseif($vent->estado == 0)
                        <a href="javascript:" class='btn btn-light-success font-weight-bold btn-sm' 
                            data-toggle='tooltip' onclick="activar({{$vent->idventa}})" data-placement='top' data-original-title='Activar cuenta'><i class='fa fa-plus-circle'></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        @if (count($ventas) == 0 )
            <tr><td colspan="6">Sin registros</td></tr>
        @endif
    </tbody>
</table>
@if (count($ventas) == 0 && $filtro_buscar != "")
    <div class="alert alert-danger" role="alert">
        <h6>
            No existen resultados para : <strong>"{{$filtro_buscar}}"</strong>
        </h6>
    </div>
@endif
{{ $ventas->links('vendor.pagination.paginate-admin') }}