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
$url = base64_encode($id_pemasaran) . '/' . base64_encode($tongkang->id_detail) . '/' . date('H') . '/' . date('Y');
?>
<?php $aaa = config('mvp.site_key_recaptcha') . 'laporan_lhv_uuid/' . $url;
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
                            <p>Untuk Pengangkutan dan Penjualan Mineral</p>
                        </center>
                    </td>
                    <td align="left" style="width: 20%;">
                        <center><img src='{{$gambar}}' alt='Logo Surveyor' class='logo' height='100' width='100'></center>
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
                    <td colspan="4" align="right"> No. LHV : <b>{{$tongkang->no_lhv}}</b></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <h4>A. Penjual Mineral</h4>
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
            </tbody>
        </table>
        <table width="100%">
            <tbody>
                <tr>
                    <td><b>Nama Produk Tambang &nbsp;&nbsp;: &nbsp;&nbsp;{{get_produk_id($pemasaran[0]->id_produk)}}</b></td>
                </tr>
            </tbody>
        </table>

        <!-- SECTION B -->
        @foreach($pemasaran as $item)
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
                    <td style="width: 40%;">{{$item->pelabuhan_asal}}, {{get_provinsi_id($item->lokasi_pelabuhan)}}</td>
                    <td style="width: 2%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 40%;">Pelabuhan Bongkar</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 40%;">{{$item->pelabuhan_tujuan}}</td>
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
                        @if($item->kategori_pembeli == 2)
                        {{get_nama_master_pembeli_moms($item->id_masterpembeli)}}
                        @elseif($item->kategori_pembeli == 1)
                        {{get_nama_trader($item->id_masterpembeli)}}
                        @elseif($item->kategori_pembeli == 5)
                        {{get_nama_stockpile($item->id_masterpembeli)}}
                        @else
                        -
                        @endif

                        @if($item->kategori_pembeli == 2)
                        <b>(ENDUSER)</b>
                        @elseif($item->kategori_pembeli == 1)
                        <b>(IUP OPK / IUP K)</b>
                        @elseif($item->kategori_pembeli == 5)
                        <b>(STOCKPILE)</b>
                        @elseif($item->kategori_pembeli == 3)
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
                    <td style="width: 40%;">{{$item->nama_kapal}}</td>
                    <td style="width: 2%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 40%;">Barge dan Tug Boat</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 40%;">{{$tongkang->nama_tongkang}} , {{$tongkang->tag_boat}}</td>
                    <td style="width: 2%;"></td>
                </tr>
            </tbody>
        </table>
        <!-- SECTION D -->
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
                    <td style="width: 40%;">{{number_format($tongkang->volume, 4, ',', '.')}}<span>&nbsp;Ton</span></td>
                    <td style="width: 2%;"></td>
                </tr>
                <tr>
                    <td style="width: 2%;"></td>
                    <td style="width: 40%;">Nomor Tanda Penerimaan Negara</td>
                    <td style="width: 6%;">:</td>
                    <td style="width: 40%;">{{$item->no_ntpn}}</td>
                    <td style="width: 2%;"></td>
                </tr>
            </tbody>
        </table>
        @endforeach
        <!-- SECTION E -->
        <?php
        $sts = $tongkang->status_cetak_lhv;
        $tgl = $tongkang->tgl_lhv;
        ?>
        <table width="100%">
            <tbody>
                <tr>
                    <th align="center" valign="middle" style="width: 30%;" rowspan="2">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('assets/logo.gif', 0.4, true)->size(500)->errorCorrection('H')->generate($aaa)) !!} " style="width: 3.8cm;">
                    </th>
                    <th align="center" valign="middle" style="width: 40%;" rowspan="2">

                        @if($sts <= 1) <h2 style="color:rgba(77,142,192,0.8);">ORIGINAL</h2>
                            @else<h2 style="color:rgba(77,142,192,0.8);">COPY</h2>
                            @endif

                    </th>
                    <th valign="middle" align="center" style="width: 30%;">
                        <p>Petugas Survey <br />{{tgl_indo(date('Y-m-d',strtotime($tgl)))}}</p>
                    </th>
                </tr>
                <tr>
                    <td align="center" valign="bottom" style="width: 30%;">
                        {{$nama_surveyor}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="information" style="position: absolute; bottom: 10;">
        <table width="100%">
            <tr>
                <td align="Center" colspan="3">
                    {{get_nama_surveyor($surveyor->id_surveyor)}} &copy; {{ date('Y') }} - All rights reserved.
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