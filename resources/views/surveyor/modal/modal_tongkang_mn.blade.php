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
                <th>Volume Induk</th>
                <td>:</td>
                <td>{{number_format($item->volume, 4, ",", ".")}}</td>
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
            <?php
            $no_transaksi  = $item->id_transaksi;
            $id_pemasaran = $item->id_pemasaran_bb;
            $status_edit_lhv = $item->status_admin_edit_lhv;
            $verified = 0;
            $status_surveyor = $item->status_surveyor;
            $final = cek_double_transaksi($item->id_transaksi);
            ?>
        </table>

    </div>
</div>

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
                    <th>
                        No
                    </th>
                    <th>
                        Nama Perusahaan
                    </th>
                    <th>
                        Volume
                    </th>
                </tr>
            </thead>

            <tbody>
                <?php $number = 1; ?>
                @for( $i = 0; $i < count($pencampur); $i++) <tr>
                    <td>
                        {{$number++}}
                    </td>
                    <td>
                        {{$pencampur[$i]->nama}}
                    </td>
                    <td>
                        {{number_format($pencampur[$i]->volume, 4, ",", ".")}}
                    </td>
                    </tr>
                    @endfor

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
            <caption>Volume Pencampur</caption>
            <thead class="thead-dark">
                <tr style="text-align: center;">
                    <th>No.</th>
                    <th>Nama Tongkang (Tug Boat)</th>
                    <th>Volume</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tongkang as $tkg)
                <tr style="text-align: center;">
                    <td>{{$tkg->no_tongkang}}</td>
                    <td>{{$tkg->nama_tongkang}} / <b>{{$tkg->tag_boat}}</b></td>
                    <td>{{number_format($tkg->volume,4,',','.')}}</td>
                    <td>
                        @if ($final == 1)
                        @if(empty($tkg->deleted_at))
                        @if(empty($tkg->no_lhv))
                        <?php $verified = $verified - 1; ?>
                        <a onclick="return verifikasi_tongkang('{{$tkg->id_detail}}')" class="btn bg-color-orange btn-icon btn-icon-white btn-sm" title="Verifikasi Tongkang"><i class="far fa-check-square"></i></a>&nbsp;
                        <button onclick="return hapus_tongkang('{{$tkg->id_detail}}')" class="btn btn-danger btn-icon btn-sm" title="Hapus Tongkang"><i class="fa fa-times"></i></button>
                        @else
                        <?php $verified = $verified + 1; ?>
                        @if($status_surveyor == 1)
                        @if(empty($tkg->status_cetak))
                        <a href="{{route('surveyors.verifikator.print_lhv_tongkang_bb',$tkg->id_detail)}}" target="_blank" rel="noopener noreferrer" class="btn bg-color-purple btn-icon btn-icon-white btn-sm" title="Cetak LHV"><i class="fa fa-print"></i></a>&nbsp;
                        @else
                        <a href="{{route('surveyors.verifikator.print_lhv_tongkang_bb',$tkg->id_detail)}}" target="_blank" rel="noopener noreferrer" class="btn bg-color-purple btn-icon btn-icon-white btn-sm" title="Cetak LHV"><i class="fa fa-print"></i></a>&nbsp;
                        <a onclick="return verifikasi_tongkang('{{$tkg->id_detail}}')" class="btnbg-color-orange btn-icon btn-icon-white btn-sm" title="Verifikasi Tongkang"><i class="far fa-check-square"></i></a>&nbsp;
                        @endif
                        @else
                        @if(empty($tkg->status_cetak))
                        <a href="{{route('surveyors.verifikator.print_lhv_tongkang_bb',$tkg->id_detail)}}" target="_blank" rel="noopener noreferrer" class="btn bg-color-purple btn-icon btn-icon-white btn-sm" title="Cetak LHV"><i class="fa fa-print"></i></a>&nbsp;
                        @else
                        <a href="{{route('surveyors.verifikator.print_lhv_tongkang_bb',$tkg->id_detail)}}" target="_blank" rel="noopener noreferrer" class="btn bg-color-purple btn-icon btn-icon-white btn-sm" title="Cetak LHV"><i class="fa fa-print"></i></a>&nbsp;
                        <a onclick="return verifikasi_tongkang('{{$tkg->id_detail}}')" class="btnbg-color-orange btn-icon btn-icon-white btn-sm" title="Verifikasi Tongkang"><i class="far fa-check-square"></i></a>&nbsp;
                        @endif
                        @endif
                        @endif
                        @else

                        @endif
                        @else
                        -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<script>
    function verifikasi_tongkang(data) {
        $('#modal_verifikasi').modal('show');
        $.ajax({
            url: "{{route('surveyors.verifikator.verifikasi_data_tongkang')}}",
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
                $('#nama_tongkang').val(data[0].nama_tongkang);
                $('#volume').val(numberFormat(data[0].volume, 4, ',', '.'));
                $('#id_detail').val(data[0].id_detail);
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
    }
</script>