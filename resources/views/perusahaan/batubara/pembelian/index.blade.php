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
                    <div class="card card-custom gutter-b">
                        <div class="card-header bg-color-navy">
                            <div class="card-title">
                                <h3 class="card-label text-white">
                                    Realisasi Pembelian
                                </h3>
                            </div>
                        </div>
                        <div class="card-body" style="background-color: whitesmoke;">
                            <div class="table-responsive">
                                <table class="table table-datatable table-custom" id="advancedDataTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                <center>No</center>
                                            </th>
                                            <th>
                                                <center>No. Transaksi</center>
                                            </th>
                                            <th>
                                                <center>Nama Penjual</center>
                                            </th>
                                            <th>
                                                <center>Volume</center>
                                            </th>
                                            <th>
                                                <center>Nilai Invoice</center>
                                            </th>
                                            <th>
                                                <center>Jenis Penjual</center>
                                            </th>
                                            <th>
                                                <center>Aksi</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
<div class="modal fade bs-example-modal-lg" id="modal_detail" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Detail Pembelian</h2>
            </div>
            <div class="modal-body" id="body_modal_detail">
                <div class="row" id="detail" style="display:none;">
                    <button class="btn btn-sm btn-success"><span class="fa fa-refresh fa-refresh-animate"></span>
                        Loading...</button>
                </div>
                <div class="body-content"></div>
            </div>
            <div class="modal-footer" id="modal_footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return hideDetail()">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')

<script>
    // $('#advancedDataTable').DataTable();
    $(function() {

        var table = $('#advancedDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('traders.pembelian.batubara.data_pembelian')}}",
            columns: [{
                    data: "no",
                    name: "no",
                    width: "3%"
                },
                {
                    data: "id_transaksi",
                    name: "id_transaksi"
                },
                {
                    data: "penjual",
                    name: "penjual"
                },
                {
                    data: "volume",
                    name: "volume"
                },
                {
                    data: "nilai_invoice",
                    name: "nilai_invoice"
                },
                {
                    data: "status_transaksi",
                    name: "status_transaksi"
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: "25%"
                }
            ]
        });

        // //https://www.gyrocode.com/articles/jquery-datatables-column-width-issues-with-bootstrap-tabs/
        // $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        //     $($.fn.dataTable.tables(true)).DataTable()
        //         .columns.adjust();
        // });
    });

    function showDetail(id_pemasaran) {
        $('.body-content').show();
        $.ajax({
            url: "{{route('traders.pembelian.batubara.detail_pemasaran_perusahaan')}}",
            data: {
                id_pemasaran: id_pemasaran
            },
            beforeSend: function() {
                $('#detail').show();
            },
            complete: function() {
                $('#detail').hide();
            },
            success: function(data) {
                $('.body-content').html(data);
                //$('#detail').show();
                //console.log("load data");
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
        $('#modal_detail').modal('show');
    }

    function showtrader(id_pemasaran) {
        $('.body-content').show();
        $.ajax({
            url: "{{route('traders.pembelian.batubara.detail_pemasaran_trader')}}",
            data: {
                id_pemasaran: id_pemasaran
            },
            beforeSend: function() {
                $('#detail').show();
            },
            complete: function() {
                $('#detail').hide();
            },
            success: function(data) {
                $('.body-content').html(data);
                //$('#detail').show();
                //console.log("load data");
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
        $('#modal_detail').modal('show');
    }

    function hideDetail() {
        $('.body-content').remove();
        $('#body_modal_detail').html('<div class="body-content"></div>')
    }
</script>
@endsection