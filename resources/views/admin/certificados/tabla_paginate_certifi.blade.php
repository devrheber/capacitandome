@php
    $porcentaje_examen         = $mallacurricular->puntaje_examen_final;
    $porcentaje_proyecto_final = $mallacurricular->puntaje_trabajo_final;

    $puntos_examen         = ($porcentaje_examen * 20) / 100;
    $puntos_proyecto_final = ($porcentaje_proyecto_final * 20) / 100;
@endphp

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">N°</th>
            <th scope="col">Nombres y apellidos</th>
            <th scope="col" class="text-center">Trabajo final</th>
            <th scope="col" class="text-center">Nota Examen <span class="text-info"> ({{ $porcentaje_examen }} %)</span></th>
            <th scope="col" class="text-center">Nota proyecto <span class="text-info"> ({{ $porcentaje_proyecto_final }} %)</span></th>
            <th scope="col" class="text-center">Promedio</th>
            <th scope="col" class="text-center">Certificado</th>                                     
            <th scope="col" class="text-center"><i class="fa fa-cogs"></i></th>
        </tr>
    </thead>
    <tbody>
        {{--<h1>{{count($estudiantes)}}</h1>--}}
        @php
            $autoi = 1;
        @endphp
        @foreach ($estudiantes as $estudiante)
        
            <tr>
                {{-- N° --}}
                <td>{{$autoi++}}</td>

                {{-- Nombres y apellidos --}}
                <td>{{$estudiante->persona->nombre." ".$estudiante->persona->apellidos}}</td>

                {{-- Trabajo final --}}
                <td class="text-center">

                    @if (count($estudiante->Entregable) > 0)
                        @if ($estudiante->Entregable[0]->archivo != "" || $estudiante->Entregable[0]->archivo != NULL)
                            <a href="/storage/tareas/{{$estudiante->Entregable[0]->archivo}}" target="_blank" class="btn btn-light-warning btn-sm"><i class="las la-folder-open"></i></a>
                        @else
                            <span class="text-danger">---</span>
                        @endif
                    @endif
                    
                </td>
                
                {{-- Nota Examen  --}}
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

                    @php
                        $puntos_total_examen = ($promedio_total * $puntos_examen) / 20;
                    @endphp

                    <b>{{ round($promedio_total, 2) }} </b> <span class="text-info">({{ round($puntos_total_examen, 2) }})</span>

                </td>

                {{-- Nota proyecto --}}
                <td class="text-center">
                    {{-- {{$estudiante}} --}}
                    @if (count($estudiante->Entregable) > 0)
                        @php
                            $promedio_proyecto = ($estudiante->Entregable[0]->nota)? $estudiante->Entregable[0]->nota : 0;
                            $puntos_total_proyecto = ($promedio_proyecto * $puntos_proyecto_final) / 20;
                        @endphp
                        
                        <b>{{ round($promedio_proyecto, 2) }}</b> <span class="text-info">({{ round($puntos_total_proyecto, 2) }})</span>
                        {{-- <b>{{ $estudiante->Entregable }}</b> --}}
                    @else
                        @php
                            $promedio_proyecto = 0;
                            $puntos_total_proyecto = 0;
                        @endphp
                    @endif

                </td>
                
                {{-- Promedio --}}
                <td class="text-center">

                    @php
                        $promedio_general_total = $puntos_total_examen + $puntos_total_proyecto;
                    @endphp
                    
                    <b>{{ round($promedio_general_total,2) }}</b> 
                </td>

                {{-- Certificado --}}
                <td class="text-center">
                    @if (count($estudiante->Certificados) > 0)
                        <a href="{{ asset('/storage/' . $estudiante->Certificados->first()->url ) }}" target="_blank" class="btn btn-danger btn-sm"><i class="fas fa-medal p-0"></i></a>
                    @else
                        <span class="text-danger">No tiene certificado</span>
                    @endif
                </td> 
                
                {{-- Acción --}}
                <td class="text-center">
                    <a href="javascript:void(0)" onclick="ModalCertificado({{ $estudiante->idusuario }}, {{ $curso->idcurso }}, &#39{{ $estudiante->Persona->nombre . ' ' . $estudiante->Persona->apellidos }}&#39, &#39{{ $curso->titulo }}&#39)" class="btn btn-light-info font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Subir Certificado">
                        <i class="fas fa-plus-circle p-0"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@if (count($estudiantes) == 0)
    <div class="alert alert-danger" role="alert">
        <h6>
            No existen resultados para : <strong>"{{$searh_estudiante}}"</strong>
        </h6>
    </div>
@endif
{{ $estudiantes->links('vendor.pagination.paginate-admin') }}