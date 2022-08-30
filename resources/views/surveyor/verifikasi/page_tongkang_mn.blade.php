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
        <div class="container">
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
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-primary mr-2" data-card-tool="toggle">
                                    <i class="ki ki-arrow-down icon-nm"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-success mr-2" data-card-tool="reload">
                                    <i class="ki ki-reload icon-nm"></i>
                                </a>
                                <a href="{{$url_back}}" title="Kembali" class="btn btn-sm btn-light-danger mr-2">
                                    <i class="fas fa-angle-double-left"></i>&nbsp;&nbsp; Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body" style="background-color: whitesmoke;">
                            @foreach($pemasaran as $item)
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless table-responsive-lg">
                                        <tr>
                                            <th>Tanggal</th>
                                            <td>:</td>
                                            <td>{{tgl_indo(date('Y-m-d', strtotime($item->date)))}}</td>
                                        </tr>

                                        <tr>
                                            <th>No.Transaksi</th>
                                            <td>:</td>
                                            <td>{{$item->id_transaksi}}</td>

                                        </tr>

                                        <tr>
                                            <th>Penjual</th>
                                            <td>:</td>
                                            <td>
                                                {{get_nama_perusahaan_moms($item->pelapor)}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                @if($item->kategori_pembeli == 2)
                                                Nama Pembeli
                                                @elseif($item->kategori_pembeli == 1)
                                                Nama Pembeli
                                                @elseif($item->kategori_pembeli == 5)
                                                Stockpile
                                                @else
                                                -
                                                @endif
                                            </th>
                                            <td>:</td>
                                            <td>
                                                @if($item->kategori_pembeli == 2)
                                                {{get_nama_master_pembeli_moms($item->id_masterpembeli)}}
                                                @elseif($item->kategori_pembeli == 1)
                                                {{get_nama_trader($item->id_masterpembeli)}}
                                                @elseif($item->kategori_pembeli == 5)
                                                {{get_nama_stockpile($item->id_masterpembeli)}}
                                                @else
                                                -
                                                @endif
                                            </td>

                                        </tr>

                                        <tr>
                                            <th>Pelabuhan Asal</th>
                                            <td>:</td>
                                            <td>{{$item->pelabuhan_asal}}</td>
                                        </tr>

                                        <tr>
                                            <th>Pelabuhan Tujuan</th>
                                            <td>:</td>
                                            <td>{{$item->pelabuhan_tujuan}}</td>
                                        </tr>

                                        <tr>
                <th>Nama Produk</th>
                <td>:</td>
                <td>{{get_produk_id($item->id_produk)}}</td>
            </tr>
                                    </table>

                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless table-responsive-lg">
                                        <tr>
                                            <th>Nama Kapal</th>
                                            <td>:</td>
                                            <td>{{$item->nama_kapal}}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Penjualan</th>
                                            <td>:</td>
                                            <td>{{($item->jenis_penjualan == '325404be-6885-4fac-ac8f-fedbc28e0efd'? 'Domestik' : 'Ekspor')}}</td>
                                        </tr>

                                        <tr>
                                            <th>Mata Uang</th>
                                            <td>:</td>
                                            <td>{{$item->mata_uang}}</td>
                                        </tr>

                                        <tr>
                                            <th>Volume Induk</th>
                                            <td>:</td>
                                            <td>{{number_format($item->volume, 2, ",", ".")}}  {{$item->uom}}</td>
                                        </tr>

                                        <tr>
                                            <th>Jarak Barging</th>
                                            <td>:</td>
                                            <td>{{number_format($item->jarak_barging, 2, ",", ".")}}</td>
                                        </tr>

                                        <tr>
                                            <th>Harga Jual</th>
                                            <td>:</td>
                                            <td>{{number_format($item->harga_jual, 2, ",", ".")}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br />

                            <?php
                            $no_transaksi  = $item->id_transaksi;
                            $id_pemasaran = $item->id_pemasaran_mn;
                            // $status_edit_lhv = $item->status_admin_edit_lhv;
                            $verified = 0;
                            $status_surveyor = $item->status_surveyor;
                            $final = cek_double_transaksi_mn($item->id_transaksi);
                            ?>
                            @endforeach
                            <br />
                            @if(count($tongkang) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-light table-responsive-lg rounded">
                                        <caption>Data Tongkang</caption>
                                        <thead class="thead-dark">
                                            <tr style="text-align: center;">
                                                <th>No.</th>
                                                <th>Nama Alat Transportasi</th>
                                                <th>Volume</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tongkang as $tkg)
                                            <tr style="text-align: center;">
                                                <td>{{$tkg->no_tongkang}}</td>
                                                <td>{{$tkg->nama_tongkang}} / <b>{{$tkg->tag_boat}}</b></td>
                                                <td>{{number_format($tkg->volume,2,',','.')}}  {{$item->uom}}</td>
                                                <td>
                                                    @if ($final == 1)
                                                    @if(empty($tkg->deleted_at))
                                                    @if(empty($tkg->no_lhv))
                                                    <?php $verified = $verified - 1; ?>
                                                    <a onclick="return verifikasi_tongkang('{{$tkg->id_detail}}')" class="btn bg-color-orange btn-icon btn-icon-white btn-sm" title="Verifikasi Tongkang"><i class="fas fa-check"></i></a>&nbsp;
                                                    <button onclick="return hapus_tongkang('{{$tkg->id_detail}}')" class="btn btn-danger btn-icon btn-sm" title="Hapus Tongkang"><i class="fa fa-times"></i></button>
                                                    @else
                                                    <?php $verified = $verified + 1; ?>
                                                    @if($status_surveyor == 1)
                                                    @if(empty($tkg->status_cetak))
                                                    <a href="{{route('surveyors.verifikator.print_lhv_tongkang_mn',base64_encode($tkg->id_detail))}}" target="_blank" rel="noopener noreferrer" class="btn bg-color-purple btn-icon btn-icon-white btn-sm" title="Cetak LHV"><i class="fa fa-print"></i></a>&nbsp;
                                                    @else
                                                    <a href="{{route('surveyors.verifikator.print_lhv_tongkang_mn',base64_encode($tkg->id_detail))}}" target="_blank" rel="noopener noreferrer" class="btn bg-color-purple btn-icon btn-icon-white btn-sm" title="Cetak LHV"><i class="fa fa-print"></i></a>&nbsp;
                                                    <a onclick="return verifikasi_tongkang('{{$tkg->id_detail}}')" class="btnbg-color-orange btn-icon btn-icon-white btn-sm" title="Verifikasi Tongkang"><i class="fas fa-check"></i></a>&nbsp;
                                                    @endif
                                                    @else
                                                    @if(empty($tkg->status_cetak))
                                                    <a href="{{route('surveyors.verifikator.print_lhv_tongkang_mn',base64_encode($tkg->id_detail))}}" target="_blank" rel="noopener noreferrer" class="btn bg-color-purple btn-icon btn-icon-white btn-sm" title="Cetak LHV"><i class="fa fa-print"></i></a>&nbsp;
                                                    @else
                                                    <a href="{{route('surveyors.verifikator.print_lhv_tongkang_mn',base64_encode($tkg->id_detail))}}" target="_blank" rel="noopener noreferrer" class="btn bg-color-purple btn-icon btn-icon-white btn-sm" title="Cetak LHV"><i class="fa fa-print"></i></a>&nbsp;
                                                    <a onclick="return verifikasi_tongkang('{{$tkg->id_detail}}')" class="btnbg-color-orange btn-icon btn-icon-white btn-sm" title="Verifikasi Tongkang"><i class="fas fa-check"></i></a>&nbsp;
                                                    @endif
                                                    @endif
                                                    @endif
                                                    @else
                                                    DITOLAK
                                                    @endif
                                                    @else
                                                    <button type="button" class="btn btn-icon btn-outline-warning" data-toggle="popover" data-trigger="click" data-html="true" data-content="Ditemukan Data Pemasaran Dengan <b>Nomor Referensi</b> yang sama,<br/> Mohon Hubungi Penjual Untuk Konfirmasi">
                                                        <i class="flaticon-questions-circular-button"></i>
                                                    </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
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
<div class="modal fade bs-example-modal-lg" id="modal_verifikasi" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Verifikasi Tongkang</h2>
            </div>
            <form id="form_verif_tongkang" action="{{route('surveyors.tongkang.mn.accept')}}" method="post">
                <div class="modal-body" id="body_modal_verifikasi">
                    {{csrf_field()}}
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">Volume</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control volume" required autocomplete="off" name="volume" id="volume">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">Jenis Kendaraan</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required autocomplete="off" name="nama_tongkang" id="nama_tongkang">
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" autocomplete="off" name="volume_asli" id="volume_asli">
                                <input type="hidden" class="form-control" autocomplete="off" name="vol_cam" id="vol_cam">
                                <input type="hidden" class="form-control" autocomplete="off" name="id_pemasaran_mn" id="id_pemasaran_mn">
                                <input type="hidden" class="form-control" autocomplete="off" name="status_hapus" id="status_hapus">
                                <input type="hidden" class="form-control" autocomplete="off" name="no_tongkang">
                                <input type="hidden" class="form-control" autocomplete="off" name="nomor" id="nomor">
                                <input type="hidden" class="form-control" autocomplete="off" name="id_detail" id="id_detail">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">Nama Tug Boat</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required autocomplete="off" name="nama_tugboat" id="tugboat">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 control-label">No.LHV</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required autocomplete="off" name="no_lhv" id="no_lhv">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="datepicker" class="col-sm-3 control-label">Tanggal</label>
                                    <div class="col-sm-6">
                                        <!-- <input class="form-control" required type="text" name="tgl_lhv" id="tgl_lhv" autocomplete="off"> -->
                                        <div class="input-group date">
                                            <input type="text" class="form-control" required name="tgl_lhv" placeholder="Tanggal LHV" id="tgl_lhv" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <a onclick="preview()" class="btn btn btn-info btn-sm btn-block" id="preview_btn">Preview LHV</a>
                                <a onclick="close_btn()" class="btn btn btn-danger btn-sm btn-block" style="display: none;" id="close_btn">Tutup</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container" id="preview_id" style="border: 1px #000 solid;">
                                    <div id="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm" id="btn_simpan"><i class="fa fa-check-circle"></i>&nbsp;</button>&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('javascript')

<script>
    $(function() {
        $('[data-toggle="popover"]').popover()
    })
    $(function() {
        @if(session('msg'))
        Swal.fire('Berhasil Memverifikasi Data', '', 'error');
        @endif
        @if(session('success-upload-lhv'))
        Swal.fire('Berhasil Memverifikasi Data', '', 'error');
        @endif
    });

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

    function clear() {
        $('#id_pemasaran_mn').val('');
        $('#nama_tongkang').val('');
        $('#volume').val('');
        $('#volume_asli').val('');
        $('#vol_cam').val('');
        $('#id_detail').val('');
        $('#tugboat').val('');
    }

    function verifikasi_tongkang(data) {
        $('#modal_verifikasi').modal('show');
        clear();
        $('#btn_simpan').html('Simpan');
        $.ajax({
            url: "{{route('surveyors.verifikator.verifikasi_data_tongkang.mn')}}",
            data: {
                id_detail: data
            },
            beforeSend: function() {
                $('#loader_verifikasi').show();
            },
            complete: function() {
                $('#loader_verifikasi').hide();
            },
            success: function(data) {
                $('#id_pemasaran_mn').val(data[0].id_pemasaran_mn);
                $('#nama_tongkang').val(data[0].nama_tongkang);
                $('#volume').val(numberFormat(data[0].volume, 4, ',', '.'));
                $('#volume_asli').val(numberFormat(data[0].volume, 4, ',', '.'));
                $('#id_detail').val(data[0].id_detail);
                $('#tugboat').val(data[0].tag_boat);
                $('#status_hapus').val('');
                $('#volume').attr('readonly', false);
                $('#nama_tongkang').attr('readonly', false);
                $('#tugboat').attr('readonly', false);
                $('#tgl_lhv').attr('readonly', false);
                $('#no_lhv').attr('readonly', false);
                $('#preview_btn').show();
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
    }

    function hapus_tongkang(data) {
        $('#modal_verifikasi').modal('show');
        clear();
        $('#btn_simpan').html('Hapus');
        $.ajax({
            url: "{{route('surveyors.verifikator.verifikasi_data_tongkang.mn')}}",
            data: {
                id_detail: data
            },
            beforeSend: function() {
                $('#loader_verifikasi').show();
            },
            complete: function() {
                $('#loader_verifikasi').hide();
            },
            success: function(data) {
                $('#id_pemasaran_mn').val(data[0].id_pemasaran_mn);
                $('#nama_tongkang').val(data[0].nama_tongkang);
                $('#volume').val(numberFormat(data[0].volume, 4, ',', '.'));
                $('#volume_asli').val(numberFormat(data[0].volume, 4, ',', '.'));
                $('#id_detail').val(data[0].id_detail);
                $('#tugboat').val(data[0].tag_boat);

                $('#status_hapus').val('true');
                $('#volume').attr('readonly', true);
                $('#nama_tongkang').attr('readonly', true);
                $('#tugboat').attr('readonly', true);
                $('#tgl_lhv').attr('readonly', true);
                $('#no_lhv').attr('readonly', true);
                $('#preview_btn').hide();
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

<script>
    function preview() {
        var id_pemasaran_mn = $('#id_pemasaran_mn').val();
        var nomor = $('#no_tongkang').val();
        var volume = $('#volume').val();
        var no_lhv = $('#no_lhv').val();
        var nama_tongkang = $('#nama_tongkang').val();
        var nama_tugboat = $('#tugboat').val();
        var tanggal = $('#tgl_lhv').val();
        var id_detail = $('#id_detail').val();
        if ($('#no_lhv').val() != '' && $('#tgl_lhv').val() != '') {
            $.ajax({
                url: "{{route('surveyors.preview.modal.mn')}}",
                type: "get",
                data: {
                    id_pemasaran_mn: id_pemasaran_mn,
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
        } else {
            if ($.trim($('#tgl_lhv').val()) == '') {
                $('#tgl_lhv').addClass('is-invalid');
            } else {
                $('#tgl_lhv').removeClass('is-invalid');
            }

            if ($.trim($('#no_lhv').val()) == '') {
                $('#no_lhv').addClass('is-invalid');
            } else {
                $('#no_lhv').removeClass('is-invalid');
            }
        }
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