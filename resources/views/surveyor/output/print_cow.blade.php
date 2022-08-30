<style type="text/css">
    @page {
        margin: 20px 30px 30px 20px;
    }

    body {
        margin: 1px;
    }

    table.background {
        background: url('<?php echo $logo_minerba; ?>') no-repeat;
    }

    * {
        font-family: 'Times New Roman', Times, serif, Arial, sans-serif;
    }

    a {
        color: #fff;
        text-decoration: none;
    }

    table {
        font-size: small;
    }

    tfoot tr td {
        font-weight: bold;
        font-size: small;
    }

    body img {
        vertical-align: middle;
        opacity: 0.5;
    }

    .invoice table {
        margin: 15px;
    }

    .invoice h3 {
        margin-left: 15px;
    }

    .information {
        /* background-color: #fff;*/
        color: #2875c6;
    }

    .information .logo {
        margin: 0px;
    }

    .information table {
        padding: 10px;
    }

    #watermark {
        position: fixed;
        top: 35%;
        width: 100%;
        text-align: center;
        z-index: -1000;
        font-size: 5em;
        -ms-transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    .container {
        display: inline-block;
        position: relative;
        width: 100%;
        background-size: contain;
        border: 1px #000 solid;
    }
</style>
</head>

<body class="container">
    <div id="watermark">

    </div>
    <div class="information">
        <table width="100%">
            <tbody>
                <tr>
                    <td align="left" style="width: 65%;">
                        <div>
                            <center>
                                <h3>{{get_nama_surveyor($surveyor->id_surveyor)}}</h3>
                            </center>
                        </div>
                    </td>
                    <td align="left" style="width: 5%;"></td>
                    <td align="center" rowspan="2" valign="center" style="width: 35%;  border-left:1px double #000;">
                        <img src='{{$gambar}}' alt='mostafid' class='logo' height='100' width='100'>
                    </td>
                </tr>
                <tr>
                    <td style="height: 2%;">
                        <center>{{get_alamat_surveyor($surveyor->id_surveyor)}}</center>
                    </td>
                    <td align="left" style="width: 5%;"></td>
                </tr>
                <tr>
                    <td colspan="3" align="left">

                    </td>
                </tr>
                <tr>
                    <td align="left" style="height: 2%;">&nbsp;</td>
                    <td align="left" style="height: 2%;">&nbsp;</td>
                    <td align="left" style="height: 2%;">&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="invoice">
        <center>
            <h3>Certificate Of Weight</h3>
        </center>
        <!-- ATAS -->
        @foreach($pemasaran as $item)
        <table width="100%">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <th align="left">CONSIGNER</th>
                    <td>:</td>
                    <td>{{$perusahaan[0]->nama}}</td>
                </tr>
                <tr>
                    <th align="left">CONSIGNEE</th>
                    <td>:</td>
                    <td>@if($item->kategori_pembeli == 2)
                        {{get_nama_master_pembeli_moms($item->id_masterpembeli)}}
                        @elseif($item->kategori_pembeli == 1)
                        {{get_nama_trader($item->id_masterpembeli)}}
                        @elseif($item->kategori_pembeli == 5)
                        {{get_nama_stockpile($item->id_masterpembeli)}}
                        @else
                        -
                        @endif</td>
                </tr>
                <tr>
                    <th align="left">WEIGHT</th>
                    <td>:</td>
                    <td>
                        {{number_format($item->volume, 4, ',', '.')}} TON
                    </td>
                </tr>
                <tr>
                    <th align="left">LC Number</th>
                    <td>:</td>
                    <td>_________________________
                    </td>
                </tr>
                <tr>
                    <td align="left" style="height: 8%;">&nbsp;</td>
                    <td align="left" style="height: 8%;">&nbsp;</td>
                    <td align="left" style="height: 8%;">&nbsp;</td>
                </tr>


            </tbody>
        </table>
        <!-- Tengah -->
        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="3">
                        <p>
                            This Certificate refers only to the finding Indicated above and
                            does not constitute a statement of quality as referred to in the Metrology Law No.2 of 1981.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>:</td>
                    <th>{{tgl_indo(date('Y-m-d',strtotime(date('Y-m-d H:i:s'))))}}</th>
                </tr>
                <tr>
                    <td>Place</td>
                    <td>:</td>
                    <th>{{$item->pelabuhan_asal}}, {{get_provinsi_id($item->lokasi_pelabuhan)}}</th>
                </tr>
                <tr>
                    <td style="height: 5%;">&nbsp;</td>
                    <td style="height: 5%;">&nbsp;</td>
                    <td style="height: 5%;">&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <!-- TTD SURVEYOR -->
        <table width="100%">
            <tbody>
                <tr>
                    <td style="height: 5%;">&nbsp;</td>
                    <td style="height: 5%;">&nbsp;</td>
                    <td style="height: 5%;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="width: 10%;"></td>
                    <td align="left" style="width: 60%;"></td>
                    <td align="center" style="width: 30%;">Petugas Survey</td>
                </tr>
                <tr>
                    <td align="left" style="width: 10%;"></td>
                    <td align="left" style="width: 60%;"></td>
                    <td align="center" style="width: 30%;">______________,
                        {{tgl_indo(date('Y-m-d',strtotime(date('Y-m-d H:i:s'))))}}</td>
                </tr>
                <tr>
                    <!-- <td colspan="3" style="height: 18%;">
                        <center>@if(empty($JSONData[0]['status_cetak_cow']))
                            <h1 style="color:rgba(77,142,192,0.5);">ORIGINAL</h1>
                            @else
                            <h1 style="color:rgba(77,142,192,0.5);">COPY</h1>
                            @endif
                        </center>
                    </td> -->
                    <td style="height: 15%;">&nbsp;</td>
                    <td style="height: 15%;">
                        <center>@if(empty($JSONData[0]['status_cetak_cow']))
                            <h1 style="color:rgba(77,142,192,0.5);">ORIGINAL</h1>
                            @else
                            <h1 style="color:rgba(77,142,192,0.5);">COPY</h1>
                            @endif
                        </center>
                    </td>
                    <td style="height: 15%;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="width: 10%;"></td>
                    <td align="left" style="width: 60%;"></td>
                    <td align="center" style="width: 30%;">{{$nama_surveyor}}</td>
                </tr>
            </tbody>
        </table>
        @endforeach
    </div>
    <div class="information" style="position: absolute; bottom: 2px; border-top:1px double #000;">
        <table width="100%">
            <tr>
                <td align="left" style="width: 50%;">
                    <strong>{{get_nama_surveyor($surveyor->id_surveyor)}}</strong> &copy; {{ date('Y') }} - All rights reserved.
                </td>
                <td align="right" style="width: 50%;">
                    Certificate Number&nbsp;&nbsp;:&nbsp;&nbsp; {{$pemasaran[0]->no_cow}}
                </td>
            </tr>
        </table>
    </div>
</body>