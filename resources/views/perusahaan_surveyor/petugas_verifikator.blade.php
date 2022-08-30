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
                                    Petugas Verifikator
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-primary mr-1" data-card-tool="toggle">
                                    <i class="ki ki-arrow-down icon-nm"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-success mr-1" data-card-tool="reload">
                                    <i class="ki ki-reload icon-nm"></i>
                                </a>
                                <button onclick="add('{{Auth::guard('surveyors')->user()->uuid}}')" class="btn btn-icon btn-circle btn-sm btn-light-danger" data-items="">
                                    <i class="ki ki-plus icon-nm"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body" style="background-color: whitesmoke;">
                            <div class="table-responsive">
                                <table class="table table-datatable table-custom" id="advancedDataTable">
                                    <thead>
                                        <tr>
                                            <th class="sort-numeric">No</th>
                                            <th>No. Sertifikat</th>
                                            <th>Nama</th>
                                            <th>Provinsi</th>
                                            <th>Status</th>
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
<div class="modal fade bs-example-modal-lg" id="modal_add" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Tambah Petugas</h2>
            </div>
            <div class="modal-body" id="body_modal_add">
                <div class="row" id="add" style="display:none;">
                    <button class="btn btn-sm btn-success"><span class="fa fa-refresh fa-refresh-animate"></span>
                        Loading...</button>
                </div>
                <div id="body-contents"></div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modal_detail" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Detail Petugas</h2>
            </div>
            <div class="modal-body" id="body_modal_detail">
                <div class="row" id="detail" style="display:none;">
                    <button class="btn btn-sm btn-success"><span class="fa fa-refresh fa-refresh-animate"></span>
                        Loading...</button>
                </div>
                <div id="body-content"></div>
            </div>
            <div class="modal-footer" id="modal_footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return hideDetail()">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modal_edit" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Ubah Petugas</h2>
            </div>
            <div class="modal-body" id="body_modal_edit">
                <div class="row" id="edit" style="display:none;">
                    <button class="btn btn-sm btn-success"><span class="fa fa-refresh fa-refresh-animate"></span>
                        Loading...</button>
                </div>
                <div id="body-contentedit"></div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script>
    var table = $('#advancedDataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('surveyors.petugas.data_petugas')}}",
        columns: [{
                data: "DT_RowIndex",
                name: "DT_RowIndex"
            },
            {
                data: "no_sertifikat",
                name: "no_sertifikat"
            },
            {
                data: "nama",
                name: "nama"
            },
            {
                data: "provinsi",
                name: "provinsi"
            },
            {
                data: "status",
                name: "status"
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

    function add(data) {

        $('#modal_add').modal('show');
        $('.body-contents').show();
        $.ajax({
            url: "{{route('surveyors.petugas.add')}}",
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

    function showDetail(data) {

        $('#modal_detail').modal('show');
        $('.body-content').show();
        $.ajax({
            url: "{{route('surveyors.petugas.detail')}}",
            data: {
                id_petugas: data
            },
            beforeSend: function() {
                $('#detail').show();
            },
            complete: function() {
                $('#detail').hide();
            },
            success: function(data) {
                $('#body-content').html(data);
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
    }

    function edit(id_petugas) {
        $('#modal_edit').modal('show');
        $.ajax({
            url: "{{route('surveyors.petugas.edit')}}",
            data: {
                id_petugas: id_petugas
            },
            beforeSend: function() {
                $('#edit').show();
            },
            complete: function() {
                $('#edit').hide();
            },
            success: function(data) {
                $('#body-contentedit').html(data);
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
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