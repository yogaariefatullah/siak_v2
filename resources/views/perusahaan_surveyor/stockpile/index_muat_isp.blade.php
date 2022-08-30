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
                <div class="col-xl-12">
                    <div class="card card-custom gutter-b" id="kt_card_3">
                        <div class="card-header bg-color-navy">
                            <div class="card-title">
                                <h3 class="card-label text-white">
                                    Verifikasi ISP
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-primary mr-1" data-card-tool="toggle">
                                    <i class="ki ki-arrow-down icon-nm"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-success mr-1" data-card-tool="reload">
                                    <i class="ki ki-reload icon-nm"></i>
                                </a>
                            </div>
                        </div>

                        <div class="card-body" style="background-color: whitesmoke;">
                            <div class="table-responsive">
                                <div class="table-responsive" style="margin-top:20px;">
                                    <table class="table table-bordered provisional" id="users-table">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Nomor Transaksi</th>
                                                <th>Tanggal Pengkapalan</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Stockpile</th>
                                                <th>Aksi</th>
                                        </thead>
                                    </table>
                                </div>
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
<div class="modal fade bs-example-modal-lg" id="modal_detail" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Detail Transaksi</h2>
            </div>
            <div class="modal-body" id="body_modal_detail">
                <div class="row" id="detail" style="display:none;">
                    <span class="spinner spinner-primary spinner-lg"></span> Mohon Tunggu ...
                </div>
                <div id="body-content"></div>
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
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('surveyors.isp_data') }}",
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
                data: "tanggal",
                name: "tanggal"
            },
            {
                data: "penjual",
                name: "penjual"
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
                width: "5%"
            }
        ],
        initComplete: function() {
            $('#users-table thead tr').clone(true).appendTo('#users-table thead');
            $('#users-table thead tr:eq(1) th').each(function(i) {
                var title = $(this).text();
                if (i == 1 || i == 2 || i == 3 || i == 4) {
                    $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');

                    $('input', this).on('keyup change', function() {
                        if (table.column(i).search() !== this.value) {
                            table
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });
                } else {
                    $(this).html('');
                }

            });

        }
    });
</script>
<script>
    $(function() {

        @if(session('msg'))
        swal({
            text: "Berhasil memverifikasi data",
            icon: "success",
            buttons: false,
            timer: 4000,
            closeOnClickOutside: false
        });
        @endif
        @if(session('success-upload-lhv'))
        swal({
            text: "Berhasil menyimpan dokumen lhv",
            icon: "success",
            buttons: false,
            timer: 4000,
            closeOnClickOutside: false
        });
        @endif

        $('#tgl_lhv').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy-mm-dd'
        });

        $('#tgl_lhv_vessel').datepicker({
            todayHighlight: true,
            autoclose: true,
            format: 'yyyy-mm-dd'
        });

        $('form#verifikasi-tongkang').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('.mask').show();
                    $('#loader').show();
                },
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#verifikasi_tongkangx').modal('hide');
                    $('.mask').hide();
                    $('#loader').hide();
                    refresh();

                    swal({
                        text: "Berhasil Verifikasi",
                        icon: "success",
                        buttons: false,
                        timer: 4000,
                        closeOnClickOutside: false
                    });
                    table.ajax.reload();
                    refresh();
                },
                error: function(data) {

                    $('#verifikasi_tongkangx').modal('hide');
                    $('.mask').hide();
                    $('#loader').hide();
                    swal({
                        text: "Gagal verifikasi",
                        icon: "error",
                        buttons: false,
                        timer: 4000,
                        closeOnClickOutside: false
                    });
                    table.ajax.reload();
                    refresh();
                }
            });
        });

        $('form#verif_buktibayar').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{url('surveyor/update_status_bayar')}}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('.mask').show();
                    $('#loader').show();
                },
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#modal_buktibayar').modal('hide');
                    $('.mask').hide();
                    $('#loader').hide();
                    swal({
                        text: "Berhasil Unggah Dokumen",
                        icon: "success",
                        buttons: false,
                        timer: 4000,
                        closeOnClickOutside: false
                    });
                    table.ajax.reload();

                },
                error: function(data) {

                    $('#modal_buktibayar').modal('hide');
                    $('.mask').hide();
                    $('#loader').hide();
                    swal({
                        text: "Gagal Unggah Dokumen",
                        icon: "error",
                        buttons: false,
                        timer: 4000,
                        closeOnClickOutside: false
                    });
                    table.ajax.reload();

                }
            });


        });
    });

    function showDetail(data) {

        $('#modal_detail').modal('show');
        $('.body-content').show();
        $.ajax({
            url: "{{route('surveyors.detail_modal_moms')}}",
            data: {
                id_pemasaran: data
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

    function refresh() {
        setTimeout(function() {
            location.reload()
        }, 100);
    }

    function hideDetail() {
        $('.detail-content').hide();
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