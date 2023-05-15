@extends('layouts.app_web')
@section('tituloPagina','Certificaciones')
@section('styles')
{{-- <!--<link rel="stylesheet" href="{{ asset('/recursos/web/css/plyr.css') }}">-->
@endsection
@section('contenido')

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area" style="background-image: url('/recursos/web/images/img-cursos.jpg');background-color: #233d63 !important;opacity: 0.9 !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <div class="section-heading">
                        <h2 class="section__title" style="color:#28a745 !important">Nuestras certificaciones</h2>
                    </div>
                    <ul class="breadcrumb__list">
                        <li class="active__list-item"><a href="{{ route('inicio') }}" style="color:#28a745 !important">Inicio</a></li>
                        <li class="active__list-item" style="color:#28a745 !important">Cursos</li>
                    </ul>
                </div><!-- end breadcrumb-content -->
            </div><!-- end col-lg-12 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!--======================================
        START COURSE AREA
======================================-->
<section class="course-area padding-top-120px padding-bottom-120px">
    <div class="course-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-bar d-flex justify-content-between align-items-center">
                        <ul class="filter-bar-tab nav nav-tabs align-items-center" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active icon-element" id="grid-view-tab" data-toggle="tab" href="#grid-view" role="tab" aria-controls="grid-view" aria-selected="true">
                                    <span data-toggle="tooltip" data-placement="top" title="Grid View">
                                        <i class="la la-th-large"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link icon-element" id="list-view-tab" data-toggle="tab" href="#list-view" role="tab" aria-controls="list-view" aria-selected="false">
                                   <span data-toggle="tooltip" data-placement="top" title="List View">
                                        <i class="la la-th-list"></i>
                                   </span>
                                </a>
                            </li>
                        </ul>
                        {{--<div class="sort-ordering">

                            <select class="sort-ordering-select" id="select-idcategoria" name="idcategoria">
                                @php
                                    $idcategoria = old('idcategoria');
                                @endphp
                                <option value="all">Todos</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->idcategoria }}" {{ $idcategoria == $categoria->idcategoria ? "selected" : "" }}>
                                        {{ $categoria->categoria }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div><!-- end filter-bar -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            <div class="course-content-wrapper mt-4">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="grid-view" aria-labelledby="grid-view-tab">
                                <div class="row">

                                    @foreach ($cursos as $curso)
                                        <div class="col-lg-4">
                                            <div class="card-item card-preview" data-tooltip-content="#tooltip_content_{{$curso->idcurso}}">
                                                <div class="card-image">
                                                    <a href="{{ route('cursoid', $curso->idcurso) }}" class="card__img"><img src="{{ asset('/storage/cursos/'.$curso->portada.'') }}" style="height: 247px !important;" alt=""></a>
                                                    <div class="card-badge">
                                                        @if ($curso->plan == 'gratis')
                                                            <span class="badge-label">Gratis</span>
                                                        @else
                                                            <span class="badge-label">Lo más vendido</span>
                                                        @endif
                                                    </div>
                                                </div><!-- end card-image -->
                                                <div class="card-content">
                                                    <p class="card__label">
                                                        <span class="card__label-text">{{ $curso->categoria }}</span>
                                                    </p>
                                                    <h3 class="card__title" style="height: 90px !important;">
                                                        <a href="{{ route('cursoid', $curso->idcurso) }}">{{ $curso->titulo }}</a>
                                                    </h3>
                                                    @php
                                                        switch ($curso->modalidad) {
                                                            case '1':
                                                                $curso->modalidad = 'Online';
                                                                break;
                                                            case '2':
                                                                $curso->modalidad = 'Presencial';
                                                                break;
                                                            case '3':
                                                                $curso->modalidad = 'Online|Presencial';
                                                                break;
                                                            default:
                                                                $curso->modalidad = 'Virtual';
                                                                break;
                                                        }
                                                    @endphp
                                                    <p class="card__author">
                                                        <a href="javascript:"><i class="la la-laptop"></i> Modalidad {{ $curso->modalidad }}</a>
                                                    </p>

                                                    <div class="card-action">
                                                        <ul
                                                            class="card-duration d-flex justify-content-between align-items-center">
                                                            <li>
                                                                <span class="meta__date">
                                                                    <i class="la la-play-circle"></i> {{ $curso->total_clases }} Clases
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="meta__date">
                                                                    <i class="la la-clock-o"></i> {{ $curso->hora_duracion }} Horas
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div><!-- end card-action -->
                                                    <div class="card-price-wrap d-flex justify-content-between align-items-center">
                                                        <span class="card__price">s/.{{ $curso->precio }}</span>
                                                        @if ($curso->plan == 'gratis')
                                                            <a href="{{ route('index_suscribirme', $curso->idcurso) }}" class="text-btn"><i class="la la-check" style="font-size: 30px !important"></i></a>
                                                        @else
                                                            <a href="{{ route('checkout', $curso->idcurso) }}" class="text-btn"><i class="la la-shopping-cart" style="font-size: 30px !important"></i></a>
                                                        @endif
                                                    </div><!-- end card-price-wrap -->
                                                </div><!-- end card-content -->
                                            </div><!-- end card-item -->
                                        </div><!-- end col-lg-6 -->
                                    @endforeach


                                </div><!-- end course-block -->
                            </div><!-- end tab-pane -->
                            <div role="tabpanel" class="tab-pane fade" id="list-view" aria-labelledby="list-view-tab">
                                <div class="row">

                                    @foreach ($cursos as $curso)
                                        <div class="col-lg-12">
                                            <div class="card-item card-list-layout card-preview" data-tooltip-content="#tooltip_content_{{$curso->idcurso}}">
                                                <div class="card-image">
                                                    <a href="{{ route('cursoid', $curso->idcurso) }}" class="card__img"><img src="{{ asset('/storage/cursos/'.$curso->portada.'') }}" alt=""></a>
                                                </div><!-- end card-image -->
                                                <div class="card-content">
                                                    <p class="card__label">
                                                        <span class="card__label-text">{{ $curso->categoria }}</span>
                                                    </p>
                                                    <h3 class="card__title">
                                                        <a href="{{ route('cursoid', $curso->idcurso) }}">{{ $curso->titulo }}</a>
                                                    </h3>
                                                    @php
                                                        switch ($curso->modalidad) {
                                                            case '1':
                                                                $curso->modalidad = 'Online';
                                                                break;
                                                            case '2':
                                                                $curso->modalidad = 'Presencial';
                                                                break;
                                                            case '3':
                                                                $curso->modalidad = 'Online|Presencial';
                                                                break;
                                                            default:
                                                                $curso->modalidad = 'Virtual';
                                                                break;
                                                        }
                                                    @endphp
                                                    <p class="card__author">
                                                        <a href="javascript:"><i class="la la-laptop"></i> Modalidad {{ $curso->modalidad }}</a>
                                                    </p>
                                                    <div class="card-action">
                                                        <ul class="card-duration d-flex justify-content-between align-items-center">
                                                            <li>
                                                            <span class="meta__date">
                                                                <i class="la la-play-circle"></i> {{ $curso->total_clases }} clases
                                                            </span>
                                                            </li>
                                                            <li>
                                                            <span class="meta__date">
                                                                <i class="la la-clock-o"></i> {{ $curso->hora_duracion }} horas
                                                            </span>
                                                            </li>
                                                        </ul>
                                                    </div><!-- end card-action -->
                                                    <div class="card-price-wrap d-flex justify-content-between align-items-center">
                                                        <span class="card__price">s/.{{ $curso->precio }}</span>
                                                        @if ($curso->plan == 'gratis')
                                                            <a href="{{ route('index_suscribirme', $curso->idcurso) }}" class="text-btn"><i class="la la-check" style="font-size: 30px !important"></i></a>
                                                        @else
                                                            <a href="{{ route('checkout', $curso->idcurso) }}" class="text-btn"><i class="la la-shopping-cart" style="font-size: 30px !important"></i></a>
                                                        @endif
                                                    </div><!-- end card-price-wrap -->
                                                </div><!-- end card-content -->
                                            </div><!-- end card-item -->
                                        </div><!-- end col-lg-12 -->
                                        @endforeach

                                </div><!-- end course-block -->
                            </div><!-- end tab-pane -->
                        </div><!-- end tab-content -->
                    </div><!-- end col-lg-8 -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-navigation-wrap text-center mt-5">
                            <div class="page-navigation-inner d-inline-block">
                                <div class="page-navigation mx-auto">
                                    {{ $cursos->links() }}
                                </div>
                            </div>
                        </div><!-- end page-navigation-wrap -->
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
            </div><!-- end card-content-wrapper -->
        </div><!-- end container -->
    </div><!-- end course-wrapper -->
</section><!-- end courses-area -->
<!--======================================
        END COURSE AREA
======================================-->


@endsection

@section('script')
<script src="{{ asset('/recursos/ajax/web/curso.js') }}"></script>
@endsection
