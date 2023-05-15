<li>
    <div class="comment">
        <div class="comment-avatar">
            <i class="la la-user" style="font-size: 60px"></i>
        </div>
        
        <div class="comment-body">
            <div class="meta-data d-flex align-items-center justify-content-between">
                <div class="question-meta-content">
                    <h3 class="comment__author">{{$comentario->comentario}}</h3>
                    <p class="comment__meta">
                        <span><a href="#">{{$comentario->nombre.' '.$comentario->apellidos}}</a></span>
                        <span>{{$comentario->fecha}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="question-replay-separator-wrap d-flex align-items-center justify-content-between pb-3">
        <span class="widget-title font-size-16 primary-color"> {{ count($respuestas)}} Respuestas</span>
        <button class="btn swapping-btn" data-text-swap="Siguiendo respuestas" data-text-original="Seguir respuestas">Seguir respuestas</button>
    </div>
    <div class="section-block"></div>
    <div class="question-answer-wrap">

        @foreach ($respuestas as $respuesta)
            <div class="comment">
                <div class="comment-avatar">
                    @if (Auth::user()->idrol == 1)
                        <i class="la la-user" style="font-size: 60px; color: #51be78"></i>
                    @else
                        <i class="la la-user" style="font-size: 60px"></i>
                    @endif
                    
                </div>
                <div class="comment-body">
                    <div class="meta-data d-flex align-items-center justify-content-between">
                        <div class="question-meta-content">
                            <h3 class="comment__author">
                                <a href="javascript:" class="d-inline-block">{{$respuesta->nombre.' '.$respuesta->apellidos}}</a> {{ ($respuesta->tipo_persona == 'Docente') ? '- Docente' : '' }}
                            </h3>
                            <p class="comment__meta">
                                <span>{{$respuesta->fecha}}</span>
                            </p>
                            <p class="comment-content">
                                {{$respuesta->comentario}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
        <div class="section-block"></div>
        <div class="question-replay-input-wrap padding-top-35px">
            <div class="question-replay-body">
                <h3 class="widget-title font-size-16">Enviar respuesta</h3>
                <div class="contact-form-action pt-4">
                    <form method="post" id="frm-new-respuesta">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="idcomentario" value="{{$comentario->idcomentario}}">
                        <input type="hidden" name="idclase" value="{{$comentario->idclase}}">
                        <div class="input-box">
                            <div class="form-group">
                                <span class="la la-pencil input-icon"></span>
                                <textarea class="message-control form-control" id="nuevarespuesta" name="nuevarespuesta" placeholder="Escribe tu respuesta..."></textarea>
                            </div>
                            <div class="btn-box">
                                <button  type="button" class="theme-btn" onclick="nuevaRespuesta({{$comentario->idcomentario}})">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</li>
