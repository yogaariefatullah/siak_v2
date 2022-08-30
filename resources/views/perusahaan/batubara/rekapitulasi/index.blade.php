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
                                    Rekapitulasi Inventori
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
                                            <th style="text-align: center;" width="5%">Aksi</th>
                                            <th style="text-align: center;">Nama Perusahaan</th>
                                            <th style="text-align: center;">Jenis Perusahaan</th>
                                            <th style="text-align: center;" width="20%">Sisa Volume</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $bal)
                                        <tr>
                                            <?php $encode = base64_encode($bal['id_perusahaan']); ?>

                                            <td>
                                                <center>
                                                    <a href="detail_inventori/{{$encode}}" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></a>
                                                </center>
                                            </td>
                                            <td style="text-align: justify;">{{$bal['nama_perusahaan']}}</td>
                                            <td style="text-align: justify;">{{$bal['jenis_perusahaan']}}</td>

                                            <td style="text-align: right;"> {{number_format($bal['volume'],4,",",".")}} <b>Ton</b></td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="font-weight: bold;">
                                            <td></td>
                                            <td>Total</td>
                                            <td style="text-align: right;">{{number_format($total,4,",",".")}} Ton</td>
                                        </tr>
                                    </tfoot>
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