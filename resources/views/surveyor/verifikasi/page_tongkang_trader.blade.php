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
                                                {{get_nama_trader($item->pelapor)}}
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
                                            <td>{{number_format($item->total_volume, 4, ",", ".")}}</td>
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
                            @if(count($pencampur) > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-light table-responsive-lg rounded">
                                        <caption>Volume Pencampur</caption>
                                        <thead class="thead-dark">
                                            <tr style="text-align: center;">
                                                <th>No</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Volume</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $no = 1; ?>
                                            @foreach($pencampur as $in)
                                            <tr style="text-align: center;">
                                                <td>{{$no++}}</td>
                                                <td> {{(get_nama_trader($in->id_master_pembeli) == '-') ? get_nama_perusahaan_moms($in->id_master_pembeli) : get_nama_trader($in->id_master_pembeli) }}</td>
                                                <td>{{number_format($in->volume, 4, ",", ".")}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    @if(empty($item->no_lhv))
                                    <a onclick="return verifikasi_tongkang('{{$item->id_pemasaran_bb}}')" class="btn bg-color-blue btn-icon-white text-white" title="Verifikasi Tongkang">
                                        <i class="fas fa-check"></i> Verifikasi Pengajuan LHV Pemasaran
                                    </a> &nbsp;&nbsp;&nbsp;
                                    <a onclick="reject('{{$item->id_pemasaran_bb}}','{{$item->id_transaksi}}')" class="btn bg-color-red btn-icon-white text-white" title="Verifikasi Tongkang">
                                        <i class="fas fa-times"></i> Tolak Pengajuan LHV Pemasaran
                                    </a>
                                    @else
                                    <span class="btn btn-outline-info btn-block btn-inline btn-xl" style="cursor: default !important;">Sudah Terverifikasi</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            <br />

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
            <form id="form_verif_tongkang" action="{{route('surveyors.trader.accept')}}" method="post">
                <div class="modal-body" id="body_modal_verifikasi">
                    {{csrf_field()}}
                    <div class="container">
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
                                            {{get_nama_trader($item->pelapor)}}
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
                                        <th>Nama Kapal</th>
                                        <td>:</td>
                                        <td>{{$item->nama_kapal}}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Penjualan</th>
                                        <td>:</td>
                                        <td>{{($item->jenis_penjualan == '325404be-6885-4fac-ac8f-fedbc28e0efd'? 'Domestik' : 'Ekspor')}}</td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless table-responsive-lg">
                                    <tr>
                                        <th>Mata Uang</th>
                                        <td>:</td>
                                        <td>{{$item->mata_uang}}</td>
                                    </tr>
                                    <tr>
                                        <th>Harga Jual</th>
                                        <td>:</td>
                                        <td>{{number_format($item->harga_jual, 2, ",", ".")}}</td>
                                    </tr>
                                    <tr>
                                        <th>Volume Induk</th>
                                        <td>:</td>
                                        <td>
                                            <input type="hidden" class="form-control" id="id_pemasaran_bb" name="id_pemasaran_bb" value="{{$item->id_pemasaran_bb}}" />
                                            <input type="hidden" class="form-control" id="id_masterpembeli" name="id_masterpembeli" value="{{$item->id_masterpembeli}}" />
                                            <input type="hidden" class="form-control volume" id="volume_awal" name="volume_awal" value="{{number_format($item->total_volume, 4, ",", ".")}}" />
                                            <input type="text" readonly class="form-control volume" id="volume_verif" name="volume_verif" value="{{number_format($item->total_volume, 4, ",", ".")}}" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>No.LHV</th>
                                        <td>:</td>
                                        <td>
                                            <input type="text" class="form-control" required autocomplete="off" name="no_lhv" id="no_lhv">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pengkapalan</th>
                                        <td>:</td>
                                        <td>
                                            <div class="input-group date">
                                                <input type="text" class="form-control" required name="tgl_lhv" placeholder="Tanggal LHV" id="tgl_lhv" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <a onclick="preview()" class="btn btn btn-info btn-sm btn-block" id="preview_btn">Preview LHV</a>
                                <a onclick="close_btn()" class="btn btn btn-danger btn-sm btn-block" style="display: none;" id="close_btn">Tutup</a>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container" id="preview_id" style="border: 1px #000 solid;">
                                    <div id="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm" id="btn_simpan"><i class="far fa-check"></i>&nbsp;</button>&nbsp;&nbsp;&nbsp;
                        <!-- <button type="button" class="btn btn-warning btn-sm" id="btn_reject"><i class="far fa-times"></i>Tolak</button>&nbsp;&nbsp;&nbsp; -->
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
        @if(session('msg'))
        Swal.fire('Berhasil Memverifikasi Data', '', 'success');
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
        } else {
            // code ...
        }

    }

    function clear() {
        $('#id_pemasaran_bb').val('');
        $('#volume').val('');
        $('#volume_asli').val('');
        $('#vol_cam').val('');
        $('#id_detail').val('');
        $('#tugboat').val('');
    }

    function verifikasi_tongkang(data) {
        $('#modal_verifikasi').modal('show');
        clear();
        $('#btn_simpan').html('<i class="far fa-check"></i>&nbsp; Simpan');
        $.ajax({
            url: "{{route('surveyors.verifikator.verif_pemasaran_trader')}}",
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
                $('#id_pemasaran_bb').val(data[0].id_pemasaran_bb);
                $('#total_volume').val(numberFormat(data[0].total_volume, 4, ',', '.'));
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
    }

    function reject(data, no_transaksi) {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        Swal.fire({
            title: 'Tolak Transaksi ' + no_transaksi + ' ?',
            text: 'Transaksi akan dikembalikan ke pembeli',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.value) {
                // form.submit();
                $.ajax({
                    url: "{{route('surveyors.trader.reject')}}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_pemasaran_bb: data
                    },
                    beforeSend: function() {
                        $('#loader').show();
                    },
                    complete: function() {
                        $('#loader').hide();
                    },
                    success: function(data) {
                        if (data == 1){
                            window.location.href= "{{route('surveyors.petugas.index_trader')}}";
                        }
                    },
                    error: function(data) {
                        // console.log("gagal load data");
                    }
                });
            } else {
                // Swal.fire({
                //     title: "Batal Simpan Data",
                //     type: "error",
                //     allowOutsideClick: false,
                // })
                refresh();
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

<script>
    function preview() {
        var id_pemasaran_bb = $('#id_pemasaran_bb').val();
        var volume = $('#volume_verif').val();
        var no_lhv = $('#no_lhv').val();
        var tanggal = $('#tgl_lhv').val();
        // clear();
        if ($('#no_lhv').val() != '' && $('#tgl_lhv').val() != '') {
            $.ajax({
                url: "{{route('surveyors.preview_trader.modal')}}",
                type: "get",
                data: {
                    id_pemasaran_bb: id_pemasaran_bb,
                    volume: volume,
                    no_lhv: no_lhv,
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