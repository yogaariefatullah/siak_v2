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
                <th>Jenis Laporan</th>
                <td>:</td>
                <td class="text-uppercase font-weight-boldest">{{$item->jenis_laporan}}</td>
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
<form id="lhv_vessel_form" class="form-horizontal" action="{{route('surveyors.lhv_vessel.bb')}}" method="POST">
    <div class="row" style="margin-top:20px;">
        {{csrf_field()}}
        <div class="col-md-6">
            <div class="form-group row">
                <label for="input01" class="col-sm-3 control-label">Volume Total :</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control volume" value="{{number_format($item->volume, 4, ",", ".")}}" autocomplete="off" name="volume_totals" id="volume_totals">
                    <input type="hidden" class="form-control" value="{{base64_encode($item->id_transaksi)}}" autocomplete="off" name="id_transaksi" id="id_transaksi">
                </div>
            </div>
            <div class="form-group row">
                <label for="input01" class="col-sm-3 control-label">No.LHV</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" autocomplete="off" name="no_lhv_vessel" id="no_lhv_vessel">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label for="datepicker" class="col-sm-3 control-label">Tanggal</label>
                <div class="col-sm-8">
                    <input class="form-control" required type="text" name="tgl_lhv_vessel" id="tgl_lhv_vessel" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-8"></div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-success btn-sm" id="btn_simpan"><i class="fa fa-check-circle"></i>&nbsp; SIMPAN</button>
                </div>
            </div>
        </div>

    </div>
</form>
@endforeach

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
    $('#tgl_lhv_vessel').datepicker({
        rtl: KTUtil.isRTL(),
        orientation: "auto bottom",
        todayHighlight: true,
        templates: arrows,
        format: "dd/mm/yyyy"
    });
</script>