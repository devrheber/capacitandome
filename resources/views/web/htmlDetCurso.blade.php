<div class="lecture-viewer-container">
    <div class="lecture-video-item" >
        <div class="plyr__video-embed" id="player">
            @if ($miclase->url_video != null || $miclase->url_video != "")
                <iframe src="{{ $miclase->url_video }}"></iframe>
            @else
                <h4 class="p-3" style="color: red">LA CLASE AÚN NO ESTÁ SUBIDA. VUELVA A INGRESAR EN LOS PRÓXIMOS DÍAS, GRACIAS POR SU COMPRENSIÓN.</h4>
            @endif
            
        </div>
    </div>
</div>

<div class="lecture-video-detail">
    <div class="lecture-tab-body">
        <div class="section-tab section-tab-2">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="mobile-course-tab">
                    <a href="#course-content" role="tab" data-toggle="tab" aria-selected="true">
                        Contenido del curso
                    </a>
                </li>
                <li role="presentation">
                    <a href="#overview" role="tab" data-toggle="tab" class="active" aria-selected="true">
                        Descripción del curso
                    </a>
                </li>
                <!--<li role="presentation">
                    <a href="#quest-and-ans" role="tab" data-toggle="tab" aria-selected="false">
                        Preguntas y respuestas
                    </a>
                </li>-->
                <li role="presentation">
                    <a href="#announcements" role="tab" data-toggle="tab" aria-selected="false">
                        Recursos de la clase
                    </a>
                </li>
            </ul>
        </div>
        
    </div>
    
    <div class="lecture-video-detail-body">
        <div class="tab-content">
            
            <!-- LISTA DE CLASES PARA MOBILE -->
            <div role="tabpanel" class="tab-pane fade" id="course-content">
                <div class="mobile-course-content-wrap">
                    <div class="mobile-course-menu">
                        <div class="course-dashboard-side-content">
                            <div class="accordion course-item-list-accordion" id="mobileCourseMenu">
                                @php
                                    $cont_1 = 1;
                                @endphp
                                @foreach ($clases as $clase_1)
                                <div class="card">
                                    <div class="card-header" id="mobileCollapseMenu{{$clase_1['idseccion']}}">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#mobileCollapse{{$clase_1['idseccion']}}" aria-expanded="true" aria-controls="mobileCollapse{{$clase_1['idseccion']}}">
                                                <span class="widget-title font-size-15 font-weight-semi-bold">{{$clase_1['nom_modulo']}} {{$cont_1++}}: {{$clase_1['titulo']}}</span>
                                                <div class="course-duration">
                                                    <span>{{$clase_1['cant_clases']}} Clases</span>
                                                </div>
                                            </button>
                                        </h2>
                                    </div>
                                    
                                    <div id="mobileCollapse{{$clase_1['idseccion']}}" class="collapse" aria-labelledby="mobileCollapseMenu{{$clase_1['idseccion']}}" data-parent="#mobileCourseMenu">
                                        <div class="card-body">
                                            <div class="course-content-list">
                                                <ul class="course-list">
                                                    @php
                                                    $autoi_1 = 1; 
                                                    //print_r($clase_1['clases']);
                                                    @endphp
                                                    
                                                    @foreach ($clase_1['clases'] as $item) 
                                                        <li class="course-item-link">
                                                            <a href="#">
                                                                <div class="course-item-content-wrap">
                                                                    {{--@if (Auth::user()->idrol == 2)--}}
                                                                    @if ($item['url_video'] != "" || $item['url_video'] != null)
                                                                        <div class="custom-checkbox">
                                                                            @php
                                                                                $visto = '';
                                                                                if ($item['visto']==1) {
                                                                                    $visto = 'checked';
                                                                                }
                                                                            @endphp
                                                                            
                                                                            <input type="checkbox" id="check{{$item['idclase']}}" {{ $visto }} onclick="checkSesionVista({{ $item['idclase'] }})">
                                                                            <label for="check{{$item['idclase']}}"></label>
                                                                            
                                                                        </div>                                                                        
                                                                    {{--@endif--}}
                                                                    @else
                                                                    <div class="custom-checkbox">
                                                                        <input type="checkbox" id="check_{{$item['idclase']}}" disabled>
                                                                        <label for="check_{{$item['idclase']}}"></label>
                                                                    </div>
                                                                    @endif 
                                                                    <div class="course-item-content" onclick="getRecursosSeccion({{$idcurso}},{{$item['idclase']}} )">
                                                                        <h4 class="widget-title font-size-15 font-weight-medium">{{ $autoi_1 ++ }}. {{ $item['titulo'] }}</h4>
                                                                        <div class="courser-item-meta-wrap">
                                                                            {{--<p class="course-item-meta"><i class="la la-play-circle"></i>$item['minutos_video']</p>--}}
                                                                        </div>
                                                                            
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        
                                                    @endforeach
                                                    
                                                    
                                                    <li class="course-item-link">
                                                        
                                                        @if ($clase_1['examen'] == 1)
                                                            <a href="{{route('resolverExamenEst',$clase_1['idexamen'])}}" class="btn btn-primary btn-block">
                                                                <i class="la la-book"></i> Examen
                                                            </a>
                                                        @endif
                                                        
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    

                                </div>
                                @endforeach
                                @if (Auth::user()->idrol == 2)
                                    @if(empty($usuario_curso_calificado))
                                    <div class="row mt-3 ml-5">
                                        <a href="{{route('calificacion_curso',array($curso->idcurso))}}">
                                            <button class="btn btn-success">
                                                <p>Calificanos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="la la-star" style="color: yellow"></i></p>                              
                                            </button>
                                        </a>
                                    </div>
                                    @else
                                    <div class="row mt-3 ml-5">
                                        <button class="btn btn-success">
                                            <p>Calificado&nbsp;&nbsp;&nbsp;&nbsp;{{$usuario_curso_calificado->promedioCalificacion}}&nbsp;<i class="la la-star" style="color: yellow"></i></p>                              
                                        </button>
                                    </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DESCRIPCIÓN DEL CURSO -->
            <div role="tabpanel" class="tab-pane fade active show" id="overview">
                <div class="lecture-overview-wrap">
                    <div class="lecture-overview-item">
                        <div class="lecture-heading">
                            <h3 class="widget-title pb-2">Acerca de este curso</h3>
                            <p>
                                {{ $curso->descripcion }}
                            </p>
                        </div>
                    </div><!-- end lecture-overview-item -->
                    <div class="section-block"></div>
                    <div class="lecture-overview-item">
                        <div class="lecture-overview-stats-wrap d-flex">
                            <div class="lecture-overview-stats-item">
                                <h3 class="widget-title font-size-16">Certificado</h3>
                            </div>
                            <div class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                <ul class="list-items">
                                    <li>{{ $curso->nom_certificado }}</li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end lecture-overview-item -->
                    <div class="section-block"></div>
                    <div class="lecture-overview-item">
                        <div class="lecture-overview-stats-wrap d-flex">
                            <div class="lecture-overview-stats-item">
                                <h3 class="widget-title font-size-16">Características</h3>
                            </div>
                            <div class="lecture-overview-stats-item">
                                <ul class="list-items">
                                    <li>Adaptado para Laptops, móvil y pc</li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end lecture-overview-item -->
                    <div class="section-block"></div>
                    <div class="lecture-overview-item">
                        <div class="lecture-overview-stats-wrap d-flex">
                            <div class="lecture-overview-stats-item">
                                <h3 class="widget-title font-size-16">Descripción</h3>
                            </div>
                            <div class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                <div class="lecture-description show-more-content">
                                    <p>
                                        {{ $curso->descripcion_larga }}
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                    </div><!-- end lecture-overview-item -->
                    
                </div><!-- end lecture-overview-wrap -->
            </div>
            
            <!-- PREGUNTAS Y RESPUESTAS -->
            <div role="tabpanel" class="tab-pane fade" id="quest-and-ans">
                <div class="lecture-overview-wrap lecture-quest-wrap">
                    
                    
                    <div class="replay-question-wrap">
                        <button class="theme-btn theme-btn-light back-to-question-btn"><i class="la la-reply mr-1"></i>Volver a las preguntas</button>
                        <div class="replay-question-body padding-top-30px">
                            <div class="question-list-item">
                                <ul class="comments-list" id="htmlRespuestasPreg">
                                    
                                    <!-- RESPUESTAS DE CADA PREGUNTA -->

                                </ul>
                            </div>
                        </div>
                    </div><!-- end replay-question-wrap -->
                    <div class="question-overview-result-wrap">
                        @if (Auth::user()->idrol == 2)
                        <div class="lecture-overview-item">
                            <div class="contact-form-action">
                                <form method="post" autocomplete="off" id="frm-new-pregunta">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="input-box">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="newpregunta" id="newpregunta" placeholder="Haz una pregunta">
                                            <input type="hidden" name="idclase" value="{{ $miclase->idclase }}">
                                            <span class="la la-plus search-icon" id="btn-new-pregunta" onclick="nuevaPregunta({{ $idcurso }},{{ $miclase->idclase }})"></span>
                                        </div>
                                    </div><!-- end input-box -->
                                </form>
                            </div><!-- end contact-form-action -->
                        </div><!-- end lecture-overview-item -->
                        @endif
                        
                        
                        <div class="lecture-overview-item mb-0">
                            <div class="question-overview-result-header d-flex align-items-center justify-content-between pb-3">
                                <div class="question-result-item">
                                    <h3 class="widget-title font-size-17">{{count($comentarios)}} preguntas en esta clase</h3>
                                </div>
                            </div>
                            <div class="section-block"></div>
                        </div>

                            <div class="lecture-overview-item mt-0">
                            <div class="question-list-container">
                                <div class="question-list-item">
                                    <ul class="comments-list">

                                        <li id="insertHtmlRespuesta">

                                        </li>
                                       
                                        @foreach ($comentarios as $comentario)
                                        <li onclick="getRespuestasPreg({{$comentario->idcomentario}})">
                                            <div class="comment">
                                                <div class="comment-avatar">
                                                   <i class="la la-user" style="font-size: 60px"></i>
                                                </div>
                                                <div class="comment-body">
                                                    <div class="meta-data d-flex align-items-center justify-content-between">
                                                        <div class="question-meta-content">
                                                            <a href="javascript:void(0)">
                                                                <h3 class="comment__author">{{$comentario->comentario}}</h3>
                                                            </a>
                                                        </div>
                                                        <div class="question-upvote-action">
                                                            <!--<div class="number-upvotes pb-2 d-flex align-items-center">
                                                                <span>1</span>
                                                                <button type="button"><i class="fa fa-arrow-up"></i></button>
                                                            </div>-->
                                                                <div class="number-upvotes question-response d-flex align-items-center">
                                                                <span></span>
                                                                <button type="button" class="question-replay-btn"><i class="fa fa-comments"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="comment__meta">
                                                        <span><a href="javascript:">{{$comentario->nombre.' '.$comentario->apellidos}}</a></span>                                                        
                                                        <span>{{$comentario->fecha}}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        

                                    </ul>
                                </div>
                            </div>
                        </div><!-- end lecture-overview-item -->
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="announcements">
                <div class="lecture-overview-wrap lecture-announcement-wrap">
                    <div class="lecture-overview-item">
                        <div class="lecture-overview-stats-wrap">
                            <div class="lecture-overview-stats-item">
                                
                                <div class="lecture-overview-item mb-0">                                    
                                    <div class="question-overview-result-header d-flex align-items-center justify-content-between pb-3">
                                        <div class="question-result-item">
                                            <h3 class="widget-title font-size-17">{{ count($recursos) }} archivos en esta clase</h3>
                                        </div>
                                        <input type="hidden" id="idclase_actual" value="{{ $miclase->idclase }}">
                                        <input type="hidden" id="idcurso_actual" value="{{ $curso->idcurso }}">
                                        @if (Auth::user()->idrol == 1)
                                            <div class="question-result-item">
                                                <a href="#" class="btn ask-new-question-btn" data-toggle="modal" data-target=".upload-photo-modal-form" title="Importar archivo">
                                                    <i class="fa fa-plus-circle"></i> Adjuntar archivo
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                <div class="lecture-overview-item mt-0">
                                    <div class="question-list-container">
                                        <div class="question-list-item">
                                            <div class="shopping-cart-wrap table-responsive">
                                                <table class="table table-bordered ">
                                                    <thead class="cart-head" style="background: #dee2e6">
                                                        <tr>
                                                            <td class="cart__title">N°</td>
                                                            <td class="cart__title">Titulo</td>
                                                            <td class="cart__title text-center">Opción</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="cart-body">
                                                    @php
                                                        $autoi = 1;
                                                    @endphp
                                                    @foreach ($recursos as $recurso)
                                                        <tr>
                                                            <td>{{ $autoi ++ }}.</td>
                                                            <td>{{ $recurso->nombre }}</td>
                                                            <td class="text-center">
                                                                @if ($recurso->archivo != "" || $recurso->archivo != null)
                                                                    <a class="btn btn-info" href="{{ asset('/storage/archivos/'.$recurso->archivo.'') }}" target="_blank">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                @else
                                                                    <a class="btn btn-info" href="{{ $recurso->url }}" target="_blank">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                @endif
                                                                @if (Auth::user()->idrol == 1)
                                                                {{--<a class="btn btn-warning" href="javascript:">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>--}}
                                                                <a class="btn btn-danger" href="javascript:" onclick="elimarArchivo( {{$recurso->idrecurso}}, {{$recurso->idclase}} )">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                                @endif                                                                
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>                                          
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div><!-- end lecture-overview-item -->
                </div>
            </div>
            
        </div>
    </div>
</div>

