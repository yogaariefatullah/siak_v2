@extends('template.backend.main')
@section('css')
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
        <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2"></div>
            <div class="d-flex align-items-center flex-wrap">
            </div>

        </div>
    </div>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-1">
                    <!--begin::Tiles Widget 1-->

                    <!--end::Tiles Widget 1-->
                </div>
                <div class="col-xl-10">
                    <!--begin::Mixed Widget 20-->
                    <div class="row">
                        <h2>Dashboard</h2>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card card-custom wave wave-animate wave-primary mb-8 mb-lg-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center p-5">
                                        <div class="mr-12">
                                            <span class="svg-icon svg-icon-primary svg-icon-4x">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                                Jumlah Transaksi di Titik Muat Batubara
                                            </a>
                                            <div class="text-dark-75">
                                                <?php
                                                $id_surveyor = (!empty(Auth::guard('surveyors')->user()->id_perusahaan_surveyor)) ? Auth::guard('surveyors')->user()->id_perusahaan_surveyor : Auth::guard('surveyors')->user()->uuid;
                                                ?>
                                                {{get_total_titik_muat_dashboard($id_surveyor)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card card-custom wave wave-animate wave-primary mb-8 mb-lg-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center p-5">
                                        <div class="mr-12">
                                            <span class="svg-icon svg-icon-primary svg-icon-4x">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                                Jumlah Transaksi di Titik Serah Batubara
                                            </a>
                                            <div class="text-dark-75">
                                            {{get_total_titik_serah_dashboard($id_surveyor)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::guard('surveyors')->user()->mineral == true)
                    <br />
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card card-custom wave wave-animate-slow wave-warning mb-8 mb-lg-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center p-5">
                                        <div class="mr-12">
                                            <span class="svg-icon svg-icon-warning svg-icon-4x">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                                Jumlah Transaksi di Titik Muat Mineral
                                            </a>
                                            <div class="text-dark-75">
                                            {{get_total_titik_muat_dashboard_mn($id_surveyor)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card card-custom wave wave-animate-slow wave-warning mb-8 mb-lg-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center p-5">
                                        <div class="mr-12">
                                            <span class="svg-icon svg-icon-warning svg-icon-4x">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-dark text-hover-primary font-weight-bold font-size-h4 mb-3">
                                                Jumlah Transaksi di Titik Serah Mineral
                                            </a>
                                            <div class="text-dark-75">
                                            {{get_total_titik_serah_dashboard_mn($id_surveyor)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-xl-1">
                </div>
            </div>
            <div class="row">

            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
@endsection
@section('javascript')
@endsection