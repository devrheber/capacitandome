<!--======================================
        START HEADER AREA
    ======================================-->
    <header class="header-menu-area"><meta charset="gb18030">
        <!--<div class="header-top">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="header-widget">
                            <ul class="header-action-list">
                                <li><a href="#"><span class="la la-phone mr-2"></span>924755807</a> </li>
                                <li><a href="#"><span class="la la-envelope-o mr-2"></span>iiapam@iiap.gob.pe</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header-widget d-flex align-items-center justify-content-end">
                            <div class="header-right-info">
                                <ul class="header-social-profile">
                                    <li><a href="https://www.facebook.com/IIAPPERU" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.youtube.com/user/webiiap" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="https://www.instagram.com/iiapperu/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            
                            <div class="header-right-info">
                                <ul class="header-action-list">
                                    <li>
                                        <i class="fa fa-phone"></i> +51 (041) 479122
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="header-menu-content">
            <div class="container-fluid">
                <div class="main-menu-content">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <div class="logo-box">
                                <a href="{{route('inicio')}}" class="logo">
                                    <img src="{{ asset('/recursos/web/images/logo.png') }}" alt="logo">
                                </a>
                                
                                <div class="menu-toggler">
                                    <i class="la la-bars"></i>
                                    <i class="la la-times"></i>
                                </div>
                            </div>
                        </div><!-- end col-lg-2 -->
                        
                        <div class="col-lg-10">
                            <div class="menu-wrapper">                                
                                <div class="contact-form-action">
                                    <form method="get" autocomplete="off">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="search" id="search" placeholder="Buscar un curso">
                                                <span class="la la-search search-icon"></span>
                                            </div>
                                        </div>                                     
                                    </form>
                                    
                                    <style>
                                        /* Estilos para el buscador del home */
                                        #suggestions {
                                            box-shadow: 2px 2px 8px 0 rgba(0,0,0,0.5);
                                            height: auto;
                                            position: absolute;
                                            top: 75px;
                                            z-index: 9999;
                                            width: 400px;
                                            border-radius: 5px;
                                            border: 1px solid #ced4da;
                                        }
                                        
                                        #suggestions .suggest-element {
                                            background-color: white;
                                            /* border-bottom: 1px solid #ced4da; */
                                            cursor: pointer;
                                            color: #7f8897;
                                            padding: 8px;
                                            width: 100%;
                                            float: left;
                                        }
                                        
                                        #suggestions .suggest-element:hover {
                                            background: #51be78;
                                            color: white;
                                        }
                                        
                                        /* Botón de Iniciar Sesión en pantallas medianas */
                                        #login-celular{
                                            display:none;
                                        }

                                       @media only screen and (max-width: 992px) {
                                            #login-celular {
                                    	        display:block;
                                            }
                                        }                                        
                                    </style>

                                    <div id="suggestions" style="display: none"></div>
                                </div><!-- .contact-form-action -->

                                <nav class="main-menu">
                                    <ul>
                                        <li>
                                            <a href="{{ route('inicio') }}">Inicio</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cursos') }}">Cursos</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('certificados') }}">Certificados</a>
                                        </li>
                                        <li><a href="{{ url('contactanos') }}">Nosotros</a></li>
                                        <li id="login-celular">
                                            @if (!Auth::id())
                                                <a href="javascript:" data-toggle="modal" data-target="#exampleModal">Iniciar sesión</a>
                                            @else
                                                <a href="{{ route('miscursos') }}" class="d-block">
                                                    <i class="la la-sign-out"></i> Mis Cursos
                                                </a>
                                            @endif
                                        </li>
                                    </ul><!-- end ul -->
                                </nav><!-- end main-menu -->

                                <!-- Botón de Iniciar Sesión en pantallas grandes -->
                                <div class="logo-right-button">                                    
                                    @if (!Auth::id())
                                        <a href="#"class="theme-btn" data-toggle="modal" data-target="#exampleModal">Iniciar sesión</a>                                       
                                    @else
                                        <div class="header-action-button d-flex align-items-center">
                                            <div class="user-action-wrap">
                                                <div class="notification-item user-action-item">
                                                    <div class="dropdown">
                                                        <button class="notification-btn dot-status online-status dropdown-toggle" type="button" id="userDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="la la-user" style="font-size: 40px; background: #51be78; color: white;border-radius: 30px;"></i>
                                                        </button>

                                                        <div class="dropdown-menu" aria-labelledby="userDropdownMenu">
                                                            <div class="mess-dropdown">
                                                                <div class="mess__title d-flex align-items-center">
                                                                    <div class="content">
                                                                        <h4 class="widget-title font-size-16">
                                                                            <a href="#" class="text-white">
                                                                                ¡Hola!, {{ Auth::user()->usuario }}
                                                                            </a>
                                                                        </h4>
                                                                        <span class="email">
                                                                            @if (Auth::user()->idrol == 2)
                                                                                Estudiante
                                                                            @else
                                                                                Docente
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div><!-- end mess__title -->

                                                                <div class="mess__body">
                                                                    <ul class="list-items">
                                                                        <li class="mb-0">
                                                                            <a href="{{ route('perfil') }}" class="d-block">
                                                                                <i class="la la-sign-out"></i> Perfil
                                                                            </a>
                                                                        </li>
                                                                        <li class="mb-0">
                                                                            <a href="{{ route('miscursos') }}" class="d-block">
                                                                                <i class="la la-sign-out"></i> Mis Cursos
                                                                            </a>
                                                                        </li>
                                                                        <li class="mb-0">
                                                                            <a href="{{ route('cerrarSesion') }}" class="d-block">
                                                                                <i class="la la-sign-out"></i> Cerrar seción
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div><!-- end mess__body -->
                                                            </div><!-- end mess-dropdown -->
                                                        </div><!-- end dropdown-menu -->
                                                    </div><!-- end dropdown -->
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div><!-- end logo-right-button -->
                            </div><!-- end menu-wrapper -->
                        </div><!-- end col-lg-10 -->
                    </div><!-- end row -->
                </div><!-- main-menu-content -->
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->
    </header><!-- end header-menu-area -->
    <!--======================================
            END HEADER AREA
    ======================================-->