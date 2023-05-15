@extends('layouts.app_webLogueado')
@section('tituloPagina','Mis cursos')
@section('styles')
<link rel="stylesheet" href="{{ asset('/recursos/web/css/pagination.css') }}">
@endsection
@section('contenido')

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area my-courses-bread" style="height: 210px;background-color: #233d63 !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content my-courses-bread-content">
                    <div class="section-heading">
                        <h2 class="section__title"> <span style="color:#28a745">CURSO : </span>{{$curso->titulo}}</h2>
                    </div>
                </div><!-- end breadcrumb-content -->
                <div class="my-courses-tab">
                    <div class="section-tab section-tab-2">
                        <ul class="nav nav-tabs" role="tablist" id="review">
                            <li role="presentation">
                                <a href="#all-courses" role="tab" data-toggle="tab" class="active" aria-selected="true">
                                    TAREAS
                                </a>
                            </li>                                                  
                        </ul>
                    </div>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
       START MY COURSES
================================= -->
<section class="my-courses-area padding-top-30px padding-bottom-90px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <style>.hover:hover{background: #58c772;color: white;border-radius: 5px;}</style>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a class="p-2 hover" href="{{route('miscursos')}}"><i class="fa fa-home"></i> MIS CURSOS</a></li>
                      @if ($entregable->proyFinal > 0)
                        <li class="breadcrumb-item"><a class="p-2 hover" href="{{route('revisarproyecto',$curso->idcurso)}}"><i class="fa fa-book"></i> TRABAJOS FINALES</a></li>
                      @endif
                      <li class="breadcrumb-item active" aria-current="page">REVISAR TAREAS</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="my-course-content-wrap">
                    <div class="my-course-content-body">

                        @if (count($secciones) != 0)
                            <div class="row">
                                <div class="col-lg-12 mt-3 mb-5">
                                    <h3 style=""><i class="fa fa-plus-circle"></i> Seleccione una sección para revisar tareas.</h3>
                                </div>
                            </div>
                            
                            <style>.cardSeccion:hover {background: #d8f5d1;border: 1px solid #58c772;}</style>
                                                
                            <div class="row">
                                @php
                                    $autoi = 1;
                                @endphp
                                @foreach ($secciones as $item)
                                    <div class="col-lg-6 mb-3">
                                        <a href="{{route('listaEstudiantes',array($curso->idcurso,$item->idseccion,0))}}" class="">
                                            <div class="sidebar-widget cardSeccion">                 
                                                <div class="contact-form-action">
                                                    <h4>{{$autoi++}}. {{$item->titulo}}</h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            @if (count($secciones) < 4 )
                                <br><br><br><br><br><br>
                            @endif
                        @else
                            <div class="row" style="margin-top: 100px;margin-bottom: 80px">
                                <div class="col-lg-12">
                                    <div class="sidebar-widget">                 
                                        <div class="contact-form-action text-center">
                                            <h4> <i class="fa fa-edit"></i> AÚN NO HAY TAREAS REGISTRADAS.</h4>
                                            <img src="/recursos/web/images/img_tareas.png" width="200" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end my-courses-area -->
<!-- ================================
       START MY COURSES
================================= -->
@endsection

<!-- start scroll top -->
<div id="scroll-top">
    <i class="fa fa-angle-up" title="Go top"></i>
</div>
<!-- end scroll top -->