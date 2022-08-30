<html>

<head>
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">

    <style type="text/css">
        @page {
            margin: 0px;
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
    </style>

</head>
<?php $aaa = 'https://mvp.esdm.go.id/laporan_lhv/' . base64_encode($id_pemasaran) . '/' . base64_encode($id_detail); ?>

<body>
    <div class="information">
        <table width="100%">
            <tbody>
                <tr>
                    <td style="width: 20%;">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('logo_surveyor/logo.gif', 0.4, true)->size(500)->errorCorrection('H')->generate($aaa)) !!} " style="width: 2.8cm;">
                    </td>
                    <td align="center" style="width: inherit;">
                        <center>
                            <h2>Laporan Hasil Verifikasi (LHV)</h2>
                            <p>Untuk Pengangkutan dan Penjualan Batubara</p>
                        </center>
                    </td>
                    <td align="left" style="width: 20%;">
                        <img src="{{$gambar}}" />
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
    <?php

    ?>
    @foreach($pemasaran as $item)
    <div class="invoice">
        <!-- SECTION A -->
        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="4" align="right"> No. LHV : {{$input_no_lhv}}</td>
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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
                    <td colspan="2">BATUBARA</td>
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
                        <?php
                        $is_pln_trader = is_pln_trader($item->id_jadwal);
                        // dd($is_pln_trader);
                        if (!empty($is_pln_trader)) {
                            echo ' &nbsp;&nbsp; - &nbsp;&nbsp;' . get_nama_trader($is_pln_trader);
                        }
                        ?>
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
                    <td style="width: 40%;">{{$input_nama_tongkang}} , {{$input_nama_tugboat}}</td>
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
                    <td style="width: 40%;">{{$input_volume}}<span>&nbsp;Ton</span></td>
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
        <!-- SECTION C -->
        <table width="100%">
            <tbody>
                <tr>
                    <td align="left" style="width: 10%;"></td>
                    <td align="left" style="width: 60%;"></td>
                    <td align="left" style="width: 30%;">Petugas Survey</td>
                </tr>
                <tr>
                    <td align="left" style="width: 10%;"></td>
                    <td align="left" style="width: 60%;"></td>
                    <td align="left" style="width: 30%;">{{$input_tgl}}</td>
                </tr>
                <tr>
                    <td align="left" style="width: 30%; height: 5%;">
                        <!-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(500)->errorCorrection('H')->generate($aaa)) !!} " style="width: 4.5cm;"> -->
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('logo_surveyor/logo.gif', 0.4, true)->size(500)->errorCorrection('H')->generate($aaa)) !!} " style="width: 4.0cm;">
                    </td>
                    <td align="left" style="width: 30%; height: 5%;">

                    </td>

                </tr>
                <tr>
                    <td align="left" style="width: 10%;"></td>
                    <td align="left" style="width: 60%;"></td>
                    <td align="left" style="width: 30%;">{{$nama_surveyor}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endforeach
    <div class="information">
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