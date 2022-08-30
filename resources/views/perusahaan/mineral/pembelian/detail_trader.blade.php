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
                <th>Harga Beli</th>
                <td>:</td>
                <td>{{number_format($item->harga_beli,2,',','.')}} </td>
            </tr>
        </table>

    </div>
    <div class="col-md-6">
        <table class="table table-borderless table-responsive-lg">
            <tr>
                <th>Penjual</th>
                <td>:</td>
                <td>{{$penjual}}</td>
            </tr>
            <tr>
                <th>Produk</th>
                <td>:</td>
                <td>{{get_produk_id($item->id_produk)}}</td>
            </tr>
            <tr>
                <th>Volume</th>
                <td>:</td>
                <td>{{number_format($item->volume,2,',','.')}} {{$item->uom}}</td>
            </tr>

        </table>

    </div>
</div>
<br /><br />

<div class="row">
    <div class="col-md-12">
        <table class="table table-light table-responsive-lg rounded">
            <thead class="thead-dark">
                <tr>
                    <th colspan="3"><center>Kadar</center></th>
                    <th><center>Ekualivalen</center></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>{{(!empty($item->kadar_1)) ? get_kualitas_id($item->kadar_1) : '-'}}</th>
                    <td>:</td>
                    <td>{{number_format($item->jumlah_kadar_1,2,',','.')}} {{$item->satuankadar_1}}</td>
                    <td style="text-align: center;">{{number_format($item->ekuivalen_1,2,',','.')}} {{$item->satuanekuivalen_1}}</td>
                </tr>
                <tr>
                    <th>{{(!empty($item->kadar_2)) ? get_kualitas_id($item->kadar_2) : '-'}}</th>
                    <td>:</td>
                    <td>{{number_format($item->jumlah_kadar_2,2,',','.')}} {{$item->satuankadar_2}}</td>
                    <td style="text-align: center;">{{number_format($item->ekuivalen_2,2,',','.')}} {{$item->satuanekuivalen_2}}</td>
                </tr>
                <tr>
                    <th>{{(!empty($item->kadar_3)) ? get_kualitas_id($item->kadar_3) : '-'}}</th>
                    <td>:</td>
                    <td>{{number_format($item->jumlah_kadar_3,2,',','.')}} {{$item->satuankadar_3}}</td>
                    <td style="text-align: center;">{{number_format($item->ekuivalen_3,2,',','.')}} {{$item->satuanekuivalen_3}}</td>
                </tr>
                <tr>
                    <th>{{(!empty($item->kadar_4)) ? get_kualitas_id($item->kadar_4) : '-'}}</th>
                    <td>:</td>
                    <td>{{number_format($item->jumlah_kadar_4,2,',','.')}} {{$item->satuankadar_4}}</td>
                    <td style="text-align: center;">{{number_format($item->ekuivalen_4,2,',','.')}} {{$item->satuanekuivalen_4}}</td>
                </tr>
                <tr>
                    <th>{{(!empty($item->kadar_5)) ? get_kualitas_id($item->kadar_5) : '-'}}</th>
                    <td>:</td>
                    <td>{{number_format($item->jumlah_kadar_5,2,',','.')}} {{$item->satuankadar_5}}</td>
                    <td style="text-align: center;">{{number_format($item->ekuivalen_5,2,',','.')}} {{$item->satuanekuivalen_5}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endforeach