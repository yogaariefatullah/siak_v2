@extends('template.backend.main')
@section('css')
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
        <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2"></div>
            <div class="d-flex align-items-center flex-wrap">

            </div>

        </div>
    </div>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-custom gutter-b" id="kt_card_3">
                        <div class="card-header bg-color-navy">
                            <div class="card-title">
                                <h3 class="card-label text-white">
                                    {{$judul}}
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-primary mr-2" data-card-tool="toggle">
                                    <i class="ki ki-arrow-down icon-nm"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-success mr-2" data-card-tool="reload">
                                    <i class="ki ki-reload icon-nm"></i>
                                </a>
                                <a href="{{$url_back}}" title="Kembali" class="btn btn-sm btn-light-danger mr-2">
                                    <i class="fas fa-angle-double-left"></i>&nbsp;&nbsp; Kembali
                                </a>
                            </div>
                        </div>
                        <div class="card-body" style="background-color: whitesmoke;">
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
                                            <td>
                                                {{$item->id_transaksi}}
                                                <?php $id_transaksi = base64_decode($item->id_transaksi); ?>
                                            </td>

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
                            <hr />
                            <form class="form" action="{{route('surveyors.verifikasi.coa.bb')}}" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                                {{csrf_field()}}
                                <div class="row" style="margin-top:20px;">
                                    <div class="col-md-1"></div>
                                    <input type="hidden" value="{{base64_encode($item->id_pemasaran_bb)}}" required autocomplete="off" name="id_pemasaran" id="id_pemasaran">
                                    <input type="hidden" value="{{base64_encode($item->id_transaksi)}}" required autocomplete="off" name="id_transaksi" id="id_transaksi">
                                    <input type="hidden" value="{{$item->kategori_pembeli}}" required autocomplete="off" name="kategori_pembeli" id="kategori_pembeli">
                                    <div class="col-md-10">
                                        <h4 class="mt-10 mb-5 display-5">Spesification</h4>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Ash Content (ARB) * </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" required autocomplete="true" name="ash_arb" id="ash_arb">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Ash Content (ADB) </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="ash_adb" id="ash_adb">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Total Moisture (ARB) *</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" required autocomplete="true" name="tm" id="tm">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Inherent Moisture (ADB) *</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" required autocomplete="true" name="im" id="im">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Size (0 To 50 mm)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="size" id="size">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Above 50 mm</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="above" id="above">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Total Sulphur (ARB) *</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" required autocomplete="true" name="ts_arb" id="ts_arb">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Total Sulphur (ADB) </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="ts_adb" id="ts_adb">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Volatile Matter (ADB) </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="vm_adb" id="vm_adb">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Fixed Carbon (ADB) By Diff </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="fc_adb" id="fc_adb">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">HGI</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="hgi" id="hgi">
                                            </div>
                                        </div>
                                        <h4 class="mt-10 mb-5 display-5">Parameters</h4>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Net Calorific Value (ARB)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control kalor" autocomplete="true" name="ncv_arb" id="ncv_arb">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Gross Calorific Value (ARB) *</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control kalor" required autocomplete="true" name="gcv_arb" id="gcv_arb">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Gross Calorific Value (ADB)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control kalor" autocomplete="true" name="gcv_adb" id="gcv_adb">
                                            </div>
                                        </div>
                                        <h4 class="mt-10 mb-5 display-5">Ultimate Analysis</h4>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Hydrogen (Dry Ash Free
                                                Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="hydrogen" id="hydrogen">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Carbon (Dry Ash Free Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="carbon" id="carbon">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Nitrogen (Dry Ash Free
                                                Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="nitrogen" id="nitrogen">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Sulphur (Dry Ash Free Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="sulphur" id="sulphur">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Oxygen (Dry Ash Free Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="oxygen" id="oxygen">
                                            </div>
                                        </div>
                                        <h4 class="mt-10 mb-5 display-5">Ash Analysis</h4>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">SiO2 in Ash (Dry Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="SiO2" id="SiO2">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Al2O3 in Ash (Dry Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Al2O3" id="Al2O3">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Fe2O3 in Ash (Dry Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Fe2O3" id="Fe2O3">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">CaO in Ash (Dry Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="CaO" id="CaO">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">MgO in Ash (Dry Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="MgO" id="MgO">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">TiO2 in Ash (Dry Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="TiO2" id="TiO2">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Na2O in Ash (Dry Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Na2O" id="Na2O">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">K2O in Ash (Dry Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="K2O" id="K2O">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Mn3O4 in Ash (Dry Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Mn3O4" id="Mn3O4">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">SO3 in Ash (Dry Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="SO3" id="SO3">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">P2O5 in Ash (Dry Basis)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="P2O5" id="P2O5">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Boron (B)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Boron" id="Boron">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Selenium (Se)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Selenium" id="Selenium">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Phosphorus (P)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Phosphorus" id="Phosphorus">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Chlorine (Cl)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Chlorine" id="Chlorine">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Fluorine (F)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Fluorine" id="Fluorine">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Mercury (Hg)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Mercury" id="Mercury">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Arsenic (As)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Arsenic" id="Arsenic">
                                            </div>
                                        </div>
                                        <h4 class="mt-10 mb-5 display-5">Ash Fusion Temperature (Reducing)</h4>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Initial Deformation</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control kalor" autocomplete="true" name="initial_deformation_red" id="initial_deformation_red">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Spherical</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control kalor" autocomplete="true" name="spherical_red" id="spherical_red">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Hemispherical</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control kalor" autocomplete="true" name="hemispherical_red" id="hemispherical_red">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Flow</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control kalor" autocomplete="true" name="flow_red" id="flow">
                                            </div>
                                        </div>
                                        <h4 class="mt-10 mb-5 display-5">Ash Fusion Temperature (Oxiding)</h4>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Initial Deformation</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control kalor" autocomplete="true" name="initial_deformation_ox" id="initial_deformation_ox">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Spherical</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control kalor" autocomplete="true" name="spherical_ox" id="spherical_ox">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Hemispherical</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control angka" autocomplete="true" name="hemispherical_ox" id="hemispherical_ox">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">Flow</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control angka" autocomplete="true" name="flow_ox" id="flow_ox">
                                            </div>
                                        </div>
                                        <h4 class="mt-10 mb-5 display-5">&nbsp;</h4>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Photopermeability Mean</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control persen" autocomplete="true" name="pm" id="pm">
                                            </div>
                                            <label for="input01" class="col-sm-3 control-label">AFT (IDT, Reducing Atmosphere)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control kalor" autocomplete="true" name="aft" id="aft">
                                            </div>
                                        </div>
                                        <h4 class="mt-10 mb-5 display-5">Coke Parameter</h4>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-2 control-label">CSN</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control persen" autocomplete="true" name="CSN" id="CSN">
                                            </div>
                                            <label for="input01" class="col-sm-2 control-label">Fluidity</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control persen" autocomplete="true" name="Fluidity" id="Fluidity">
                                            </div>
                                            <label for="input01" class="col-sm-2 control-label">CSR</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control persen" autocomplete="true" name="CSR" id="CSR">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            &nbsp;&nbsp;
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            </form>
                            @endforeach
                            <hr />
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
    </div>
    <!--end::Container-->
</div>
@endsection
@section('javascript')

<script>
    $(function() {
        @if(session('msg'))
        Swal.fire('Berhasil Memverifikasi Data', '', 'error');
        @endif
        @if(session('success-upload-lhv'))
        Swal.fire('Berhasil Memverifikasi Data', '', 'error');
        @endif
    });

    function refresh() {
        setTimeout(function() {
            location.reload()
        }, 100);
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
    $('.angka').inputmask({
        alias: "decimal",
        digits: 2,
        repeat: 3,
        digitsOptional: false,
        decimalProtect: true,
        groupSeparator: ".",
        placeholder: '0',
        rightAlign: false,
        radixPoint: ",",
        // radixFocus: true,
        autoGroup: true,
        autoUnmask: false,
        onBeforeMask: function(value, opts) {
            return value;
        },
        removeMaskOnSubmit: true
    });
    $('.kalor').inputmask({
        alias: "decimal",
        digits: 2,
        repeat: 6,
        digitsOptional: false,
        decimalProtect: true,
        groupSeparator: ".",
        placeholder: '0',
        rightAlign: false,
        radixPoint: ",",
        // radixFocus: true,
        autoGroup: true,
        autoUnmask: false,
        onBeforeMask: function(value, opts) {
            return value;
        },
        removeMaskOnSubmit: true
    });
    $('.persen').inputmask({
        alias: "decimal",
        digits: 2,
        repeat: 2,
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

    function confirm() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        Swal.fire({
            title: 'Apakah Data yang di Masukan Sudah Benar ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.value) {
                form.submit();
            } else {
                Swal.fire({
                    title: "Batal Simpan Data",
                    type: "error",
                    allowOutsideClick: false,
                })
                // refresh();
            }
        })
    }
</script>
<script>
    // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
    var card = new KTCard('kt_card_3');

    // Toggle event handlers
    card.on('beforeCollapse', function(card) {
        setTimeout(function() {
            // toastr.info('Before collapse event fired!');
        }, 100);
    });

    card.on('afterCollapse', function(card) {
        setTimeout(function() {
            // toastr.warning('Before collapse event fired!');
        }, 2000);
    });

    card.on('beforeExpand', function(card) {
        setTimeout(function() {
            // toastr.info('Before expand event fired!');
        }, 100);
    });

    card.on('afterExpand', function(card) {
        setTimeout(function() {
            // toastr.warning('After expand event fired!');
        }, 2000);
    });
    card.on('reload', function(card) {
        // toastr.info('Leload event fired!');

        KTApp.block(card.getSelf(), {
            overlayColor: '#ffffff',
            type: 'loader',
            state: 'primary',
            opacity: 0.3,
            size: 'lg'
        });
        setTimeout(function() {
            KTApp.unblock(card.getSelf());
        }, 2000);
    });
</script>

<script>
    function preview() {
        var id_pemasaran_bb = $('#id_pemasaran_bb').val();
        var nomor = $('#no_tongkang').val();
        var volume = $('#volume').val();
        var no_lhv = $('#no_lhv').val();
        var nama_tongkang = $('#nama_tongkang').val();
        var nama_tugboat = $('#tugboat').val();
        var tanggal = $('#tgl_lhv').val();
        var id_detail = $('#id_detail').val();
        // clear();
        $.ajax({
            url: "{{route('surveyors.preview.modal')}}",
            type: "get",
            data: {
                id_pemasaran_bb: id_pemasaran_bb,
                volume: volume,
                no_lhv: no_lhv,
                tongkang: nama_tongkang,
                tugboat: nama_tugboat,
                tanggal: tanggal,
                _token: "{{ csrf_token() }}"
            },

            success: function(data) {
                $('#preview').html(data);
                $('#preview_btn').hide();
                $('#close_btn').show();
            }
        });

    }

    function close_btn() {
        $('#preview').remove();
        $('#preview_id').html('<div id="preview"></div>');
        $('#close_btn').hide();
        $('#preview_btn').show();
    }
</script>
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
    $('#tgl_lhv').datepicker({
        rtl: KTUtil.isRTL(),
        orientation: "auto bottom",
        todayHighlight: true,
        templates: arrows,
        format: "dd/mm/yyyy"
    });

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
</script>
@endsection