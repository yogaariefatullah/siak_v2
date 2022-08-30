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
                <th>No.Transaksi</th>
                <td>:</td>
                <td>{{$item->id_transaksi}}</td>
            </tr>

            <tr>
                <th>Pembeli</th>
                <td>:</td>
                <td>
                    @if($item->kategori_pembeli == 2)
                    {{get_nama_master_pembeli_moms($item->id_masterpembeli)}}
                    @elseif($item->kategori_pembeli == 1)
                    {{get_nama_trader($item->id_masterpembeli)}}
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
        </table>

    </div>
    <div class="col-md-6">
        <table class="table table-borderless table-responsive-lg">
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
<div class="row">
    <div class="col-md-12">
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
                @for( $i = 0; $i < count($result); $i++) <tr>
                    <td>
                        {{$number++}}.
                    </td>
                    <td>
                        <center> {{(get_nama_trader($result[$i]->id_master_pembeli)) == '-'? get_nama_perusahaan_moms($result[$i]->id_master_pembeli): get_nama_trader($result[$i]->id_master_pembeli)}}</center>
                    </td>
                    <td style="text-align: right;">
                        {{number_format($result[$i]->volume, 4, ",", ".")}}
                    </td>
                    </tr>
                    @endfor

            </tbody>
        </table>
    </div>
</div>

@endforeach