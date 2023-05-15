<!--======================================
        START HEADER AREA
    ======================================-->
    <header class="header-menu-area">
        <div class="header-menu-content dashboard-menu-content my-course-menu-content">
            <div class="container-fluid">
                <div class="main-menu-content">
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <div class="logo-box">
                                <a href="{{ route('inicio') }}" class="logo"><img src="{{ asset('/recursos/web/images/logo.png') }}" alt="logo"></a>
                                <div class="side-menu-open">
                                    <i class="la la-user"></i>
                                </div>
                            </div>
                        </div><!-- end col-lg-2 -->
                        <div class="col-lg-10">
                            <div class="menu-wrapper">
                               
                                {{--<div class="contact-form-action">
                                    <form autocomplete="off">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="search" placeholder="Buscar un curso">
                                                <span class="la la-search search-icon"></span>
                                            </div>
                                        </div><!-- end input-box -->
                                    </form>
                                </div>--}}

                                
                                <div class="logo-right-button d-flex align-items-center">
                                    
                                    
                                    @if (Auth::user()->idrol == 2)
                                        <div class="shop-cart course-cart h-auto">
                                            <ul>
                                                <li>
                                                    <a href="#" class="shop-cart-btn font-size-15 text-uppercase">Mis cursos<i class="la la-angle-down ml-1"></i></a>
                                                    <ul class="cart-dropdown-menu">
                                                        
                                                        @if (count($miscursos_header) > 0)
                                                            @foreach ($miscursos_header as $item)
                                                                <li>
                                                                    <a href="javascript:" class="cart-link">
                                                                        <img src="{{ asset('/storage/cursos/'.$item->portada.'') }}" alt="product">
                                                                    </a>
                                                                    <div class="cart-info">
                                                                        <a href="{{ route('miaprendizaje', $item->idcurso) }}">
                                                                            {{ $item->titulo }}
                                                                        </a>
                                                                        <div class="skillbar-box mt-2 w-100">
                                                                            <div class="skillbar" data-percent="30%">
                                                                                <div class="skillbar-bar"></div>
                                                                            </div> <!-- End Skill Bar -->
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <li>
                                                                <div class="cart-info">
                                                                    <span>No existe cursos comprados.</span>
                                                                </div>
                                                            </li>
                                                        @endif                                                  
                                                        
                                                        <li>
                                                            <a class="theme-btn w-100 text-center" href="{{ route('miscursos') }}">Ver todos mis cursos</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    
                                    

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
                                                                <div class="image">
                                                                    <a href="#">
                                                                        <i class="la la-user" style="font-size: 60px"></i>
                                                                    </a>
                                                                </div>
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
                                </div><!-- end logo-right-button -->
                                
                                
                                <div class="user-nav-container">
                                    <div class="humburger-menu">
                                        <div class="humburger-menu-lines side-menu-close"></div><!-- end humburger-menu-lines -->
                                    </div><!-- end humburger-menu -->
                                    <div class="section-tab section-tab-2">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation">
                                                <a href="#notification-home" role="tab" data-toggle="tab" class="active" aria-selected="true">
                                                    Cuenta
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="user-panel-content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="notification-home" role="tabpanel">
                                                <div class="user-sidebar-item">
                                                    <div class="mess-dropdown">
                                                        <div class="mess__body">
                                                            <a href="{{ route('perfil') }}" class="d-block">
                                                                <div class="mess__item">
                                                                    <div class="icon-element bg-color-1 text-white">
                                                                        <i class="la la-user"></i>
                                                                    </div>
                                                                    <div class="content">
                                                                        <p class="text">Mi cuenta</p>
                                                                    </div>
                                                                </div><!-- end mess__item -->
                                                            </a>
                                                            <a href="{{ route('cerrarSesion') }}" class="d-block">
                                                                <div class="mess__item">
                                                                    <div class="icon-element bg-color-2 text-white">
                                                                        <i class="la la-sign-out"></i>
                                                                    </div>
                                                                    <div class="content">
                                                                        <p class="text">Cerrar sesión</p>
                                                                    </div>
                                                                </div><!-- end mess__item -->
                                                            </a>
                                                            
                                                        </div>
                                                    </div><!-- end mess-dropdown -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div><!-- end menu-wrapper -->
                        </div><!-- end col-lg-10 -->
                    </div><!-- end row -->
                </div>
            </div><!-- end container-fluid -->
        </div><!-- end header-menu-content -->
    </header><!-- end header-menu-area -->
    <!--======================================
            END HEADER AREA
    ======================================-->