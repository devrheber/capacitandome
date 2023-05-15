<div class="table-responsive">                                            
    <table class="table table-sm table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 5%">N°</th>
                <th style="width: 40%">Estudiante</th>
                <th style="width: 10%" class="text-center">Entregable</th>
                <th style="width: 10%" class="text-center">Nota</th>
                <th style="width: 20%" class="text-center">Estado</th>
                <th style="width: 15%" class="text-center"><i class="fa fa-cogs"></i></th>
            </tr>
        </thead>
        @php
            $autoi = 1;
        @endphp
        <tbody>
            @foreach ($proyFinalEst as $item)
            <tr>
                <td>{{$autoi++}}.</td>
                <td>
                    {{$item->apellidos." ".$item->nombre}}                                                                        
                </td>
                <td class="text-center">
                    @if ($item->archivo != NULL || $item->archivo != '')
                        <a href="/storage/tareas/{{$item->archivo}}" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i></a>
                    @endif
                </td>
                <td class="text-center">
                    @php
                        $nota = ($item->nota == 0) ? '' : $item->nota ;
                    @endphp
                    {{$nota}}
                </td>
                <td class="text-center">
                    @if ($item->nota != 0)
                        <span style="font-size: 13px" class="text-success">Revisado</span>                                                           
                    @else
                        <span style="font-size: 13px" class="text-danger">No revisado</span>
                    @endif     
                </td>                                                  
                <td class="text-center">
                    <a href="javascript:" onclick="modalProyFinal({{$item->identregable}},{{$item->idusuario}},{{$item->idcurso}},{{$item->nota}}, &#39{{ $item->apellidos. ' ' .$item->nombre }}&#39)" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="right" title="REGISTRAR NOTA DEL PROYECTO FINAL"><i class="fa fa-plus-circle"></i></a>
                </td>
            </tr>
            @endforeach                                            
        </tbody>                                                        
    </table>
    
    @if ($search != "" && count($proyFinalEst) == 0)
        <div class="text-center">
            <h4>No hemos encontrado resultados para : <strong>"{{$search}}"</strong></h4>
        </div>
    @endif
        
    <div class="page-navigation-wrap text-center">
        <div class="page-navigation-inner d-inline-block">
            <div class="page-navigation mx-auto">
                {{ $proyFinalEst->links('vendor.pagination.pagination') }}
            </div>
        </div>
    </div>   
    
    @if (count($proyFinalEst) <= 3)
        <br><br><br>
    @endif
    
</div>
