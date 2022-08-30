@extends('template.backend.main')
@section('css')
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
        <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2"></div>
            <div class="d-flex align-items-center flex-wrap">
                @if(Auth::guard('traders')->user()->jenis_komoditas ==
                '1b5f47a9-e6c9-46e2-b957-c113ef39c787')
                <a class="btn btn-lg btn-redbrown pull-right" id="btn-format" href="{{ asset('dokumen-contoh/mvp.pdf') }}" download> Download
                    Petunjuk Pemakaian</a>
                @else
                <a class="btn btn-lg btn-redbrown pull-right" id="btn-format" href="{{ asset('dokumen-contoh/mvp_mineral.pdf') }}" download> Download
                    Petunjuk Pemakaian</a>
                @endif
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
                        <h2>Penjelasan</h2>
                    </div>
                    <br />
                    <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                        <div class="card">
                            <div class="card-header" id="headingOne4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne4">
                                    <i class="flaticon2-layers-1"></i> SK INDUK
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" data-parent="#headingOne4">
                                <div class="card-body">
                                    <p>
                                        SK Kerjasama Dengan IUP Sumber Komoditas (IUP OP/PKP2B/IUP OP Khusus Pengangkutan Penjualan)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseTwo4">
                                    <i class="flaticon2-checking"></i> VERIFIKASI PEMBELIAN
                                </div>
                            </div>
                            <div id="collapseTwo4" class="collapse" data-parent="#headingTwo4">
                                <div class="card-body">
                                    <p>
                                        Verifikasi Data Pemasaran Dari IUP Sumber Komoditas kepada IUP OP Khusus Pengangkutan Penjualan
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseThree4">
                                    <i class="flaticon2-layers-1"></i> PEMBELIAN
                                </div>
                            </div>
                            <div id="collapseThree4" class="collapse" data-parent="#headingThree4">
                                <div class="card-body">
                                    <p>
                                        Data Pemasaran Dari IUP Sumber Komoditas Kepada IUP OP Khusus Pengangkutan
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFour4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseFour4">
                                    <i class="flaticon2-layers-1"></i> PEMASARAN
                                </div>
                            </div>
                            <div id="collapseFour4" class="collapse" data-parent="#headingFour4">
                                <div class="card-body">
                                    <p>
                                        Transaksi Pemasaran Ke Enduser / IUP OP Khusus Pengangkutan Penjualan Lain-nya
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFive4">
                                <div class="card-title" data-toggle="collapse" data-target="#collapseFive4">
                                    <i class="flaticon2-layers-1"></i> REKAPITULASI
                                </div>
                            </div>
                            <div id="collapseFive4" class="collapse" data-parent="#headingFive4">
                                <div class="card-body">
                                    <p>
                                        Inventori IUP OP Khusus Pengangkutan Penjualan
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--end::Mixed Widget 20-->
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