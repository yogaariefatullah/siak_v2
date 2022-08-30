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
                                    {{$judul}}
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
                                                <th rowspan="2">No</th>
                                                <th rowspan="2">Nomor Transaksi</th>
                                                <th rowspan="2">Tanggal Pengkapalan</th>
                                                <th rowspan="2">Nama Perusahaan</th>
                                                <th rowspan="2">Pembeli</th>
                                                <th colspan="2">Aksi</th>
                                            </tr>
                                            <tr>
                                                <td>COW</td>
                                                <td>COA</td>
                                            </tr>
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
<div class="modal fade" id="lhv_vessel_modal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: blue">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Cetak LHV Vessel</h2>
            </div>
            <div class="modal-body" id="body_modal_vessel">
                <div class="row" id="detail_vessel" style="display:none;">
                    <span class="spinner spinner-primary spinner-lg"></span> Mohon Tunggu ...
                </div>
                <div id="body_vessel"></div>
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
        ajax: "{{$url}}",
        columns: [{
                data: "no",
                name: "no",
                width: "3%"
            },
            {
                data: "id_transaksi",
                name: "id_transaksi",
                width: "15%"
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
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false,
                width: "15%"
            }
        ],

    });
    $('.volume').inputmask({
        alias: "decimal",
        digits: 4,
        repeat: 36,
        digitsOptional: false,
        decimalProtect: true,
        groupSeparator: ".",
        placeholder: '0',
        rightAlign: false,
        radixPoint: ",",
        radixFocus: true,
        autoGroup: true,
        autoUnmask: false,
        onBeforeMask: function(value, opts) {
            return value;
        },
        removeMaskOnSubmit: true
    });
    $('#tgl_lhv_vessel').datepicker({
        todayHighlight: true,
        autoclose: true,
        format: 'yyyy-mm-dd'
    });
</script>
<script>
    $(function() {

        @if(session('msg'))
        Swal.fire('Berhasil Memverifikasi Data', '', 'error');
        @endif
        @if(session('success-upload-lhv'))
            Swal.fire('Berhasil Memverifikasi Data', '', 'error');
        @endif


    });

    function show(id) {
        $('#modal_detail').modal('show');
        $('.body-content').show();
        $.ajax({
            url: "{{route('surveyors.detail_modal_moms')}}",
            data: {
                id_pemasaran: atob(id),
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

    function cetak_vessel(id_pemasaran) {
        $('#lhv_vessel_modal').modal('show');
        $.ajax({
            url: "{{route('surveyors.detail_vessel')}}",
            data: {
                id_pemasaran: id_pemasaran
            },
            beforeSend: function() {
                $('#detail_vessel').show();
            },
            complete: function() {
                $('#detail_vessel').hide();
            },
            success: function(data) {
                $('#body_vessel').html(data);
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
    }

    function confirm() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        Swal.fire({
            title: 'Apakah Data yang di Masukan Sudah Benar ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.value) {
                form.submit();
            } else {
                Swal.fire({
                    title: "Batal Simpan Data",
                    type: "error",
                    allowOutsideClick: false,
                })
                // refresh();
            }
        })
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