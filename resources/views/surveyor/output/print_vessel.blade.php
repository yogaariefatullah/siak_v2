<html>

<head>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style type="text/css">
        @page {
            margin: 20px;
        }

        body {
            margin: 0px;

        }

        table.background {}

        * {
            font-family: Verdana, Arial, sans-serif;
        }

        a {
            color: #fff;
            text-decoration: none;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        body img {
            vertical-align: middle;
            /* opacity: 0.5; */
        }

        .invoice table {
            margin: 15px;
        }

        .invoice h3 {
            margin-left: 15px;
        }

        .information {
            background-color: #fff;
            color: #2875c6;
        }

        .information .logo {}

        .information table {
            padding: 0px;
        }

        #watermark {
            position: fixed;
            top: 45%;
            width: 100%;
            text-align: center;
            opacity: .6;
            z-index: -1000;
            font-size: 5em;

        }
    </style>
</head>

<?php $hasil = $pemasaran[0]->volume +  $pemasaran[0]->volume_pencampur ?>

<?php
if (config('mvp.APP_ENV') == 'local') {
    $aaa = config('mvp.url_apps') . 'public/laporan_lhv_vessel/' . base64_encode($pemasaran[0]->id_pemasaran_bb) . '/' . base64_encode($volume_input_vessel);
} else {
    $aaa = config('mvp.url_apps') . 'laporan_lhv_vessel/' . base64_encode($pemasaran[0]->id_pemasaran_bb) . '/' . base64_encode($volume_input_vessel);
}
?>

<body>
    <div class="information">
        <table width="100%">
            <tbody>
                <tr>
                    <td style="width: 20%;">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('assets/logo.gif', 0.4, true)->size(500)->errorCorrection('H')->generate($aaa)) !!} " style="width: 2.8cm;">
                    </td>
                    <td align="center" style="width: inherit;">
                        <center>
                            <h2>Laporan Hasil Verifikasi (LHV)</h2>
                            <p>Untuk Pengangkutan dan Penjualan Batubara</p>
                        </center>
                    </td>
                    <td align="left" style="width: 20%;">
                        <center><?php echo $gambar; ?></center>
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="3" style="width: inherit; border-bottom:1px solid #000; border-top:1px solid #000;">
                        <center>

                        </center>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>

    <div class="invoice">
        <!-- SECTION A -->
        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="4" align="right"> No. LHV : {{$no_lhv}}</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <h4>A. Penjual Batubara</h4>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Perusahaan</td>
                    <td>Nama Perusahaan</td>
                    <td>No. & Tgl Surat Keputusan</td>
                    <td>Alamat Kantor</td>

                </tr>
                <tr>
                    <td align="left" colspan="4" style="width: inherit; border-top:1px double #000;">&nbsp;</td>
                </tr>
                <tr>
                    <td>{{get_jenis_izin($perusahaan[0]->jeniz_izin)}}</td>
                    <td>{{$perusahaan[0]->nama}}</td>
                    <td>{{$perusahaan[0]->no_sk}}</td>
                    <td>{{$perusahaan[0]->alamat}}</td>
                </tr>
                <tr>
                    <td colspan="2">Nama Produk Tambang</td>
                    BATUBARA
                </tr>
            </tbody>
        </table>
        <!-- SECTION B -->

        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="4">
                        <h4>B. Pelabuhan</h4>
                    </td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 40%;">Pelabuhan Muat</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 40%;">{{$pemasaran[0]->pelabuhan_tujuan}}, {{get_provinsi_id($pemasaran[0]->lokasi_pelabuhan)}}</td>
                    <td style="width: 2%;"></td>
                </tr>
            </tbody>
        </table>

        <!-- SECTION C -->
        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="4">
                        <h4>C. Pembeli Batubara</h4>
                    </td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 40%;">Nama Pembeli</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 40%;">
                        @if($pemasaran[0]->kategori_pembeli == 2)
                        {{get_nama_master_pembeli_moms($pemasaran[0]->id_masterpembeli)}}
                        @elseif($pemasaran[0]->kategori_pembeli == 1)
                        {{get_nama_trader($pemasaran[0]->id_masterpembeli)}}
                        @elseif($pemasaran[0]->kategori_pembeli == 5)
                        {{get_nama_stockpile($pemasaran[0]->id_masterpembeli)}}
                        @else
                        -
                        @endif

                        @if($pemasaran[0]->kategori_pembeli == 2)
                        <b>(ENDUSER)</b>
                        @elseif($pemasaran[0]->kategori_pembeli == 1)
                        <b>(IUP OPK / IUP K)</b>
                        @elseif($pemasaran[0]->kategori_pembeli == 5)
                        <b>(STOCKPILE)</b>
                        @elseif($pemasaran[0]->kategori_pembeli == 3)
                        <b>(IUP OP/ PKP2B)</b>
                        @else
                        -
                        @endif
                    </td>
                    <td style="width: 2%;"></td>
                </tr>
            </tbody>
        </table>

        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="4">
                        <h4>D. Kapal Angkut</h4>
                    </td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 40%;">Nama Vessel</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 40%;">{{$pemasaran[0]->nama_kapal}}</td>
                    <td style="width: 2%;"></td>
                </tr>
            </tbody>
        </table>
        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="4">
                        <h4>E. Dokumen Verifikasi</h4>
                    </td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 40%;">Total Muat</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 40%;">{{number_format($volume_input_vessel, 4, ',', '.')}}<span>&nbsp;Ton</span></td>
                    <td style="width: 2%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 40%;">Nomor Tanda Penerimaan Negara</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 40%;">{{$pemasaran[0]->no_ntpn}}</td>
                    <td style="width: 2%;"></td>
                </tr>
            </tbody>
        </table>
        <!-- SECTION C -->
        <table width="100%">
            <tbody>
                <tr>
                    <th align="center" valign="middle" style="width: 30%;" rowspan="2">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('assets/logo.gif', 0.4, true)->size(500)->errorCorrection('H')->generate($aaa)) !!} " style="width: 3.8cm;">
                    </th>
                    <th align="center" valign="middle" style="width: 40%;" rowspan="2">
                        <center>
                            @if(empty($pemasaran[0]->status_cetak_lhv))
                            <h2 style="color:rgba(77,142,192,0.5);">ORIGINAL</h2>
                            @else
                            <h2 style="color:rgba(77,142,192,0.5);">COPY</h2>
                            @endif
                        </center>
                    </th>
                    <th valign="middle" style="width: 30%;">
                        <p>Petugas Survey <br />{{tgl_indo(reverse_default_date($tgl))}}</p>
                    </th>
                </tr>
                <tr>
                    <td valign="bottom" style="width: 30%;">
                        {{$nama_surveyor}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="information" style="position: absolute; bottom: 20;">
        <table width="100%">
            <tr>
                <td align="Center" colspan="3">
                    {{get_nama_surveyor($surveyor->id_surveyor)}} &copy; {{ date('Y') }} - All rights reserved.
                </td>
            </tr>
        </table>
    </div>
</body>

</html>