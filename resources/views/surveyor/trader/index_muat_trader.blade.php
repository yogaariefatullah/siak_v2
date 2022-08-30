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
                                    Verifikasi LHV IUP OPK
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
                                                <th>Nama Pembeli</th>
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
<div class="modal fade bs-example-modal-lg" id="modal_upload" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Unggah Dokumen LHV</h2>
            </div>
            <form class="form-horizontal" action="{{route('surveyors.upload_lhv_trader')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body" id="body_modal_upload">
                    <div class="row" id="upload" style="display:none;">
                        <span class="spinner spinner-primary spinner-lg"></span> Mohon Tunggu ...
                    </div>
                    <div id="body-upload"></div>
                </div>
            </form>
        </div>
    </div>
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
    $(document).ready(function() {
        $('#users-table thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#users-table thead');
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            orderCellsTop: true,
            fixedHeader: true,
            ajax: "{{route('surveyors.verifikator.trader_data') }}",
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
                    width: "15%"
                }
            ],
            initComplete: function() {
                var api = this.api();
                // For each column
                api.columns().eq(0).each(function(colIdx) {
                    if (colIdx == 1 || colIdx == 2 || colIdx == 3 || colIdx == 4) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" class="form-control" placeholder=" Cari ' + title + '" />');
                        // On every keypress in this input
                        $('input', $('.filters th').eq($(api.column(colIdx).header()).index())).off('keyup change').on('keyup change', function(e) {
                            e.stopPropagation();
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api.column(colIdx).search(this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))') : '', this.value != '', this.value == '').draw();

                            $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
                        });
                    } else {
                        $(cell).html('');
                    }

                });

            }
        });
    });
</script>
<script>
    $(function() {

        @if(session('msg'))
        Swal.fire("{{session('msg')}}", '', 'success');
        @endif
        @if(session('success-upload-lhv'))
        Swal.fire("{{session('msg')}}", '', 'error');
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
            url: "{{route('surveyors.detail_modal_trader')}}",
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

    function unggah_dokumen(data) {
        $('#modal_upload').modal('show');
        $('.body-upload').show();
        $.ajax({
            url: "{{route('surveyors.upload_dokumen_lhv.trader')}}",
            data: {
                id_pemasaran: data
            },
            beforeSend: function() {
                $('#upload').show();
            },
            complete: function() {
                $('#upload').hide();
            },
            success: function(data) {
                $('#body-upload').html(data);
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
            table.ajax.reload();
        }, 2000);
    });
</script>
@endsection