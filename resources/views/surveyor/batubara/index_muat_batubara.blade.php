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
                    <div class="card card-custom gutter-b">
                        <div class="card-header bg-color-navy">
                            <div class="card-title">
                                <h3 class="card-label text-white">{{$judul}}</h3>
                            </div>
                            <div class="card-toolbar">
                                <ul class="nav nav-light-success nav-bold nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_4_1">
                                            <span class="nav-icon"><i class="flaticon-danger"></i></span>
                                            <span class="nav-text text-white">Belum Selesai</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_2">
                                            <span class="nav-icon"><i class="flaticon2-check-mark"></i></span>
                                            <span class="nav-text text-white">Sudah Selesai</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_tab_pane_4_1" role="tabpanel" aria-labelledby="kt_tab_pane_4_1">
                                    <div class="col-xl-12">
                                        <div class="table-responsive">
                                            <div class="table-responsive" style="margin-top:20px;">
                                                <table class="table table-bordered provisional" id="users-table">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th>No</th>
                                                            <th>Nomor Transaksi</th>
                                                            <th>Tanggal Pengkapalan</th>
                                                            <th>Nama Perusahaan</th>
                                                            <th>Nama {{$kategori}}</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_4_2" role="tabpanel" aria-labelledby="kt_tab_pane_4_2">
                                    <br /></hr>
                                    <div class="col-xl-12">
                                        <div class="table-responsive">
                                            <div class="table-responsive" style="margin-top:20px;">
                                                <table class="table table-bordered provisional" id="users-table-final">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th>No</th>
                                                            <th>Nomor Transaksi</th>
                                                            <th>Tanggal Pengkapalan</th>
                                                            <th>Nama Perusahaan</th>
                                                            <th>Nama {{$kategori}}</th>
                                                            <th style="width: 14%;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
                <div class="row" id="loader_detail" style="display:none;">
                    <span class="spinner spinner-primary spinner-lg"></span>
                </div>
                <div id="body_detail"></div>
            </div>
            <div class="modal-footer" id="modal_footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return hideDetail('detail')">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modal_dokumen" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Verifikasi Dokumen</h2>
            </div>
            <div class="modal-body" id="body_modal_dokumen">
                <div class="row" id="loader_dokumen" style="display:none;">
                    <span class="spinner spinner-primary spinner-lg"></span>
                </div>
                <div id="body_dokumen"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return hideDetail('dokumen')">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modal_tongkang" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Verifikasi Tongkang</h2>
            </div>
            <div class="modal-body" id="body_modal_tongkang">
                <div class="row" id="loader_tongkang" style="display:none;">
                    <span class="spinner spinner-primary spinner-lg"></span>
                </div>
                <div id="body_tongkang"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return hideDetail('tongkang')">Tutup</button>
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
        language: {
            "processing": "<div class='spinner spinner-dark spinner-center spinner-lg'></div>",
        },
        columns: [{
                data: "no",
                name: "no",
                width: "1%"
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
                name: "pembeli",

            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: "14%"
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

    var table2 = $('#users-table-final').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{$url_final}}",
        language: {
            "processing": "<div class='spinner spinner-dark spinner-center spinner-lg'></div>",
        },
        columns: [{
                data: "no",
                name: "no",
                width: "1%"
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
                name: "pembeli",

            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: "14%"
            }
        ],
        initComplete: function() {
            $('#users-table-final thead tr').clone(true).appendTo('#users-table-final thead');
            $('#users-table-final thead tr:eq(1) th').each(function(i) {
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
        Swal.fire('Berhasil Memverifikasi Data', '', 'error');
        @endif
        @if(session('success-upload-lhv'))
        Swal.fire('Berhasil Memverifikasi Data', '', 'error');
        @endif
    });


    function showDetail(data) {

        $('#modal_detail').modal('show');
        $.ajax({
            url: "{{route('surveyors.detail_modal_moms')}}",
            data: {
                id_pemasaran: data
            },
            beforeSend: function() {
                $('#loader_detail').show();
            },
            complete: function() {
                $('#loader_detail').hide();
            },
            success: function(data) {
                $('#body_detail').html(data);
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
    }

    function verifdokumenbayar(data, url1, url2) {
        $('#modal_dokumen').modal('show');
        $.ajax({
            url: "{{route('surveyors.verifikator.verif_dokumen')}}",
            data: {
                id_pemasaran: data
            },
            beforeSend: function() {
                $('#loader_dokumen').show();
            },
            complete: function() {
                $('#loader_dokumen').hide();
            },
            success: function(data) {
                $('#body_dokumen').html(data);
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

    function hideDetail(item) {
        if (item == 'tongkang') {
            $('#body_tongkang').remove();
            $('#body_modal_tongkang').html('<div id="body_tongkang"></div>')
        } else if (item == 'dokumen') {
            $('#body_dokumen').remove();
            $('#body_modal_dokumen').html('<div id="body_dokumen"></div>')
        } else if (item == 'detail') {
            $('#body_detail').remove();
            $('#body_modal_detail').html('<div id="body_detail"></div>')
        } else if (item == 'verifikasi') {
            $('#body_verifikasi').remove();
            $('#body_modal_verifikasi').html('<div id="body_verifikasi"></div>')
        } else {}

    }
</script>

<script>
    function preview() {
        var id_pemasaran_bb = $('#id_pemasaran_bb').val();
        var nomor = $('#no_tongkang').val();
        var volume = $('#volume').val();
        var no_lhv = $('#no_lhv').val();
        var nama_tongkang = $('#nama_tongkang').val();
        var nama_tugboat = $('#tugboat').val();
        var tanggal = $('#tgl_lhv').val();
        var id_detail = $('#id_detail').val();

        $.ajax({
            url: "{{route('surveyors.preview.modal')}}",
            type: "get",
            data: {
                id_pemasaran_bb: id_pemasaran_bb,
                volume: volume,
                no_lhv: no_lhv,
                tongkang: nama_tongkang,
                tugboat: nama_tugboat,
                tanggal: tanggal,
                _token: "{{ csrf_token() }}"
            },

            success: function(data) {
                $('#preview').html(data);
                $('#preview_btn').hide();
                $('#close_btn').show();
            }
        });

    }

    function close_btn() {
        $('#preview').remove();
        $('#preview_id').html('<div id="preview"></div>');
        $('#close_btn').hide();
        $('#preview_btn').show();
    }
</script>
<script>
    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }
    $('#tgl_lhv').datepicker({
        rtl: KTUtil.isRTL(),
        orientation: "auto bottom",
        todayHighlight: true,
        templates: arrows,
        format: "dd/mm/yyyy"
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
</script>
@endsection