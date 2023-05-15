<!DOCTYPE html>
<head>
	@section('head')
		<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
		@include('layouts.include.admin.head')
		{{-- Estilos extras de la página --}}
		@yield('styles')
	@show
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    @include('layouts.include.admin.headerMobile')

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            @include('layouts.include.admin.aside')

            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                @include('layouts.include.admin.header')

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @yield('subheader')
                    
                    <div class="d-flex flex-column-fluid">
                        {{-- Contenido de la página --}}
                        @yield('contenido')
                    </div>

                </div>
                @include('layouts.include.admin.footer')
                {{-- Modales de la página --}}
                @yield('modal')
            </div>
        </div>
    </div>

    <!-- begin::User Panel-->
	<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
		<!--begin::Header-->
		<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
			<h3 class="font-weight-bold m-0">Perfil de usuario
			{{--<small class="text-muted font-size-sm ml-2">12 messages</small></h3>--}}
			<a href="javascript:" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
				<i class="ki ki-close icon-xs text-muted"></i>
			</a>
		</div>
		<!--end::Header-->
		
		<!--begin::Content-->
		<div class="offcanvas-content pr-5 mr-n5">
			<!--begin::Header-->
			<div class="d-flex align-items-center mt-5">
				<div class="symbol symbol-100 mr-5">
					<div class="symbol-label p-8" style="background-image:url(https://www.pngitem.com/pimgs/m/150-1503941_user-windows-10-user-icon-png-transparent-png.png)"></div>
					<i class="symbol-badge bg-success"></i>
				</div>
				<div class="d-flex flex-column">
					<a href="javascript:" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ Auth::user()->usuario }}</a>
					<div class="text-muted mt-1">Administrador CAPACITANDOME-IIAP</div>
					
					<div class="navi mt-2">
						<a href="javascript:" class="navi-item">
							<span class="navi-link p-0 pb-2">									
								<span class="navi-text text-muted text-hover-primary"><i class="la la-user"></i> {{ Auth::user()->usuario }}</span>
							</span>
						</a>
						
						<a href="{{ route('cerrarSesionPost') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
						class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"> Cerrar sesión
						<form id="logout-form" action="{{ route('cerrarSesionPost') }}" method="POST" class="d-none">
							@csrf
						</form>
					
						</a>
					</div>
				</div>
			</div>
			<!--end::Header-->

			<!--begin::Separator-->
			<div class="separator separator-dashed mt-8 mb-5"></div>
		</div>
		<!--end::Content-->
	</div>
		<!-- end::User Panel-->

	@section('scripts')
		@include('layouts.include.admin.scripts')
	@show
	@yield('script')
</body>
</html>
