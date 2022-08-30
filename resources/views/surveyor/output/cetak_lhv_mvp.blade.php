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

<?php
$tongkang = '';
$tugboat = '';
$sts = $JSONData[0]['status_cetak_lhv'];
$no_lhv = $JSONData[0]['no_lhv'];
$zz = 0;

?>
<?php
$url = base64_encode($id_pemasaran);
?>
<?php
if (config('mvp.APP_ENV') == 'local' ) {
    $aaa = config('mvp.url_apps') .'public/laporan-lhv/' . base64_encode($id_pemasaran) . '/' . base64_encode($tmp_id_detail);
} else {
    $aaa = config('mvp.url_apps') .'laporan-lhv/' . base64_encode($id_pemasaran) . '/' . base64_encode($tmp_id_detail);
}
?>

<body>
    <div class="information">
        <table width="100%">
            <tbody>
                <tr>
                    <td style="width: 20%;">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('assets/logo.gif', 0.4, true)->size(500)->errorCorrection('H')->generate($aaa)) !!} " style="width: 3cm;">
                    </td>
                    <td align="center" style="width: inherit;">
                        <center>
                            <h2>Laporan Hasil Verifikasi (LHV)</h2>
                            <p>Untuk Pengangkutan dan Penjualan Batubara</p>
                        </center>
                    </td>
                    <td align="left" style="width: 20%;">
                        <center><img src="{{$gambar}}" alt="" class="logo" height="100" width="100"></center>
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
                    <td>IUP OPK Pengangkutan dan Penjualan</td>
                    <td>{{$DataPerusahaan[0]['nama']}}</td>
                    <td>{{$nomor_sk}}</td>
                    <td>-</td>

                </tr>
                <tr>
                    <td align="left" colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" colspan="4">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">Nama Produk Tambang</td>
                    @if (empty($JSONData['data'][0]['produk'][0]['nama_produk']))
                    <td colspan="2">BATUBARA</td>
                    @else
                    <td colspan="2">{{$JSONData['data'][0]['produk'][0]['nama_produk']}}</td>
                    @endif
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
                    <td style="width: 40%;">{{$JSONData[0]['pelabuhan_asal']}}, {{$provinsi}}</td>
                    <td style="width: 2%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 40%;">Pelabuhan Bongkar</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 40%;">{{$JSONData[0]['pelabuhan_tujuan']}}</td>
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
                    <td style="width: 40%;">{{$pembeli}} ({{$jenis_pembeli}})</td>
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
                    <td style="width: 40%;">{{$JSONData[0]['nama_kapal']}}</td>
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
                    <td style="width: 40%;">{{number_format($volume, 4, ',', '.')}}<span>&nbsp;Ton</span></td>
                    <td style="width: 2%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 40%;">Nomor Tanda Penerimaan Negara</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 40%;">-</td>
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
                        <center>@if($sts <= 1) <h2 style="color:rgba(77,142,192,0.5);">ORIGINAL</h2>
                                @else
                                <h2 style="color:rgba(77,142,192,0.5);">COPY</h2>
                                @endif
                        </center>
                    </th>
                    <th valign="middle" style="width: 30%;">
                        <p>Petugas Survey <br />{{tgl_indo(date('Y-m-d',strtotime($tgl)))}}</p>
                    </th>
                </tr>
                <tr>
                    <td valign="bottom" align="center" style="width: 30%;">
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
                    {{$Perusahaan_surveyor->name}} &copy; {{ date('Y') }} - All rights reserved.
                </td>
            </tr>
            <?php date_default_timezone_set("Asia/Bangkok"); ?>
            <tr>
                <td align="Center" colspan="3">
                    {{ date("j F Y H:i:s", time()) }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>