@foreach($data as $item)

<div class="row">
    <div class="col-md-6">
        <table class="table table-borderless table-responsive-lg">
            <tr>
                <th>Tanggal</th>
                <td>:</td>
                <td>{{tgl_indo(date('Y-m-d', strtotime($item->date)))}}</td>
            </tr>
            <tr>
                <th>Penjual</th>
                <td>:</td>
                <td>{{get_nama_perusahaan_moms($item->pelapor)}}</td>
            </tr>
            <tr>
                <th>Pelabuhan Asal</th>
                <td>:</td>
                <td>{{$item->pelabuhan_asal}}</td>
            </tr>
            <tr>
                <th>Jenis Penjualan</th>
                <td>:</td>
                <td>{{($item->jenis_penjualan == '325404be-6885-4fac-ac8f-fedbc28e0efd'? 'Domestik' : 'Ekspor')}}</td>
            </tr>
            <tr>
                <th>Volume Induk</th>
                <td>:</td>
                <td>{{number_format($item->volume, 2, ",", ".")}} {{$item->uom}}</td>
            </tr>
            <tr>
                <th>Harga Jual</th>
                <td>:</td>
                <td>{{number_format($item->harga_jual, 2, ",", ".")}}</td>
            </tr>
            <tr>
                <th>Jarak Barging</th>
                <td>:</td>
                <td>{{number_format($item->jarak_barging, 2, ",", ".")}}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-borderless table-responsive-lg">
            <tr>
                <th>No.Transaksi</th>
                <td>:</td>
                <td>{{$item->id_transaksi}}</td>
                <?php $final = cek_double_transaksi($item->id_transaksi);?>
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
                <th>Volume Pencampur</th>
                <td>:</td>
                <td>{{number_format($item->volume_pencampur, 2, ",", ".")}}</td>
            </tr>
            <tr>
                <th>Nilai Invoice</th>
                <td>:</td>
                <td>{{number_format($item->nilai_invoice, 2, ",", ".")}}</td>
            </tr>
            <tr>
                <th>Nama Produk</th>
                <td>:</td>
                <td>{{get_produk_id($item->id_produk)}}</td>
            </tr>
        </table>
    </div>
</div>
<br /><br />
<div class="row">
    <div class="col-md-12">
        <table class="table table-borderless table-responsive-lg">
            <thead class="thead-dark">
                <tr>
                    <!-- <th>No.</th> -->
                    <th>Kualitas</th>
                    <th>Jumlah Kualitas</th>
                    <th>Satuan Ekuivalen</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <!-- <td>1</td> -->
                    <td>{{get_kualitas_id($item->kualitas_1)}}</td>
                    <td>{{number_format($item->jumlah_kualitas_1,2,',','.')}} {{$item->satuankadar_1}}</td>
                    <td>{{number_format($item->ekuivalen1,2,',','.')}} {{$item->satuanekuivalen_1}}</td>
                </tr>
                @if(!empty($item->kualitas_2))
                <tr>
                    <!-- <td>2</td> -->
                    <td>{{get_kualitas_id($item->kualitas_2)}}</thtd>
                    <td>{{number_format($item->jumlah_kualitas_2,2,',','.')}} {{$item->satuankadar_2}}</td>
                    <td>{{number_format($item->ekuivalen2,2,',','.')}} {{$item->satuanekuivalen_2}}</td>
                </tr>
                @endif
                @if(!empty($item->kualitas_3))
                <tr>
                    <!-- <td>3</td> -->
                    <td>{{get_kualitas_id($item->kualitas_3)}}</td>
                    <td>{{number_format($item->jumlah_kualitas_3,2,',','.')}} {{$item->satuankadar_3}}</td>
                    <td>{{number_format($item->ekuivalen3,2,',','.')}} {{$item->satuanekuivalen_3}}</td>
                </tr>
                @endif
                @if(!empty($item->kualitas_4))
                <tr>
                    <!-- <td>4</td> -->
                    <td>{{get_kualitas_id($item->kualitas_4)}}</td>
                    <td>{{number_format($item->jumlah_kualitas_4,2,',','.')}} {{$item->satuankadar_4}}</td>
                    <td>{{number_format($item->ekuivalen4,2,',','.')}} {{$item->satuanekuivalen_4}}</td>
                </tr>
                @endif
                @if(!empty($item->kualitas_5))
                <tr>
                    <!-- <td>5</td> -->
                    <td>{{get_kualitas_id($item->kualitas_5)}}</td>
                    <td>{{number_format($item->jumlah_kualitas_5,2,',','.')}} {{$item->satuankadar_5}}</td>
                    <td>{{number_format($item->ekuivalen5,2,',','.')}} {{$item->satuanekuivalen_5}}</td>
                </tr>
                @endif
            </tbody>

        </table>
    </div>
</div>

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
                        <a href="{{route('surveyors.verifikator.print_lhv_tongkang_bb',$tkg->id_detail)}}" target="_blank" rel="noopener noreferrer" class="btn bg-color-purple btn-icon btn-icon-white btn-sm" title="Cetak LHV"><i class="fa fa-print"></i></a>&nbsp;
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
@endforeach