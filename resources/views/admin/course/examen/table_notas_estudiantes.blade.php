@if ($examen)

    <div class="table-responsive">
        <table class="table table-hover table-bordered table-sm">
            <thead class="table-primary">
                <tr>
                    <th width="5%">#</th>
                    <th width="60%">ESTUDIANTE</th>
                    <th width="20%">FECHA ENTREGA</th>
                    <th width="15%" class="text-center">NOTA FINAL</th>
                </tr>
            </thead>
            <tbody>
                @if (count($estudiantes) > 0)
                    @foreach ($estudiantes as $key => $alumno)
    
                        @php
                            $fecha  = "";
                            $nota   = null;
                        @endphp
    
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $alumno->Persona->apellidos }}, {{ $alumno->Persona->nombre }}</td>
                            @php
                                if(count($resoluciones) > 0){
                                    foreach ($resoluciones as $key => $res) {
                                        if($res->idusuario == $alumno->idusuario){
                                            $fecha = $res->updated_at;
                                            $nota  = $res->calificacion_final;
                                        }
                                    }
                                }
                            @endphp
                            <td>
                                @if ($fecha == "")
                                    <small class="text-danger"> --/--/---- </small>
                                @else
                                    {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($nota == null)
                                    0 <br><small class="text-danger">(No Resuelto)</small>
                                @else
                                    {{ $nota }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No se encontraron estudiantes...</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

@else

    <div class="modal-body">
        <div class="col-md-12 mb-4">
            <h5 class=" text-center m-0">No se encontró un examen con el id seleccionado</h5>
        </div>
    </div>

@endif
