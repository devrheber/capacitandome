@extends('layouts.app_admin')

@section('tituloPagina','Cursos')
@endsection

@section('styles')
@endsection

@section('subheader')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">CURSOS</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="#" class="text-muted"><i class="fa fa-plus-circle" style="font-size: 12px;"></i>Nuevo</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="fa fa-home"></i> Inicio</a>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection

@section('contenido')
<div class="container">

    <div class="card card-custom gutter-bs">
        <!--Begin::Header-->
        <div class="card-header card-header-tabs-line">
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" role="tablist">
                    <li class="nav-item mr-3">
                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_2">
                            <span class="nav-icon mr-2">
                                <span class="svg-icon mr-3">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->
                                    <i width="24px" height="24px" class="fa fa-book"></i>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="nav-text font-weight-bold">CURSO</span>
                        </a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_3">
                            <span class="nav-icon mr-2">
                                <span class="svg-icon mr-3">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Devices/Display1.svg-->
                                    <i width="24px" height="24px" class="fa fa-list"></i>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="nav-text font-weight-bold">CONTENIDO</span>
                        </a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4">
                            <span class="nav-icon mr-2">
                                <span class="svg-icon mr-3">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                    <i width="24px" height="24px" class="fa fa-cogs"></i>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="nav-text font-weight-bold">RECURSOS</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--end::Header-->
        <!--Begin::Body-->
        <div class="card-body px-0">
            <div class="tab-content pt-5">
                <!--begin::Tab Content-->
                <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                    
                    <form class="form p-5" action="{{ route('curso.store') }}" method="POST" autocomplete="off">
                        {!! csrf_field() !!}
                        <!--begin::Heading-->
                        <div class="row">
                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                <h2 class="font-size-h2 font-weight-boldest mb-5">NUEVO CURSO</h2>
                            </div>
                        </div>
                        <!--end::Heading-->
                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">Imagen</label>
                            <div class="col-lg-9 col-xl-9">
                                <div class="image-input image-input-outline image-input-circle" id="kt_user_avatar"
                                    style="background-image: url({{ asset('/recursos/admin/assets/media/users/blank.png') }})">
                                    <div class="image-input-wrapper"
                                        style="background-image: url({{ asset('/recursos/admin/assets/media/svg/avatars/007-boy-2.svg') }})"></div>
                                    <label
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="change" data-toggle="tooltip" title=""
                                        data-original-title="Modificar imagen">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="profile_avatar_remove">
                                    </label>
                                    <span
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="cancel" data-toggle="tooltip" title=""
                                        data-original-title="Cancelar imagen">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                    <span
                                        class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                        data-action="remove" data-toggle="tooltip" title=""
                                        data-original-title="Eliminar imagen">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right font-weight-bolder">Plan</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        <span></span>GRATIS</label>
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        <span></span>PAGO</label>
                                </div>
                                <span class="form-text text-muted">If you want your invoices addressed to a company.
                                    Leave blank to use your full name.</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">Nombre</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control form-control-solid" type="text" value="Nick">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">T.
                                Horas</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control form-control-solid" type="number">
                                <span class="form-text text-muted">If you want your invoices addressed to a company.
                                    Leave blank to use your full name.</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">Precio</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control form-control-solid" type="number" value="Bold">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="col-xl-3 col-lg-3 text-right col-form-label font-weight-bolder">Categoria</label>
                            <div class="col-lg-9 col-xl-6">
                                <input class="form-control form-control-solid" type="text" value="Loop Inc.">
                                <span class="form-text text-muted">If you want your invoices addressed to a company.
                                    Leave blank to use your full name.</span>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label class="col-xl-3 col-lg-3 col-form-label text-right font-weight-bolder">Idioma</label>
                            <div class="col-lg-9 col-xl-6">
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        <span></span>ESPAÑOL(ES)</label>
                                </div>
                                <span class="form-text text-muted">If you want your invoices addressed to a
                                    company.</span>
                            </div>
                        </div>


                        <div class="form-group row align-items-center">
                            <label
                                class="col-xl-3 col-lg-3 col-form-label text-right font-weight-bolder">Descripción</label>
                            <div class="col-lg-9 col-xl-6">
                                <textarea class="form-control form-control-solid" id="" cols="30" rows="10"></textarea>
                                <span class="form-text text-muted">If you want your invoices addressed to a
                                    company.</span>
                            </div>
                        </div>






                        <div class="separator separator-dashed my-10"></div>
                        <!--begin::Heading-->
                        <div class="row">
                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                <h3 class="font-size-h6 mb-5">Contact Info:</h3>
                            </div>
                        </div>
                        <!--end::Heading-->

                        <div class="row">
                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                <div class="timeline timeline-2">
                                    <div class="timeline-bar"></div>
                                    <div class="timeline-item">
                                        <div class="timeline-badge"></div>
                                        <div class="timeline-content d-flex align-items-center justify-content-between">
                                            <span class="mr-3">
                                                <a href="#">12 new users registered and pending for activation</a>
                                                <span class="label label-light-success font-weight-bolder">8</span>
                                            </span>
                                            <span class="text-muted text-right">3 hrs ago</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <span class="timeline-badge bg-success"></span>
                                        <div class="timeline-content d-flex align-items-center justify-content-between">
                                            <span class="mr-3">Scheduled system reboot completed.
                                                <span
                                                    class="label label-inline label-light-primary font-weight-bolder">new</span>
                                                <span
                                                    class="label label-inline label-light-danger font-weight-bolder">hot</span></span>
                                            <span class="text-muted font-italic text-right">6 hrs ago</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <span class="timeline-badge"></span>
                                        <div class="timeline-content d-flex align-items-center justify-content-between">
                                            <span class="mr-3">New order has been placed and pending for
                                                processing.</span>
                                            <span class="text-muted text-right">2 days ago</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <span class="timeline-badge bg-danger"></span>
                                        <div class="timeline-content d-flex align-items-center justify-content-between">
                                            <span class="mr-3">Database server overloaded 80% and requires quick reboot
                                                <span
                                                    class="label label-inline label-danger font-weight-bolder">pending</span></span>
                                            <span class="text-muted text-right">3 days ago</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <span class="timeline-badge bg-warning"></span>
                                        <div class="timeline-content d-flex align-items-center justify-content-between">
                                            <span class="mr-3">System error occured and hard drive has been
                                                shutdown.</span>
                                            <span class="text-muted font-italic text-right">5 days ago</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <span class="timeline-badge bg-success"></span>
                                        <div class="timeline-content d-flex align-items-center justify-content-between">
                                            <span class="mr-3">Production server is rebooting.</span>
                                            <span class="text-muted text-right">1 month ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="separator separator-dashed my-10"></div>
                        <!--begin::Heading-->

                        <!--end::Heading-->

                        <div class="form-group row">
                            <div class="col-lg-9 col-xl-6 offset-xl-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i>REGISTRAR</button>
                                <button type="reset" class="btn btn-warning"><i class="fa fa-trash"></i>CANCELAR</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end::Tab Content-->


                <!--begin::Tab Content-->
                <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                    <h1>CONTENIDO</h1>
                </div>
                <!--end::Tab Content-->


                <!--begin::Tab Content-->
                <div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
                    <h1>RECURSOS</h1>
                </div>
                <!--end::Tab Content-->
            </div>
        </div>
        <!--end::Body-->
    </div>



</div>

@endsection

@section('modal')
@endsection

@section('script')
<script
    src="{{ asset('/recursos/admin/assets/js/pages/custom/education/student/profile.js') }}">
</script>
@endsection
