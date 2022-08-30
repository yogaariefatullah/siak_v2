<base href="">
<meta charset="utf-8" />
<title>MVP | Modul Verifikasi Penjualan</title>
<meta name="description" content="Updates and statistics" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
<!--end::Fonts-->

<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles-->


<!--begin::Global Theme Styles(used by all pages)-->
<link href="{{asset('assets/plugins/global/plugins.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/style.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
<!--end::Global Theme Styles-->

<!--begin::Layout Themes(used by all pages)-->
<!--end::Layout Themes-->

<link rel="shortcut icon" href="{{asset('assets/logo.gif')}}" />
<style>
    .bg-color-blue {
        background-color: #57889c !important
    }

    .bg-color-navy {
        background-color: #181268 !important
    }

    .bg-color-blueLight {
        background-color: #4bc7ff !important
    }

    .bg-color-blueDark {
        background-color: #4c4f53 !important
    }

    .bg-color-green {
        background-color: #356e35 !important
    }

    .bg-color-greenLight {
        background-color: #71843f !important
    }

    .bg-color-greenDark {
        background-color: #496949 !important
    }

    .bg-color-red {
        background-color: #a90329 !important
    }

    .bg-color-yellow {
        background-color: #b09b5b !important
    }

    .bg-color-orange {
        background-color: #c79121 !important
    }

    .bg-color-orangeDark {
        background-color: #a57225 !important
    }

    .bg-color-pink {
        background-color: #ac5287 !important
    }

    .bg-color-pinkDark {
        background-color: #a8829f !important
    }

    .bg-color-purple {
        background-color: #6e587a !important
    }

    .bg-color-darken {
        background-color: #404040 !important
    }

    .bg-color-lighten {
        background-color: #d5e7ec !important
    }

    .bg-color-white {
        background-color: #fff !important
    }

    .bg-color-grayDark {
        background-color: #525252 !important
    }

    .bg-color-magenta {
        background-color: #6e3671 !important
    }

    .bg-color-teal {
        background-color: #568a89 !important
    }

    .bg-color-redLight {
        background-color: #a65858 !important
    }
</style>

