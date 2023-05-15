<!DOCTYPE html>
<html lang="es">
<head>
    @section('head')
        @include('layouts.include.web.head')

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

    <!-- Facebook -->
    <div id="fb-root"></div>

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v8.0" nonce="K7AUSHO5"></script>
    <!-- end Facebook -->

    @include('layouts.include.web.header')

    @yield('contenido')

    @include('layouts.include.web.footer')

    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="fa fa-angle-up" title="Go top"></i>
    </div>
    <!-- end scroll top -->

    <div class="mt-4 modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ingrese a su cuenta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="contact-form-action">
                        <form method="post" autocomplete="off" id="frm-login">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-box">
                                        <label class="label-text">Usuario<span
                                                class="primary-color-2 ml-1">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="usuario"
                                                placeholder="Ingrese su usuario">
                                            <span class="la la-envelope input-icon"></span>
                                        </div>
                                    </div>
                                </div><!-- end col-md-12 -->

                                <div class="col-lg-12">
                                    <div class="input-box">
                                        <label class="label-text">Contraseña<span
                                                class="primary-color-2 ml-1">*</span></label>
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="password"
                                                placeholder="Ingrese su contraseña">
                                            <span class="la la-lock input-icon"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12" id="error-frm-login"></div>
                                
                                <div class="col-lg-12 ">
                                    <div class="btn-box">
                                        <button class="theme-btn btn-block" id="btn-login" type="submit">ACCEDER A MI
                                            CUENTA</button>
                                    </div>
                                </div><!-- end col-md-12 -->
                            </div><!-- end row -->
                        </form>
                    </div><!-- end contact-form -->
                </div>
            </div>
        </div>
    </div>

    @yield('modal')

    @section('scripts')
        @include('layouts.include.web.scripts')
    @show

    @yield('script')
    <script>
        $("#frm-login").keypress(function(e) {
            if (e.which == 13) {
                // return false;

                e.preventDefault();

                // Verificar si los campos son válidos
                if ($("#frm-login")[0].checkValidity()) {
                    $("#frm-login").submit(); // Enviar el formulario
                }
            }
        });
    </script>
</body>
</html>
