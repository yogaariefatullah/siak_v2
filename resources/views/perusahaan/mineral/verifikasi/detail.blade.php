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
                <th>Penjual</th>
                <td>:</td>
                <td>{{$penjual}}</td>
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

        </table>

    </div>
</div>

<br />

<br />
<div class="row">
    <div class="col-md-9">

    </div>
    <div class="col-md-3">
        @if (empty($item->status_konfirmasi))
        <form id="btnVerif" method="GET">
            <a href="{{route('traders.verifikasi.mineral.accepted', $item->id_pemasaran_mn)}}" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Diterima"><i class="fa fa-check-circle"></i>&nbsp;Diterima</a>&nbsp;
            <input type="hidden" name="id_pemasaran" id="id_pemasaran" value="{{$item->id_pemasaran_mn}}">
            <button type="submit" class="btn btn-danger js-submit-confirm2" data-toggle="tooltip" data-placement="bottom" title="Ditolak"><i class="fa fa-times"></i>&nbsp;Ditolak</button>
        </form>

        @endif
    </div>
</div>
@endforeach