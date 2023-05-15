<div class="col-md-12 table-responsive">
    <table class="table table-bordered table-hover" id="table_examen">
        <thead class="table-primary">
            <tr>
                <th>N°</th>
                <th>Datos personales</th>
                <th class="text-center">Promedio</th>
                <th class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($estudiantes as $key => $estudiante)

                <tr id="tr_{{ $estudiante->idusuario }}">
                    <td>{{ $key+1 }}.</td>
                    <td>
                        {{ $estudiante->Persona->apellidos . ', ' . $estudiante->Persona->nombre }}
                        <span class="text-muted">{{ $estudiante->Persona->dni }}</span>
                    </td>

                    <td class="text-center">

                        @php

                            $promedio_total  = 0;
                            $sumatoria_total = 0;
                            $count_seccion_examen = 0;


                            foreach ($curso->Secciones as $key => $secciones) {

                                $promedio_seccion  = 0;
                                $sumatoria_seccion = 0;

                                (count($secciones->Examenes) > 0) ? $count_seccion_examen++ : $count_seccion_examen;


                                foreach ($secciones->Examenes as $key => $examenes) {


                                    foreach ($estudiante->ResolverExamenes as $key => $resuelto) {

                                        if ($resuelto->idexamen == $examenes->idexamen) {

                                            $sumatoria_seccion += $resuelto->calificacion_final;

                                        }
                                    }
                                }

                                $promedio_seccion   = (count($secciones->Examenes) > 0) ? $sumatoria_seccion / count($secciones->Examenes) : 0;
                                $sumatoria_total   += $promedio_seccion;
                                $sumatoria_seccion  = 0;

                                // echo "({$count_seccion_examen})";
                            }

                            $promedio_total  = (($count_seccion_examen) > 0) ? $sumatoria_total  / $count_seccion_examen : 0;
                            $sumatoria_total = 0;


                        @endphp

                        {{ $promedio_total }}
                    </td>
                    <td class="text-center">
                        <a href="{{ asset('/admin/course/estudiante/examen/'. $curso->idcurso . '/' . $estudiante->idusuario) }}" class="btn btn-light-info font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Ver resolución de exámenes">
                            <i class="fas fa-book-reader p-0"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="mostrarNotas({{ $estudiante->idusuario }}, {{ $curso->idcurso }})" class="btn btn-light-info font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Ver notas de cada exámen">
                            <i class="fas fa-list-ol p-0"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

            @if (count($estudiantes) == 0)
                <tr>
                    <td class="text-center" colspan="7">No existen registros...</td>
                </tr>
            @endif

        </tbody>
    </table>
</div>
