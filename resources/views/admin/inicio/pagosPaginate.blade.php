<table class="table table-separate table-head-custom table-checkable">
    <thead>
        <tr class="text-left text-uppercase">
            <th>N°</th>
            <th>F.VENTA</th>
            <th>PERSONA</th>
            <th>CURSO</th>
            <th>PRECIO</th>
            <th>VOUCHER</th>
            <th>OPCIÓN</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pagos as $index => $item)
            <tr id="tr_{{$item->idventa}}">
                <td>{{ $pagos->perPage()*($pagos->currentPage()-1)+($index+1) }}</td>                                        
                <td><strong>{{ $item->fecha_venta}}</strong></td>
                <td>{{ $item->nombre." ".$item->apellidos }}</td>
                <td>{{ $item->titulo }}</td>
                <td>s/.{{ $item->precio }}</td>
                <td>
                    <a target='_blank' href='storage/boucher_pago/{{$item->boucher_pago}}' class='btn btn-light-primary font-weight-bold btn-sm'><i class='fa fa-folder-plus'></i> Voucher </a>
                </td>
                <td class="text-center">
                    <a href="javascript:" onclick="habilitarVenta({{$item->idventa}})"
                        class="btn btn-light-success btn-sm" data-toggle="tooltip" 
                        data-placement="top" data-original-title="Habilitar venta"><i class="fas fa-check-circle p-0"></i>
                    </a>
                    <a href="javascript:" onclick="eliminarVenta({{$item->idventa}})"
                        class="btn btn-light-danger btn-sm" data-toggle="tooltip" 
                        data-placement="top" title="" data-original-title="Eliminar venta"><i class="fas fa-trash p-0"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        @if (count($pagos) == 0 && $search != "")
            <tr>
                <td colspan="7">
                    <center>
                        No existen registros relacionados para : <strong>"{{$search}}"</strong>
                    </center>
                </td>
            </tr>
        @endif
    </tbody>
</table>
{!! $pagos->links('vendor.pagination.paginate-admin') !!}