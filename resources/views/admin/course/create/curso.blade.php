@extends('layouts.app_admin')

@section('tituloPagina','Registrar curso')

@section('styles')
@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5"><i class="fa fa-plus-circle mr-1"></i> REGISTRAR NUEVO CURSO</h5>
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="la la-home"></i> Inicio</a>
                <a href="/admin/courses" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="la la-book"></i> Cursos</a>
            </div>
            <!--end::Toolbar-->

        </div>
    </div>
@endsection

@section('contenido')
<div class="container">
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <span class="card-icon">
                    <i class="fa fa-info-circle text-primary"></i>
                </span>
                <h3 class="card-label">Datos del curso <small>(Los campos notificados son requeridos)</small></h3>
            </div>
        </div>

        <div class="card-body">
            {{-- <style>
                .error-select{border: 1px solid rojo !important; border-radius: .42rem !important;}
            </style> --}}

            <form name="form_curso" method="POST" action="{{ route('admin_course_nuevo_add') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf                          
                                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Título  <span class="text-danger">*</span></label>
                            <input type="text" id="titulo" name="titulo" class="form-control {{ $errors->first('titulo') ? 'is-invalid' : '' }}" placeholder="Ingrese titulo del curso..." value="{{ old('titulo') }}">
                            
                            @if ($errors->first('titulo'))
                                <span class="form-text text-danger">{{ $errors->first('titulo') }}</span>
                            @endif                        
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Categoria  <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->first('idcategoria') ? 'is-invalid' : '' }}" name="idcategoria" id="idcategoria">
                                <option value="" selected disabled>Seleccione..</option>
                                @foreach ($categorias as $item)
                                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                                @endforeach
                            </select>

                            @if ($errors->first('idcategoria'))
                                <span class="form-text text-danger">{{ $errors->first('idcategoria') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Plan  <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->first('plan') ? 'is-invalid' : '' }}" name="plan" id="plan">
                                <option value="pago" {{ (old('plan') == 'pago')? 'selected' :'' }}>Pago</option>
                                <option value="gratis" {{ (old('plan') == 'gratis')? 'selected' :'' }}>Gratis</option>
                            </select>

                            @if ($errors->first('plan'))
                                <span class="form-text text-danger">{{ $errors->first('plan') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Precio  <span class="text-danger">*</span></label>
                            <input type="number" id="precio" name="precio" class="form-control {{ $errors->first('precio') ? 'is-invalid' : '' }}" placeholder="0.00" value="{{ old('precio') }}">
                            
                            @if ($errors->first('precio'))
                                <span class="form-text text-danger">{{ $errors->first('precio') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Link de video de introducción  <span class="text-danger">*</span></label>
                            <input type="text" id="url_video_intro" name="url_video_intro" class="form-control {{ $errors->first('url_video_intro') ? 'is-invalid' : '' }}" placeholder="Ingrese la url del video de introduccion..." value="{{ old('url_video_intro') }}">
                            
                            @if ($errors->first('url_video_intro'))
                                <span class="form-text text-danger">{{ $errors->first('url_video_intro') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Fecha de inicio <span class="text-danger">*</span></label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control {{ $errors->first('fecha_inicio') ? 'is-invalid' : '' }}" placeholder="Ingrese la url del video de introduccion..." value="{{ old('fecha_inicio') }}">
                            
                            @if ($errors->first('fecha_inicio'))
                                <span class="form-text text-danger">{{ $errors->first('fecha_inicio') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Fecha finalización  <span class="text-danger">*</span></label>
                            <input type="date" id="fecha_final" name="fecha_final" class="form-control {{ $errors->first('fecha_final') ? 'is-invalid' : '' }}" placeholder="Ingrese la url del video de introduccion..." value="{{ old('fecha_final') }}">
                            
                            @if ($errors->first('fecha_final'))
                                <span class="form-text text-danger">{{ $errors->first('fecha_final') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Duración <span class="text-danger">*</span></label>
                            <input type="number" id="hora_duracion" name="hora_duracion" class="form-control {{ $errors->first('hora_duracion') ? 'is-invalid' : '' }}" placeholder="Total de horas" value="{{ old('hora_duracion') }}">
                            
                            @if ($errors->first('hora_duracion'))
                                <span class="form-text text-danger">{{ $errors->first('hora_duracion') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Total de clases <span class="text-danger">*</span></label>
                            <input type="number" id="total_clases" name="total_clases" class="form-control {{ $errors->first('total_clases') ? 'is-invalid' : '' }}" placeholder="Total de Clases" value="{{ old('total_clases') }}">
                            
                            @if ($errors->first('total_clases'))
                                <span class="form-text text-danger">{{ $errors->first('total_clases') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Imagen principal <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" name="portada" class="custom-file-input {{ $errors->first('portada') ? 'is-invalid' : '' }}" id="customFileimgp" accept="image/*">
                                <label class="custom-file-label" for="customFileimgp">Subir imagen principal</label>
                            </div>                                                  
                            @if ($errors->first('portada'))
                                <span class="form-text text-danger">{{ $errors->first('portada') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label>Imagen secundaria <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" name="url_portada_det" class="custom-file-input {{ $errors->first('url_portada_det') ? 'is-invalid' : '' }}" id="customFile" accept="image/*">
                                <label class="custom-file-label" for="customFile">Subir imagen secundaria</label>
                            </div>                                                  
                            @if ($errors->first('url_portada_det'))
                                <span class="form-text text-danger">{{ $errors->first('url_portada_det') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Descripción corta  <span class="text-danger">*</span></label>
                            <textarea class="form-control {{ $errors->first('descripcion') ? 'is-invalid' : '' }}" placeholder="Esta sección aparecerá junto a la imagen de portada, redacte una breve descripción del curso resaltando lo más importante." id="descripcion" name="descripcion" cols="30" rows="3">{{ old('descripcion') }}</textarea>
                            
                            @if ($errors->first('descripcion'))
                                <span class="form-text text-danger">{{ $errors->first('descripcion') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Descripción larga  <span class="text-danger">*</span></label>
                            <textarea class="form-control {{ $errors->first('descripcion_larga') ? 'is-invalid' : '' }}" placeholder="" id="descripcion_larga" name="descripcion_larga" cols="30" rows="5">{{ old('descripcion_larga') }}</textarea>
                            
                            @if ($errors->first('descripcion_larga'))
                                <span class="form-text text-danger">{{ $errors->first('descripcion_larga') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Recursos  <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->first('recursos') ? 'is-invalid' : '' }}" id="recursos" name="recursos">
                                <option value="1">SI</option>
                                <option value="2">NO</option>
                            </select>
                            
                            @if ($errors->first('recursos'))
                                <span class="form-text text-danger">{{ $errors->first('recursos') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Modalidad  <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->first('modalidad') ? 'is-invalid' : '' }}" id="modalidad" name="modalidad">
                                <option value="1" {{ old('modalidad') == 1 ? 'selected' : '' }}>ONLINE</option>
                                <option value="2" {{ old('modalidad') == 2 ? 'selected' : '' }}>PRESENCIAL</option>
                                <option value="3" {{ old('modalidad') == 3 ? 'selected' : '' }}>ONLINE/PRESENCIAL</option>
                            </select>
                            
                            @if ($errors->first('modalidad'))
                                <span class="form-text text-danger">{{ $errors->first('modalidad') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Plataforma  <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->first('plataforma') ? 'is-invalid' : '' }}" id="plataforma" name="plataforma">
                                <option value="1" {{ old('plataforma') == 1 ? 'selected' : '' }}>ZOOM</option>
                                <option value="2" {{ old('plataforma') == 2 ? 'selected' : '' }}>MEET</option>
                            </select>
                            
                            @if ($errors->first('plataforma'))
                                <span class="form-text text-danger">{{ $errors->first('plataforma') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-4">
                            <label>Certificado  <span class="text-danger">*</span></label>
                            <select class="form-control {{ $errors->first('certificado') ? 'is-invalid' : '' }}" id="certificado" name="certificado">
                                <option value="1" {{ old('certificado') == 1 ? 'selected' : '' }}>SI</option>
                                <option value="2" {{ old('certificado') == 2 ? 'selected' : '' }}>NO</option>
                            </select>
                            
                            @if ($errors->first('certificado'))
                                <span class="form-text text-danger">{{ $errors->first('certificado') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Nombre certificado <span class="text-danger">*</span></label>
                            <input type="text" name="nom_certificado" class="form-control {{ $errors->first('nom_certificado') ? 'is-invalid' : '' }}" placeholder="Ingrese el nombre del certificado del que se les asignará al culminar el curso" value="{{ old('nom_certificado') }}">
                            
                            @if ($errors->first('nom_certificado'))
                                <span class="form-text text-danger">{{ $errors->first('nom_certificado') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label>Brochure <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" name="brochure" class="custom-file-input {{ $errors->first('brochure') ? 'is-invalid' : '' }}" id="customFileBrochure" accept=".pdf">
                                <label class="custom-file-label" for="customFileBrochure">Subir brochure</label>
                            </div>                                                  
                            @if ($errors->first('brochure'))
                                <span class="form-text text-danger">{{ $errors->first('brochure') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-12 text-right pt-3">
                        <a href="/admin/courses" class="btn btn-lg btn-secondary"><i class="la la-close"></i> Cancelar</a>
                        <button type="submit" class="btn btn-lg btn-primary"><i class="la la-plus-circle"></i> Registrar</button>
                    </div>

                </div>                           
            </form>
        </div>
        <!--end::Wizard-->
    </div>

</div>
@endsection

@section('modal')
@endsection

@section('script')
    {{--<script src="{{ asset('/recursos/admin/assets/js/pages/crud/forms/widgets/select2.js') }}"></script>--}}
    
    {{-- <script>
        $(document).ready(function() {
            // Verificamos si hay un valor almacenado en el almacenamiento local
            let storedPlan = localStorage.getItem('selectedPlan');
            
            if (storedPlan) {
                // Establecemos el valor almacenado como el valor seleccionado
                $('#plan').val(storedPlan);
            }

            // Ejecutamos la función de cambio de plan
            $('#plan').change(function () {
                let plan = $(this).val();

                console.log(plan);

                if (plan == "gratis") {
                    $('#precio').prop('disabled', true);
                    $('#precio').val(0);
                } else {
                    $('#precio').prop('disabled', false);
                }

                // Almacenamos el valor seleccionado en el almacenamiento local
                localStorage.setItem('selectedPlan', plan);
            });

            // Verificamos el valor inicial del campo de selección al cargar la página
            if ($('#plan').val() == "gratis") {
                $('#precio').prop('disabled', true);
                $('#precio').val(0);
            }
        });
    </script> --}}
@endsection