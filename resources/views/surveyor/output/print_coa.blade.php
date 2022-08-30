<style type="text/css">
    @page {
        margin: 5px 10px 10px 10px;
    }

    body {
        margin: 0px;

    }

    table.background {
        background: url('<?php echo $logo_minerba; ?>') no-repeat;
    }

    * {
        font-family: 'Times New Roman', Times, serif Verdana, Arial, sans-serif;
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
    }

    .container {
        display: inline-block;
        position: relative;
        width: 100%;
        background-size: contain;
    }

    @media print {
        .page-break {
            page-break-before: always;
            page-break-after: always;
        }
    }
</style>

</head>

<body class="container">
    <div id="watermark">
        <center>@if(empty($JSONData[0]['status_cetak_cow']))
            <h1 style="color:rgba(77,142,192,0.5);">ORIGINAL</h1>
            @else
            <h1 style="color:rgba(77,142,192,0.5);">COPY</h1>
            @endif
        </center>
    </div>
    <div class="information">
        <table width="100%">
            <tbody>
                <tr>
                    <td align="left" style="width: 65%;">
                        <div>
                            <center>
                                <h3>Certificate Of Sampling and Analysis</h3>
                            </center>
                        </div>
                    </td>
                    <td align="left" style="width: 5%;"></td>
                    <td align="center" rowspan="2" valign="center" style="width: 35%;  border-left:1px double #000;">
                        <img src='{{$gambar}}' alt='Logo Surveyor' class='logo' height='100' width='100'>
                    </td>
                </tr>
                <tr>
                    <td style="height: 2%;">
                        <center>{{get_alamat_surveyor($surveyor->id_surveyor)}}</center>
                    </td>
                    <td align="left" style="width: 5%;"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- PEMBUKAAN -->
    <div class="invoice">
        @foreach($pemasaran as $item)
        <table width="100%">
            <tbody>
                <tr>
                    <th align="left">Vessel Name</th>
                    <td>:</td>
                    <td>{{$item->nama_kapal}}</td>
                </tr>
                <tr>
                    <th align="left">Quantity</th>
                    <td>:</td>
                    <td>{{number_format($item->volume,4,',','.')}} TON</td>
                </tr>
                <tr>
                    <th align="left">Commodity</th>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <th align="left">Consignee</th>
                    <td>:</td>
                    <td>@if($item->kategori_pembeli == 2)
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
                    <th align="left">Notify</th>
                    <td>:</td>
                    <td style="width: inherit; border-bottom:1px solid #000;"></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>:</td>
                    <td style="width: inherit; border-bottom:1px solid #000;"></td>
                </tr>
                <tr>
                    <th align="left">PORT OF LOADING</th>
                    <td>:</td>
                    <td>{{$item->pelabuhan_asal}}, {{get_provinsi_id($item->lokasi_pelabuhan)}}</td>
                </tr>
                <tr>
                    <th align="left">PORT OF DISCHARGE</th>
                    <td>:</td>
                    <td>{{$item->pelabuhan_tujuan}}, {{get_provinsi_id($item->lokasi_pelabuhan_ts)}}</td>
                </tr>
                <tr>
                    <th align="left">ATTENDING DATE</th>
                    <td>:</td>
                    <td>{{tgl_indo(date('Y-m-d',strtotime(date('Y-m-d H:i:s'))))}}
                    </td>
                </tr>
                <tr>
                    <td align="left" colspan="6" style="width: inherit; border-bottom:1px double #000;">&nbsp;</td>
                </tr>
            </tbody>
        </table>
        @endforeach
        <table width="100%">
            <tbody>
                <tr>
                    <td colspan="3">
                        <p><strong>THIS IS TO CERTIFY</strong> : that we have performed the inspection, sampling and
                            analysis of the coal consignment nominated above. Samples were prepared and analysed in
                            accordance with appropriate ASTM standards.</p>
                        <p>The following weighted average results were obtained :</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- SPEK HALAMAN 1 -->
    <div class="invoice">
        @foreach($kualitas as $q)
        <table width="100%">
            <tbody>
                <!--1-->
                <tr>
                    <th colspan="2">Spesification :</th>
                    <th colspan="2">Results (as per ASTM standards)</th>
                    <th colspan="2">ASTM Designation No.</th>
                </tr>
                <tr>
                    <td>Ash Content</td>
                    <td>(ARB)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($pemasaran[0]->ash)) ? number_format($pemasaran[0]->ash,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 3174-12</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Ash Content</td>
                    <td>(ADB)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->ash_adb)) ? number_format($q->ash_adb,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 3174-12</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Total Moisture</td>
                    <td>(ARB)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($pemasaran[0]->tm)) ? number_format($pemasaran[0]->tm,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 3302/D 3302M-15</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Inherent Moisture</td>
                    <td>(ADB)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($pemasaran[0]->im)) ? number_format($pemasaran[0]->im,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 3173-11</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Size (0 To 50 mm)</td>
                    <td>&nbsp;</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->size)) ? number_format($q->size,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 4749-12</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Above 50 mm</td>
                    <td>&nbsp;</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->above)) ? number_format($q->above,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 4749-12</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Total Sulphur</td>
                    <td>(ARB)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($pemasaran[0]->ts)) ? number_format($pemasaran[0]->ts,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 4239 Method A-14</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Total Sulphur</td>
                    <td>(ADB)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->ts_adb)) ? number_format($q->ts_adb,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 4239 Method A-14</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Volatile Matter</td>
                    <td>(ADB)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->vm)) ? number_format($q->vm,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 3175-11</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Fixed Carbon</td>
                    <td>(ADB) By Diff</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->fc)) ? number_format($q->fc,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 3172-13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>HGI</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->hgi)) ? number_format($q->hgi,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 3175-11</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="height: 2%;">&nbsp;</td>
                    <td style="height: 2%;">&nbsp;</td>
                    <td style="height: 2%;">&nbsp;</td>
                </tr>
                <!--1-->
                <!--2-->
                <tr>
                    <th colspan="2">Spesification :</th>
                    <th colspan="2">Results (as per ASTM standards)</th>
                    <th colspan="2">Designation No.</th>
                </tr>
                <tr>
                    <td>Net Calorific Value</td>
                    <td> (ARB)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->nvc)) ? number_format($q->nvc,2,',','.'): 0,00}}
                    </td>
                    <td>Kcal/kg</td>
                    <td>ASTM D 5865-13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Gross Calorific Value </td>
                    <td>(ARB)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($pemasaran[0]->cv)) ? number_format($pemasaran[0]->cv,2,',','.'): 0,00}}
                    </td>
                    <td>Kcal/kg</td>
                    <td>ASTM D 5865-13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Gross Calorific Value </td>
                    <td>(ADB)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->gcv_adb)) ? number_format($q->gcv_adb,2,',','.'): 0,00}}
                    </td>
                    <td>Kcal/kg</td>
                    <td>ASTM D 5865-13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="height: 2%;">&nbsp;</td>
                    <td style="height: 2%;">&nbsp;</td>
                    <td style="height: 2%;">&nbsp;</td>
                </tr>
                <!--2-->
                <!--3-->
                <tr>
                    <th colspan="2">Ultimate Analysis :</th>
                    <th colspan="2"></th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <td>Hydrogens</td>
                    <td>(Dry Ash Free Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->hydrogen)) ? number_format($q->hydrogen,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 5373-13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Carbon</td>
                    <td>(Dry Ash Free Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->carbon)) ? number_format($q->carbon,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 5373-13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Nitrogen</td>
                    <td>(Dry Ash Free Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->nitrogen)) ? number_format($q->nitrogen,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 5373-13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Sulphur</td>
                    <td>(Dry Ash Free Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->sulphur)) ? number_format($q->sulphur,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 5373-13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Oxygen</td>
                    <td>(Dry Ash Free Basis)</td>
                    <td style="border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->oxygen)) ? number_format($q->oxygen,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 4239 Method A-12</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="height: 2%;" colspan="6">&nbsp;</td>
                </tr>
                <!--3-->
            </tbody>
        </table>
        @endforeach
    </div>

    <div style=" page-break-after: always;"></div>

    <!-- SPEK HALAMAN 2 -->
    <div class="invoice">
        <table width="100%">
            <tbody>
                <tr>
                    <th colspan="2">Spesification :</th>
                    <th colspan="2">Results (as per ASTM standards)</th>
                    <th colspan="2">ASTM Designation No.</th>
                </tr>

                <tr>
                    <td>SiO2 in Ash</td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->SiO2)) ? number_format($q->SiO2,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D3682 -13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Al2O3 in Ash </td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->Al2O3)) ? number_format($q->Al2O3,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D3682 -13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Fe2O3 in Ash </td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->Fe2O3)) ? number_format($q->Fe2O3,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D3682 -13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>CaO in Ash </td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->CaO)) ? number_format($q->CaO,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D3682 -13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>MgO in Ash </td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->MgO)) ? number_format($q->MgO,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D3682 -13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>TiO2 in Ash </td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->TiO2)) ? number_format($q->TiO2,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D3682 -13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Na2O in Ash </td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->Na2O)) ? number_format($q->Na2O,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D3682 -13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>K2O in Ash </td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->K2O)) ? number_format($q->K2O,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D3682 -13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Mn3O4 in Ash </td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->Mn3O4)) ? number_format($q->Mn3O4,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D3682 -13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>SO3 in Ash </td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->SO3)) ? number_format($q->SO3,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D5016 Method A-08</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>P2O5 in Ash </td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->P2O5)) ? number_format($q->P2O5,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D6349 -13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Boron (B)</td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->Boron)) ? number_format($q->Boron,2,',','.'): 0,00}}
                    </td>
                    <td>%</td>
                    <td>AS 1038.10.3-98</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Selenium (Se)</td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->Selenium)) ? number_format($q->Selenium,2,',','.'): 0,00}}
                    </td>
                    <td>%</td>
                    <td>ASTM D 4606-07</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Phosphorus (P)</td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->Phosphorus)) ? number_format($q->Phosphorus,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 6349-13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Chlorine (Cl)</td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->Chlorine)) ? number_format($q->Chlorine,2,',','.'): 0,00}}
                    </td>
                    <td>Pct</td>
                    <td>ASTM D 4208-13</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Fluorine (F)</td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->Fluorine)) ? number_format($q->Fluorine,2,',','.'): 0,00}}
                    </td>
                    <td>µ/g</td>
                    <td>ASTM D 3761-10</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Mercury (Hg)</td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->Mercury)) ? number_format($q->Mercury,2,',','.'): 0,00}}
                    </td>
                    <td>µ/g</td>
                    <td>ASTM D 6357-11</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Arsenic (As)</td>
                    <td>(Dry Basis)</td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->Arsenic)) ? number_format($q->Arsenic,2,',','.'): 0,00}}
                    </td>
                    <td>µ/g</td>
                    <td>ASTM D 4606-07</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="height: 2%;">&nbsp;</td>
                    <td style="height: 2%;">&nbsp;</td>
                    <td style="height: 2%;">&nbsp;</td>
                </tr>
                <!--4-->
                <!--5-->

                <tr>
                    <th colspan="2">Ash Fusion Temperature (Reducing) :</th>
                    <th colspan="2"></th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <td>Initial Deformation</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->initial_deformation_reduc)) ? number_format($q->initial_deformation_reduc,2,',','.'): 0,00}}
                    </td>
                    <td>Degree C</td>
                    <td>ASTM D 1857/D 1857M-04</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Spherical</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->spherical_reduc)) ? number_format($q->spherical_reduc,2,',','.'): 0,00}}
                    </td>
                    <td>Degree C</td>
                    <td>ASTM D 1857/D 1857M-04</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Hemispherical</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->hemispherical_reduc)) ? number_format($q->hemispherical_reduc,2,',','.'): 0,00}}
                    </td>
                    <td>Degree C</td>
                    <td>ASTM D 1857/D 1857M-04</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Flow</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->flow_reduc)) ? number_format($q->flow_reduc,2,',','.'): 0,00}}
                    </td>
                    <td>Degree C</td>
                    <td>ASTM D 1857/D 1857M-04</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <!-- 5 -->
                <!-- 6 -->
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="2">Ash Fusion Temperature (Oxiding) :</th>
                    <th colspan="2"></th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <td>Initial Deformation</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->initial_deformation_oxid)) ? number_format($q->initial_deformation_oxid,2,',','.'): 0,00}}
                    </td>
                    <td>Degree C</td>
                    <td>ASTM D 1857/D 1857M-04</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Spherical</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->spherical_oxid)) ? number_format($q->spherical_oxid,2,',','.'): 0,00}}
                    </td>
                    <td>Degree C</td>
                    <td>ASTM D 1857/D 1857M-04</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Hemispherical</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->hemispherical_oxid)) ? number_format($q->hemispherical_oxid,2,',','.'): 0,00}}
                    </td>
                    <td>Degree C</td>
                    <td>ASTM D 1857/D 1857M-04</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Flow</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->flow_oxid)) ? number_format($q->flow_oxid,2,',','.'): 0,00}}
                    </td>
                    <td>Degree C</td>
                    <td>ASTM D 1857/D 1857M-04</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <!-- 6 -->
                <!-- 7 -->
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="2"></th>
                    <th colspan="2"></th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <td>Photopermeability Mean </td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->photopermeability_mean)) ? number_format($q->photopermeability_mean,2,',','.'): 0,00}}
                    </td>
                    <td>%</td>
                    <td></td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>AFT (IDT, Reducing Atmosphere)</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->aft)) ? number_format($q->aft,2,',','.'): 0,00}}
                    </td>
                    <td>Deg. C</td>
                    <td></td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <!-- 7 -->
                <!-- 8 -->
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="2">Coke Parameter</th>
                    <th colspan="2"></th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <td>CSN</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->aft)) ? number_format($q->csn,2,',','.'): 0,00}}
                    </td>
                    <td></td>
                    <td>ASTM D 720</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>Fluidity</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->fluidity)) ? number_format($q->fluidity,2,',','.'): 0,00}}
                    </td>
                    <td></td>
                    <td>ASTM D 720</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
                <tr>
                    <td>CSR</td>
                    <td></td>
                    <td style=" border-bottom:1px dashed #0d7594;">
                        {{(!empty($q->csr)) ? number_format($q->csr,2,',','.'): 0,00}}
                    </td>
                    <td></td>
                    <td>ASTM D 5341</td>
                    <td style="border:1px solid #cd97eb;">&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- TTD SURVEYOR -->
    <div class="invoice">
        <table width="100%">
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" style="width: 10%;"></td>
                    <td align="left" style="width: 60%;"></td>
                    <td align="center" style="width: 30%;">
                        <p>For and On Behalf of Issued by Independent Inspection Agency at load port</p>
                    </td>
                </tr>
                <tr>
                    <td align="left" style="width: 10%;"></td>
                    <td align="left" style="width: 60%;"></td>
                    <td align="center" style="width: 30%;">Petugas Survey</td>
                </tr>
                <tr>
                    <td align="left" style="width: 10%;"></td>
                    <td align="left" style="width: 60%;"></td>
                    <td align="center" style="width: 30%;">__________,
                        {{tgl_indo(date('Y-m-d',strtotime(date('Y-m-d H:i:s'))))}}</td>
                </tr>
                <tr>
                    <td align="left" style="width: 10%;"></td>
                    <td align="left" style="width: 10%;"></td>
                    <!-- <td align="center" style=" width: 60%; border: solid 4px rgba(77,142,192,0.5) ">
                        <center>
                            <h2 style="color:rgba(77,142,192,0.5);">ORIGINAL</h2>

                            <h2 style="color:rgba(77,142,192,0.5);">COPY</h2>

                        </center>
                    </td> -->
                    <td align="center" style="width: 30%;"></td>
                </tr>
                <tr>
                    <td align="left" colspan="2" style="width: 50%;">Note : Inherent Moisture = Moisture in the analysis
                        sample</td>
                    <td align="center" style="width: 45%;">{{$nama_surveyor}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="information" style="position: absolute; bottom: 0;">
        <table width="100%">
            <tr>
                <td align="Center" colspan="3">
                    {{get_nama_surveyor($surveyor->id_surveyor)}} &copy; {{ date('Y') }} - All rights reserved.
                </td>
            </tr>

        </table>
    </div>
</body>