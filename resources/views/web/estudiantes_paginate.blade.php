<span><strong style="color: black">TR :</strong> Total revisado</span>&nbsp;|&nbsp;
<span><strong style="color: black">FR :</strong> Falta revisar</span>
<div class="table-responsive">                                            
    <table class="table table-sm table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 5%">N°</th>
                <th style="width: 60%">Estudiante</th>
                <th style="width: 5%" class="text-center">TR</th>
                <th style="width: 5%" class="text-center">FR</th>
                <th style="width: 15%" class="text-center">Estado</th>
                <th style="width: 10%" class="text-center"><i class="fa fa-cogs"></i></th>
            </tr>
        </thead>
        @php
            $autoi = 1;
        @endphp
        <tbody>
            @foreach ($data as $index => $item)
            <tr>
                <td>{{ ($index+1) }}.</td>
                <td>{{$item['estudiante']->apellidos." ".$item['estudiante']->nombre}}</td>
                <td>{{$item['cantidad_resuelto']}}</td>
                <td>{{$item['cantidad_falta']}}</td>
                <td class="text-center">
                    @if ($item['reviso_todo'] == true)
                        <span style="font-size: 13px" class="text-success">Revisado</span>                                                            
                    @else
                        <span style="font-size: 13px" class="text-danger">No revisado</span>
                    @endif      
                </td>                                                  
                <td class="text-center">
                    <a href="javascript:" onclick="listaTareaEstudiante({{$curso->idcurso}},{{$seccion->idseccion}},{{$item['estudiante']->idusuario}})" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right" title="Ver tareas estudiante"><i class="fa fa-plus-circle"></i></a>
                </td>
            </tr>
            @endforeach                                            
        </tbody>                                                        
    </table>                                                                                                            
</div>
@if (count($data) == 0 && $search != "")
    <div class="text-center"><h4>No hemos encontrado resultados para : <strong>"{{$search}}"</strong></h4></div><br><br>
@endif 


<div class="page-navigation-wrap text-center">
    <div class="page-navigation-inner d-inline-block">
        <div class="page-navigation mx-auto">
            {{ $data->links('vendor.pagination.pagination') }}
        </div>
    </div>
</div>