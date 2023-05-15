<!DOCTYPE html>
<html lang="es">

<head>
    @section('head')
    @include('layouts.include.web.logueado.head')
    {{-- Estilos extras de la página --}}
    @yield('styles')
    @show
</head>

<body>
    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>
    <!-- end cssload-loader -->
    @include('layouts.include.web..logueado.header')
    {{-- Contenido de la página --}}
    @yield('contenido')
    @include('layouts.include.web..logueado.footer')
    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="fa fa-angle-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    @yield('modal')
    @section('scripts')
    @include('layouts.include.web.scripts')
    @show
    @yield('script')
</body>

</html>
