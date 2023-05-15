<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">Nombre</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control {{ ($errors->first('titulo')) ? 'is-invalid' : '' }} form-control-solid" type="text" name="titulo"
            value="{{ old('titulo', $curso->titulo) }}">
        <div class="invalid-feedback">{{ $errors->first('titulo') }}</div>
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">Imagen</label>
    <div class="col-lg-9 col-xl-6">
        <div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url({{ asset('/recursos/admin/assets/media/users/blank.png') }})">
            <div class="image-input-wrapper"></div>
           
            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Modificar imagen">
             <i class="fa fa-pen icon-sm text-muted"></i>
             <input type="file" name="portada" accept=".png, .jpg, .jpeg"/>
             <input type="hidden" name="portada_eliminar"/>
            </label>
           
            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancelar imagen">
             <i class="ki ki-bold-close icon-xs text-muted"></i>
            </span>
           
            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Eliminar imagen">
             <i class="ki ki-bold-close icon-xs text-muted"></i>
            </span>
           </div>
        <div class="text-danger">{{ $errors->first('portada') }}</div>
    </div>
</div>

<div class="form-group row align-items-center">
    <label class="col-xl-3 col-lg-3 col-form-label text-right font-weight-bolder">Plan</label>
    <div class="col-lg-9 col-xl-6">
        <div class="radio-inline">
            <label class="radio">
            <input type="radio" checked="checked" value="1" name="plan">
            <span></span>PAGO</label>
        </div>
        <div class="invalid-feedback">{{ $errors->first('plan') }}</div>
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">T.Horas</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control {{ ($errors->first('hora_duracion')) ? 'is-invalid' : '' }} form-control-solid" 
        type="number" name="hora_duracion" value="{{ old('hora_duracion', $curso->hora_duracion) }}">
        <div class="invalid-feedback">{{ $errors->first('hora_duracion') }}</div>
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">Precio</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control {{ ($errors->first('precio')) ? 'is-invalid' : '' }} form-control-solid" 
        type="number" name="precio" value="{{ old('precio', $curso->precio) }}">
        <div class="invalid-feedback">{{ $errors->first('precio') }}</div>
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">Categoria</label>
    <div class="col-lg-9 col-xl-6">
        <select name="idcategoria" id="idcategoria" class="form-control form-control-solid">
            <option value=""></option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->idcategoria }}" {{ old('idcategoria') == $categoria->idcategoria ? "selected" : "" }}>
                    {{ $categoria->categoria }}
                </option>
            @endforeach
        </select>
        <div class="text-danger">{{ $errors->first('idcategoria') }}</div>
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">F.Inicio</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control {{ ($errors->first('fecha_inicio')) ? 'is-invalid' : '' }} form-control-solid" 
        type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $curso->fecha_inicio) }}">
        <div class="invalid-feedback">{{ $errors->first('fecha_inicio') }}</div>
    </div>
</div>

<div class="form-group row">
    <label class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">F.Final</label>
    <div class="col-lg-9 col-xl-6">
        <input class="form-control {{ ($errors->first('fecha_final')) ? 'is-invalid' : '' }} form-control-solid" 
        type="date" name="fecha_final" value="{{ old('fecha_final', $curso->fecha_final) }}">
        <div class="invalid-feedback">{{ $errors->first('fecha_final') }}</div>
    </div>
</div>

<div class="form-group row align-items-center">
    <label class="col-xl-3 col-lg-3 col-form-label text-right font-weight-bolder">Descripción</label>
    <div class="col-lg-9 col-xl-6">
        <textarea class="form-control {{ ($errors->first('descripcion')) ? 'is-invalid' : '' }} form-control-solid" 
            name="descripcion" cols="30" rows="10">{{ old('descripcion', $curso->descripcion) }}</textarea>
        <div class="invalid-feedback">{{ $errors->first('descripcion') }}</div>
    </div>
</div>
<!--
<div class="row">
    <div class="col-lg-9 col-xl-6 offset-xl-3">
        <h3 class="font-size-h6 mb-5 font-weight-bolder">DETALLES DEL PLAN ADQUIRIDO.</h3>
    </div>
</div>

<div class="row">
    <div class="col-lg-9 col-xl-6 offset-xl-3">
        <div class="timeline timeline-2">
            <div class="timeline-bar"></div>
            <div class="timeline-item">
                <div class="timeline-badge"></div>
                <div class="timeline-content d-flex align-items-center justify-content-between">
                    <span class="mr-3">
                        <a href="#">CERTIFICACIÓN</a>
                    </span>
                    <span class="fa fa-check-circle text-success text-right"></span>
                </div>
            </div>
            <div class="timeline-item">
                <span class="timeline-badge bg-success"></span>
                <div class="timeline-content d-flex align-items-center justify-content-between">
                    <span class="mr-3">
                        <a href="#">DESCARGAR RECURSOS</a>
                    </span>
                    <span class="fa fa-check-circle text-success text-right"></span>
                </div>
            </div>
            <div class="timeline-item">
                <span class="timeline-badge bg-success"></span>
                <div class="timeline-content d-flex align-items-center justify-content-between">
                    <span class="mr-3">
                        <a href="#">DESCARGAR RECURSOS</a>
                    </span>
                    <span class="fa fa-check-circle text-success text-right"></span>
                </div>
            </div>
            <div class="timeline-item">
                <span class="timeline-badge bg-success"></span>
                <div class="timeline-content d-flex align-items-center justify-content-between">
                    <span class="mr-3">
                        <a href="#">DESCARGAR RECURSOS</a>
                    </span>
                    <span class="fa fa-check-circle text-success text-right"></span>
                </div>
            </div>
        </div>
    </div>
</div>

-->

<div class="separator separator-dashed my-10"></div>
<!--begin::Heading-->
