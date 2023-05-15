<div class="table-responsive">
    <table class="table table-bordered" id="">
        <thead>
            <tr>
                <th>N°</th>
                <th>Departamento</th>
                <th>Nombre y apellidos</th>
                <th>DNI</th>
                <th>Telefono</th>
                <th>Rol</th>
                <th>Usuario</th>
                <th>Acción</th>
            </tr>
        </thead>
        @php
            $autoi = 1;
        @endphp
        <tbody>
            @foreach ($personas as $index => $persona)
                <tr>
                    <td>{{ $personas->perPage()*($personas->currentPage()-1)+($index+1) }}</td>
                    <td>{{ $persona->departamento }}</td>
                    <td>{{ $persona->nombre." ".$persona->apellidos }}</td>
                    <td>{{ $persona->dni }}</td>
                    <td>
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $persona->telefono }}</span>
                    </td>
                    <td>
                        @if ($persona->idrol == 1)
                            <span class="label label-lg label-light-primary label-inline">Docente</span>
                        @else
                            <span class="label label-lg label-light-warning label-inline">Estudiante</span>
                        @endif
                    </td>
                    <td>
                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{ $persona->usuario }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin_personas_edit', [$persona->idpersona])  }}" 
                            class="btn btn-light-info font-weight-bold btn-sm" data-toggle="tooltip" 
                            data-placement="top" data-original-title="Editar persona"><i class="fas fa-edit p-0"></i>
                        </a>
                    <a href="javascript:void(0)" onclick="desactivar({{ $persona->idpersona }})" 
                        class="btn btn-light-danger font-weight-bold btn-sm" data-toggle="tooltip" 
                        data-placement="top" title="" data-original-title="Eliminar persona"><i class="fas fa-trash p-0"></i>
                    </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if (count($personas) == 0 && $search != "")
    <div class="alert alert-danger" role="alert">
        <h6>
            No existen resultados para : <strong>"{{$search}}"</strong>
        </h6>
    </div>
@endif
{{ $personas->links('vendor.pagination.paginate-admin') }}