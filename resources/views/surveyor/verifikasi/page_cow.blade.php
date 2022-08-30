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
                            <hr />
                            <form class="form" action="{{route('surveyors.verifikasi.cow.bb')}}" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                                {{csrf_field()}}
                                <div class="row" style="margin-top:20px;">
                                    <div class="col-md-1"></div>
                                    <input type="hidden" value="{{number_format($item->volume, 4, ',', '.')}}" required autocomplete="off" name="volume_provosional" id="volume_provosional">
                                    <input type="hidden" value="{{$item->id_pemasaran_bb}}" required autocomplete="off" name="id_pemasaran" id="id_pemasaran">
                                    <input type="hidden" value="{{$item->kategori_pembeli}}" required autocomplete="off" name="kategori_pembeli" id="kategori_pembeli">
                                    <input type="hidden" value="{{count($pencampur)}}" required autocomplete="off" name="count_pencampur" id="count_pencampur">
                                    <input type="hidden" value="{{$item->id_transaksi}}" required autocomplete="off" name="id_transaksi" id="id_transaksi">
                                    <input type="hidden" value="{{number_format($item->volume_pencampur, 4, ',', '.')}}" required autocomplete="off" name="volume_pencampur" id="volume_pencampur">
                                    <div class="col-md-10">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label font-weight-boldest">Volume Induk:</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control volume" value="{{number_format($item->volume, 4, ',', '.')}}" required autocomplete="off" name="volume_final" id="volume_final">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label font-weight-boldest">Nomor COW:</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" required autocomplete="off" name="no_cow" id="no_cow">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-4 col-form-label">Jenis Pembayaran</label>
                                            <div class="col-8 col-form-label">
                                                <div class="radio-inline">
                                                    <label class="radio">
                                                        <input type="radio" name="radios5" value="LC" />
                                                        <span></span>
                                                        LETTER OF CREDIT
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="radios5" value="SKBDN" />
                                                        <span></span>
                                                        Surat Kredit Berdokumen Dalam Negeri
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="radios5" value="other" checked />
                                                        <span></span>
                                                        Lainnya
                                                    </label>
                                                </div>
                                                <!-- <span class="form-text text-muted">Some help text goes here</span> -->
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            &nbsp;&nbsp;
                                            <button type="button" class="btn btn-success" onclick="confirm()">Simpan</button>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            </form>
                            <hr />
                            <div class="row" style="margin-top:20px;">
                                <div class="col-md-12">
                                    <table class="table table-light table-responsive-lg rounded">
                                        <caption>Spesifikasi Produk</caption>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>CV</th>
                                                <th>TM</th>
                                                <th>IM</th>
                                                <th>TS</th>
                                                <th>ASH</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$item->cv}}</td>
                                                <td>{{number_format($item->tm, 2, ",", ".")}}</t>
                                                <td>{{number_format($item->im, 2, ",", ".")}}</td>
                                                <td>{{number_format($item->ts, 2, ",", ".")}}</td>
                                                <td>{{number_format($item->ash, 2, ",", ".")}}</td>
                                            </tr>
                                        </tbody>
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
                                            @foreach($pencampur as $pc)
                                            <tr style="text-align: center;">
                                                <td>{{$no++}}</td>
                                                <td>{{$pc->nama}}</td>
                                                <td>{{number_format($pc->volume, 4, ",", ".")}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
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
                                                <th>Nomor LHV</th>
                                                <th>Nama Tongkang (Tug Boat)</th>
                                                <th>Volume</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tongkang as $tkg)
                                            <tr style="text-align: center;">
                                                <td>{{$tkg->no_tongkang}}</td>
                                                <td>{{$tkg->no_lhv}}</td>
                                                <td>{{$tkg->nama_tongkang}} / <b>{{$tkg->tag_boat}}</b></td>
                                                <td>{{number_format($tkg->volume,4,',','.')}}</td>
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
@endsection
@section('javascript')

<script>
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
        // clear();
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