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
                @for( $i = 0; $i < count($pencampur); $i++) <tr>
                    <td>
                        {{$number++}}.
                    </td>
                    <td>
                        <center> {{(get_nama_trader($pencampur[$i]->id_master_pembeli)) == '-'? get_nama_perusahaan_moms($pencampur[$i]->id_master_pembeli): get_nama_trader($pencampur[$i]->id_master_pembeli)}}</center>
                    </td>
                    <td style="text-align: right;">
                        {{number_format($pencampur[$i]->volume, 4, ",", ".")}}
                    </td>
                    </tr>
                    @endfor

            </tbody>
        </table>
    </div>
</div>
<br />
<div class="row">
    <div class="col-md-12">
        <h3> Dokumen LHV </h3>
    </div>
</div>
<br />
<div class="separator separator-solid separator-border-4"></div>
<br />
<div class="row">
    <div class="col-md-12">
        <div class="container">
            <input type="hidden" id="id_pemasaran_bb" name="id_pemasaran_bb" value="{{$item->id_pemasaran_bb}}" />
            @if(empty($item->dokumen_lhv))
            <div class="form-group row">
                <input accept=".pdf" type="file" id="doc_lhv" name="doc_lhv">
                <!-- <label class="custom-file-label" for="doc_lhv">Pilih berkas</label> -->
            </div>
            @endif
            @if(!empty($item->dokumen_lhv))
            <?php $urls =  '/uploads/lhv/' . $item->pelapor . '/' . $item->dokumen_lhv ?>
            <div class="form-group row">
                <a href="{{url($urls)}}" download="" class="btn font-weight-bold btn-xs btn-outline-danger"><i class="fa fa-download"></i> Unduh Dokumen LHV</a>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="modal-footer" id="modal_footer_upload">
    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return hideDetail()">Tutup</button>
    @if(empty($item->dokumen_lhv))
    <button type="submit" class="btn btn-success">Simpan</button>
    @endif
</div>
@endforeach