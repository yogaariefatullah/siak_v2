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
                        <div class="col-xl-4">
                            <div class="card card-custom bgi-no-repeat card-stretch gutter-b bg-dark">
                                <div class="card-body my-4">
                                    <a href="#" class="card-title font-weight-bolder text-info font-size-h6 mb-4 text-hover-state-dark d-block">Total Pengajuan Titik Muat</a>
                                    <div class="font-weight-bold text-muted font-size-sm">
                                        <span class="text-white font-weight-bolder font-size-h1 mr-2">{{number_format(get_total_titik_muat_dashboard(Auth::guard('surveyors')->user()->uuid),0,'','.')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card card-custom bg-info card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body my-4">
                                    <a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Total Pengajuan Titik Serah</a>
                                    <div class="font-weight-bold text-muted font-size-sm">
                                        <span class="text-white font-weight-bolder font-size-h1 mr-2">
                                            {{number_format(get_total_titik_serah_dashboard(Auth::guard('surveyors')->user()->uuid),0,'','.')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(empty(Auth::guard('surveyors')->user()->id_perusahaan_surveyor))
                        <div class="col-xl-4">
                            <div class="card card-custom bg-danger card-stretch gutter-b">
                                <!--begin::Body-->
                                <div class="card-body my-4">
                                    <a href="#" class="card-title font-weight-bolder text-white font-size-h6 mb-4 text-hover-state-dark d-block">Total Petugas Survey</a>
                                    <div class="font-weight-bold text-muted font-size-sm">
                                        <span class="text-white font-weight-bolder font-size-h1 mr-2">{{number_format(get_total_petugas(Auth::guard('surveyors')->user()->uuid),0,'','.')}}</span></div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
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