<div class="table-responsive-lg">
    <table class="table table-bordered" id="tablaMalla">
        <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Curso</th>
                <th scope="col">Puntaje examen</th>
                <th scope="col">Puntaje trabajo</th>
                <th scope="col" class="text-center"><i class="fa fa-cogs"></i></th>
            </tr>
        </thead>
        @php
            $autoi = 1;
        @endphp
        <tbody>
            @foreach ($mallacurricular as $index => $item)
                <tr id="tr_{{$item->idmalla_curricular}}">
                    <td>{{($index+1) }}.</td>                                        
                    <td><strong>{{ $item->titulo}}</strong></td>
                    <td>{{ $item->puntaje_trabajo_final }}%</td>
                    <td>{{ $item->puntaje_examen_final }}%</td>
                    <td class="text-center">
                        <a href="{{route('admin_show_macurricular',[$item->idmalla_curricular])}}" 
                            class="btn btn-light-info font-weight-bold btn-sm" data-toggle="tooltip" 
                            data-placement="top" data-original-title="Editar Servicio"><i class="fas fa-edit p-0"></i>
                        </a>
                        <a href="javascript:" onclick="eliminar({{$item->idmalla_curricular}})"
                            class="btn btn-light-danger font-weight-bold btn-sm" data-toggle="tooltip" 
                            data-placement="top" title="" data-original-title="Eliminar Servicio"><i class="fas fa-trash p-0"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            @if (count($mallacurricular) == 0 && $filtro_search != "")
                <tr>
                    <td colspan="4">
                        <center>No existen registros relacionados para : <strong>"{{$filtro_search}}"</strong></center>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
{!! $mallacurricular->links('vendor.pagination.paginate-admin') !!}

                                                
