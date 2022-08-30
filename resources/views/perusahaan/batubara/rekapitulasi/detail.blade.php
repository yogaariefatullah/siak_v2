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

            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-custom gutter-b" id="kt_card_3">
                        <div class="card-header bg-color-navy">
                            <div class="card-title">
                                <h3 class="card-label text-white">
                                    Rekapitulasi Inventori Dari Perusahaan  : <strong>{{$nama}}</strong>
                                </h3>
                            </div>
                            <div class="card-toolbar">

                            </div>
                        </div>

                        <div class="card-body" style="background-color: whitesmoke;">
                            <div class="table-responsive">
                                <table class="table table-datatable table-custom" id="advancedDataTable">
                                    <thead>
                                        <tr>
                                            <th>Nomor Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Volume Total (Ton)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datapembelian as $bal)
                                        <tr>
                                            <td>{{$bal->id_transaksi}}</td>
                                            <td>{{$bal->created_at}} </td>
                                            <td>BELI</td>
                                            <td>{{number_format($bal->volume,4,",",".")}}</td>
                                        </tr>
                                        @endforeach

                                        @foreach ($getdatapemasaran as $xx)
                                        <tr>
                                            <td>{{$xx->id_transaksi}}</td>
                                            <td>{{$xx->created_at}}</td>
                                            <td>JUAL</td>
                                            <td> {{number_format($xx->volume,4,",",".")}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection
@section('javascript')

<script>
    $('#advancedDataTable').DataTable();
</script>

@endsection