<body id="kt_body" class="print-content-only header-fixed header-mobile-fixed subheader-enabled page-loading">

    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header flex-column  header-fixed ">
                    <!--begin::Top-->
                    <div class="header-top">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Left-->
                            <div class="d-none d-lg-flex align-items-center mr-3">
                                <!--begin::Logo-->
                                <a href="#" class="mr-10"><img alt="Logo" src="{{asset('assets/logo_esdm_baru.png')}}" class="max-h-60px" /></a>
                                <!--end::Logo-->
                            </div>
                            <!--end::Left-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Top-->
                </div>
                <!--end::Header-->

                <!--begin::Content-->
                <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
                        <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        </div>
                    </div>
                    <!--end::Subheader-->

                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class=" container ">
                            <!-- begin::Card-->
                            <div class="card card-custom overflow-hidden">
                                <div class="card-body p-0">
                                    <!-- begin: Invoice-->
                                    <!-- begin: Invoice header-->
                                    <div class="row justify-content-center bgi-size-cover bgi-no-repeat py-8 px-8 py-md-27 px-md-0" style="background-image: url({{asset('/assets/media/bg/bg-4.jpg')}});">
                                        <div class="col-md-9">
                                            <div class="d-flex justify-content-between pb-10 pb-md-5 flex-column flex-md-row">
                                                <h3 class="display-4 text-white font-weight-boldest mb-10">Laporan Hasil Verifikasi</h3>
                                                <div class="d-flex flex-column align-items-md-end px-0">
                                                    <!--begin::Logo-->
                                                    <h6 class="mb-10 mt-20 text-white">
                                                        {{$profile->name}}
                                                    </h6>
                                                    <!--end::Logo-->
                                                    <span class="text-white d-flex flex-column align-items-md-end">
                                                        <span class="font-weight-bold"></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between text-white pt-6">
                                                <div class="d-flex flex-column flex-root">
                                                    <span class="font-weight-bold mb-2r">Nomor LHV</span>
                                                    <span class="font-weight-boldest">{{$pemasaran[0]->nama_dokumenlhv}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: Invoice header-->

                                    <!-- begin: Invoice body-->
                                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                                        <div class="col-md-9">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="pl-0 font-weight-bold text-muted text-uppercase">Laporan Spesifikasi</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($pemasaran as $pm)
                                                        <tr class="font-weight-bold font-size-lg">
                                                            <td class="pl-0 pt-7">Nomor Transaksi : </td>
                                                            <td class="text-right pt-7 font-weight-boldest">{{$pm->id_transaksi}}</td>
                                                        </tr>
                                                        <tr class="font-weight-bold font-size-lg">
                                                            <td class="pl-0 pt-7">Tanggal Transaksi : </td>
                                                            <td class="text-right pt-7 font-weight-boldest">{{tgl_indo(date('Y-m-d', strtotime($pm->date)))}}</td>
                                                        </tr>
                                                        <tr class="font-weight-bold font-size-lg">
                                                            <td class="pl-0 pt-7">Lokasi Muat : </td>
                                                            <td class="text-right pt-7 font-weight-boldest">{{$pm->pelabuhan_asal}}, {{get_provinsi_id($pm->lokasi_pelabuhan)}}</td>
                                                        </tr>
                                                        <tr class="font-weight-bold font-size-lg">
                                                            <td class="pl-0 pt-7">Volume : </td>
                                                            <td class="text-right pt-7 font-weight-boldest">{{number_format($volums,4,',','.')}} Ton</td>
                                                        </tr>
                                                        <tr class="font-weight-bold font-size-lg">
                                                            <td class="pl-0 pt-7">Volume : </td>
                                                            <td class="text-right pt-7 font-weight-boldest">{{$pm->nama_kapal}} </td>
                                                        </tr>
                                                        <tr class="font-weight-bold font-size-lg">
                                                            <td class="pl-0 pt-7">Nama Penjual : </td>
                                                            <td class="text-right pt-7 font-weight-boldest">
                                                                {{get_nama_perusahaan_moms($pm->pelapor)}}
                                                            </td>
                                                        </tr>
                                                        <tr class="font-weight-bold font-size-lg">
                                                            <td class="pl-0 pt-7">Nama Pembeli : </td>
                                                            <td class="text-right pt-7 font-weight-boldest">
                                                                @if($pm->kategori_pembeli == 2)
                                                                {{get_nama_master_pembeli_moms($pm->id_masterpembeli)}}
                                                                @elseif($pm->kategori_pembeli == 1)
                                                                {{get_nama_trader($pm->id_masterpembeli)}}
                                                                @elseif($pm->kategori_pembeli == 5)
                                                                {{get_nama_stockpile($pm->id_masterpembeli)}}
                                                                @else
                                                                -
                                                                @endif
                                                            </td>
                                                        </tr>

                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            

                                        </div>
                                    </div>
                                    <!-- end: Invoice body-->

                                    <!-- end: Invoice-->
                                </div>
                            </div>
                            <!-- end::Card-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->

                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column " style="background-color: #1e1593;" id="kt_footer">
                    <!--begin::Container-->
                    <div class=" container  d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted font-weight-bold mr-2">2020 &copy; Kementerian Energi dan Sumber Daya Mineral Republik Indonesia</span>
                        </div>
                        <!--end::Copyright-->

                        <!--begin::Nav-->
                        <div class="nav nav-dark order-1 order-md-2">
                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1200
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#0BB783",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#F3F6F9",
                        "dark": "#212121"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#D7F9EF",
                        "secondary": "#ECF0F3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#212121",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#ECF0F3",
                    "gray-300": "#E5EAEE",
                    "gray-400": "#D6D6E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#80808F",
                    "gray-700": "#464E5F",
                    "gray-800": "#1B283F",
                    "gray-900": "#212121"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!--end::Global Config-->

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{asset('assets/plugins/global/plugins.bundle.js?v=7.0.6')}}"></script>
    <script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js?v=7.0.6')}}"></script>
    <!--end::Global Theme Bundle-->
</body>