@foreach($pemasaran as $item)

<div class="row">
    <div class="col-md-6">
        <table class="table table-borderless table-responsive-xl table-xl">
            <tr>
                <th>Tanggal</th>
                <td>:</td>
                <td>{{tgl_indo(date('Y-m-d', strtotime($item->date)))}}</td>
            </tr>
            <tr>
                <th>Jenis Laporan</th>
                <td>:</td>
                <td class="text-uppercase font-weight-boldest">{{$item->jenis_laporan}}</td>
            </tr>
            <tr>
                <th>No.Transaksi</th>
                <td>:</td>
                <td>{{$item->id_transaksi}}</td>
                <?php $final = cek_double_transaksi($item->id_transaksi); ?>
            </tr>
            <tr>
                <th>Volume Induk</th>
                <td>:</td>
                <td>{{number_format($item->volume, 4, ",", ".")}} Ton</td>
            </tr>
            <tr>
                <th>Penjual</th>
                <td>:</td>
                <td>
                    {{get_nama_perusahaan_moms($item->pelapor)}}
                </td>
            </tr>
            <tr>
                <th>Jarak Barging</th>
                <td>:</td>
                <td>{{number_format($item->jarak_barging, 2, ",", ".")}}</td>
            </tr>
            <tr>
                <th>Pelabuhan Asal</th>
                <td>:</td>
                <td>{{$item->pelabuhan_asal}}, <b>{{get_provinsi_id($item->lokasi_pelabuhan)}}</b></td>
            </tr>
        </table>
    </div>

    <div class="col-md-6">
        <table class="table table-borderless table-responsive-xl table-xl">
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
                <th>Volume Pencampur</th>
                <td>:</td>
                <td>{{number_format($item->volume_pencampur, 4, ",", ".")}} Ton</td>
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
                <th>Harga Jual</th>
                <td>:</td>
                <td>{{number_format($item->harga_jual, 2, ",", ".")}}</td>
            </tr>
            <tr>
                <th>Pelabuhan Tujuan</th>
                <td>:</td>
                <td>{{$item->pelabuhan_tujuan}}, <b>{{get_provinsi_id($item->lokasi_pelabuhan_ts)}}</b></td>
            </tr>
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
                    <td>{{number_format($item->tm, 2, ",", ".")}} %</t>
                    <td>{{number_format($item->im, 2, ",", ".")}} %</td>
                    <td>{{number_format($item->ts, 2, ",", ".")}} %</td>
                    <td>{{number_format($item->ash, 2, ",", ".")}} %</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<br />
@if(!empty($pencampur))
@else
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <table class="table table-light table-responsive-lg rounded">
            <caption>Volume Pencampur</caption>
            <thead class="thead-dark">
                <tr>
                    <th>
                        <center>No</center>
                    </th>
                    <th>
                        <center>Nama Perusahaan</center>
                    </th>
                    <th>
                        <center>Volume</center>
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
    <div class="col-md-1"></div>
</div>
@endif
@endforeach

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
                        <a href="{{route('surveyors.verifikator.print_lhv_tongkang_bb',base64_encode($tkg->id_detail))}}" target="_blank" rel="noopener noreferrer" class="btn bg-color-purple btn-icon btn-icon-white btn-sm" title="Cetak LHV"><i class="fa fa-print"></i></a>&nbsp;
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