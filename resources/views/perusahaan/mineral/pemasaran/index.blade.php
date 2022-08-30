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
                                    Realisasi Pemasaran
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-primary mr-1" data-card-tool="toggle">
                                    <i class="ki ki-arrow-down icon-nm"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-success mr-1" data-card-tool="reload">
                                    <i class="ki ki-reload icon-nm"></i>
                                </a>
                                <button onclick="add_pemasaran('{{Auth::guard('traders')->user()->id_perusahaan}}')" class="btn btn-icon btn-circle btn-sm btn-light-danger" data-items="">
                                    <i class="ki ki-plus icon-nm"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body" style="background-color: whitesmoke;">
                            <div class="table-responsive">
                                <table class="table table-datatable table-custom" id="advancedDataTable">
                                    <thead>
                                        <tr>
                                            <th class="sort-numeric">Tanggal</th>
                                            <th>No. Refrensi</th>
                                            <th class="sort-alpha">Titik Serah</th>
                                            <th>Nama Kapal/ Vessel</th>
                                            <th>Kategori Pembeli</th>
                                            <th>Nama Pembeli</th>
                                            <th width="150px">
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
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Detail Pemasaran</h2>
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
<div class="modal fade bs-example-modal-lg" id="modal_add" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Tambah Pemasaran</h2>
            </div>
            <div class="modal-body" id="body_modal_add">
                <div class="row" id="add" style="display:none;">
                    <button class="btn btn-sm btn-success"><span class="fa fa-refresh fa-refresh-animate"></span>
                        Loading...</button>
                </div>
                <div id="body-contents"></div>
            </div>
            <div class="modal-footer" id="modal_footer">

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
            ajax: "{{route('traders.pemasaran.mineral.data_pemasaran')}}",
            columns: [{
                    data: "date",
                    name: "date"
                },
                {
                    data: "id_transaksi",
                    name: "id_transaksi"
                },

                {
                    data: "provinsi_pelabuhan",
                    name: "provinsi_pelabuhan"
                },
                {
                    data: "nama_kapal",
                    name: "nama_kapal"
                },
                {
                    data: "kategori",
                    name: "kategori"
                },
                {
                    data: "pembeli",
                    name: "pembeli"
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
            url: "{{route('traders.pemasaran.mineral.detail_pemasaran')}}",
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

    function add_pemasaran(data) {

        $('#modal_add').modal('show');
        $('.body-contents').show();
        $.ajax({
            url: "{{route('traders.pemasaran.mineral.add_pemasaran')}}",
            data: {
                id_perusahaan: data
            },
            beforeSend: function() {
                $('#add').show();
            },
            complete: function() {
                $('#add').hide();
            },
            success: function(data) {
                $('#body-contents').html(data);
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
    }

    function hide_add() {
        $('.body-content').remove();
        $('#body_modal_detail').html('<div class="body-content"></div>')
    }
</script>
<script>
    // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
    var card = new KTCard('kt_card_3');

    // Toggle event handlers
    card.on('beforeCollapse', function(card) {
        setTimeout(function() {
            // toastr.info('Before collapse event fired!');
        }, 100);
    });

    card.on('afterCollapse', function(card) {
        setTimeout(function() {
            // toastr.warning('Before collapse event fired!');
        }, 2000);
    });

    card.on('beforeExpand', function(card) {
        setTimeout(function() {
            // toastr.info('Before expand event fired!');
        }, 100);
    });

    card.on('afterExpand', function(card) {
        setTimeout(function() {
            // toastr.warning('After expand event fired!');
        }, 2000);
    });
    card.on('reload', function(card) {
        // toastr.info('Leload event fired!');

        KTApp.block(card.getSelf(), {
            overlayColor: '#ffffff',
            type: 'loader',
            state: 'primary',
            opacity: 0.3,
            size: 'lg'
        });
        setTimeout(function() {
            KTApp.unblock(card.getSelf());
        }, 2000);
    });
</script>
@endsection