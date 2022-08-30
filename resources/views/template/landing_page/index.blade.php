<!DOCTYPE html>
<html lang="en">

<head>
    <base href="">
    <title>Academic Information System</title>
    <meta name="description" content="Academic Information System SESKOAL" />
    <meta name="keywords" content="SESKOAL, TNIAL" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Academic Information System SESKOAL" />
    <link rel="shortcut icon" href="{{asset('custom/logo/favicon.ico')}}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('landing_page/dist/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('landing_page/dist/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>

<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" data-bs-offset="200" class="bg-white position-relative">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Header Section-->
        <div class="mb-0" id="home">
            <!--begin::Wrapper-->
            <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="">
                <!--begin::Header-->
                <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center justify-content-between">
                            <!--begin::Logo-->
                            <div class="d-flex align-items-center flex-equal">
                                <!--begin::Mobile menu toggle-->
                                <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                    <span class="svg-icon svg-icon-2hx">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                            <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--end::Mobile menu toggle-->
                                <!--begin::Logo image-->
                                <a>
                                    <img alt="Logo" src="{{asset('custom/logo/seskoal_samping.png')}}" class="logo-default h-25px h-lg-30px" />
                                    <img alt="Logo" src="{{asset('custom/logo/seskoal_samping.png')}}" class="logo-sticky h-20px h-lg-25px" />
                                </a>
                                <!--end::Logo image-->
                            </div>
                            <!--end::Logo-->
                            <!--begin::Menu wrapper-->
                            <div class="d-lg-block" id="kt_header_nav_wrapper">
                                <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                                    <!--begin::Menu-->
                                    <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-bold" id="kt_landing_menu">
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link active py-3 px-4 px-xxl-6" href="#kt_body" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Home</a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#how-it-works" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Cara Penggunaan</a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#achievements" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Kerjasama</a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#team" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Berita</a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <!-- <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#portfolio" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Galeri</a> -->
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <!-- <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#pricing" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Pricing</a> -->
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </div>
                            </div>
                            <!--end::Menu wrapper-->
                            <!--begin::Toolbar-->
                            <div class="flex-equal text-end ms-1">
                                <a href="{{route('login')}}" class="btn btn-success">Sign In</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Landing hero-->
                <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
                    <!--begin::Heading-->
                    <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
                        <!--begin::Title-->
                        <h1 class="text-white lh-base fw-bolder fs-2x fs-lg-3x mb-15">Selamat Datang di Aplikasi
                            <br />
                            <span style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                                <span id="kt_landing_hero_text">Academic Information System SESKOAL</span>
                            </span></h1>
                        <!--end::Title-->
                        <!--begin::Action-->
                        <!-- <a href="../../demo13/dist/index.html" class="btn btn-primary">Try Metronic</a> -->
                        <!--end::Action-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Clients-->
                    <div class="d-flex flex-center flex-wrap position-relative px-5">
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Fujifilm">
                            <img src="{{asset('landing_page/dist/assets/media/svg/brand-logos/fujifilm.svg')}}" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Vodafone">
                            <img src="{{asset('landing_page/dist/assets/media/svg/brand-logos/vodafone.svg')}}" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="KPMG International">
                            <img src="{{asset('landing_page/dist/assets/media/svg/brand-logos/kpmg.svg')}}" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Nasa">
                            <img src="{{asset('landing_page/dist/assets/media/svg/brand-logos/nasa.svg')}}" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Aspnetzero">
                            <img src="{{asset('landing_page/dist/assets/media/svg/brand-logos/aspnetzero.svg')}}" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="AON - Empower Results">
                            <img src="{{asset('landing_page/dist/assets/media/svg/brand-logos/aon.svg')}}" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Hewlett-Packard">
                            <img src="{{asset('landing_page/dist/assets/media/svg/brand-logos/hp-3.svg')}}" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Truman">
                            <img src="{{asset('landing_page/dist/assets/media/svg/brand-logos/truman.svg')}}" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                    </div>
                    <!--end::Clients-->
                </div>
                <!--end::Landing hero-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Curve bottom-->
            <div class="landing-curve landing-dark-color mb-10 mb-lg-20">
                <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z" fill="currentColor"></path>
                </svg>
            </div>
            <!--end::Curve bottom-->
        </div>
        <!--end::Header Section-->
        <!--begin::How It Works Section-->
        <div class="mb-n10 mb-lg-n20 z-index-2">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Heading-->
                <div class="text-center mb-17">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-dark mb-5" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">How it Works</h3>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="fs-5 text-muted fw-bold">Silahkan Mendownload Usermanual dibawah ini
                        <br /></div>
                    <!--end::Text-->
                </div>
                <!--end::Heading-->
                <!--begin::Row-->
                <div class="row w-100 gy-10 mb-md-20">
                    <!--begin::Col-->
                    <div class="col-md-4 px-5">
                        <!--begin::Story-->
                        <div class="text-center mb-10 mb-md-0">
                            <!--begin::Illustration-->
                            <img src="{{asset('landing_page/dist/assets/media/illustrations/unitedpalms-1/2.png')}}" class="mh-125px mb-9" alt="" />
                            <!--end::Illustration-->
                            <!--begin::Heading-->
                            <div class="d-flex flex-center mb-5">
                                <!--begin::Badge-->
                                <span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">1</span>
                                <!--end::Badge-->
                                <!--begin::Title-->
                                <div class="fs-5 fs-lg-3 fw-bolder text-dark">Jane Miller</div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Description-->
                            <div class="fw-bold fs-6 fs-lg-4 text-muted">Save thousands to millions of bucks
                                <br />by using single tool for different
                                <br />amazing and great</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Story-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4 px-5">
                        <!--begin::Story-->
                        <div class="text-center mb-10 mb-md-0">
                            <!--begin::Illustration-->
                            <img src="{{asset('landing_page/dist/assets/media/illustrations/unitedpalms-1/8.png')}}" class="mh-125px mb-9" alt="" />
                            <!--end::Illustration-->
                            <!--begin::Heading-->
                            <div class="d-flex flex-center mb-5">
                                <!--begin::Badge-->
                                <span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">2</span>
                                <!--end::Badge-->
                                <!--begin::Title-->
                                <div class="fs-5 fs-lg-3 fw-bolder text-dark">Setup Your App</div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Description-->
                            <div class="fw-bold fs-6 fs-lg-4 text-muted">Save thousands to millions of bucks
                                <br />by using single tool for different
                                <br />amazing and great</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Story-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-4 px-5">
                        <!--begin::Story-->
                        <div class="text-center mb-10 mb-md-0">
                            <!--begin::Illustration-->
                            <img src="{{asset('landing_page/dist/assets/media/illustrations/unitedpalms-1/12.png')}}" class="mh-125px mb-9" alt="" />
                            <!--end::Illustration-->
                            <!--begin::Heading-->
                            <div class="d-flex flex-center mb-5">
                                <!--begin::Badge-->
                                <span class="badge badge-circle badge-light-success fw-bolder p-5 me-3 fs-3">3</span>
                                <!--end::Badge-->
                                <!--begin::Title-->
                                <div class="fs-5 fs-lg-3 fw-bolder text-dark">Enjoy Nautica App</div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Description-->
                            <div class="fw-bold fs-6 fs-lg-4 text-muted">Save thousands to millions of bucks
                                <br />by using single tool for different
                                <br />amazing and great</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Story-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::How It Works Section-->
        <!--begin::Statistics Section-->
        <div class="mt-sm-n10">
            <!--begin::Wrapper-->
            <div class="pb-0 pt-0 landing-dark-bg">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Heading-->
                    <div class="text-center mt-15 mb-18" id="achievements" data-kt-scroll-offset="{default: 100, lg: 150}">
                        <!--begin::Title-->
                        <!-- <h3 class="fs-2hx text-white fw-bolder mb-5">We Make Things Better</h3> -->
                        <!--end::Title-->
                        <!--begin::Description-->
                        <!-- <div class="fs-5 text-gray-700 fw-bold">Save thousands to millions of bucks by using single tool
                            <br />for different amazing and great useful admin</div> -->
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Statistics-->
                    <div class="d-flex flex-center">
                        <!--begin::Items-->
                        <div class="d-flex flex-wrap flex-center justify-content-center mb-15 mx-auto w-xl-900px">
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('assets/media/svg/misc/octagon.svg')">
                                <!--begin::Symbol-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black" />
                                        <path d="M12.0006 11.1542C13.1434 11.1542 14.0777 10.22 14.0777 9.0771C14.0777 7.93424 13.1434 7 12.0006 7C10.8577 7 9.92348 7.93424 9.92348 9.0771C9.92348 10.22 10.8577 11.1542 12.0006 11.1542Z" fill="black" />
                                        <path d="M15.5652 13.814C15.5108 13.6779 15.4382 13.551 15.3566 13.4331C14.9393 12.8163 14.2954 12.4081 13.5697 12.3083C13.479 12.2993 13.3793 12.3174 13.3067 12.3718C12.9257 12.653 12.4722 12.7981 12.0006 12.7981C11.5289 12.7981 11.0754 12.653 10.6944 12.3718C10.6219 12.3174 10.5221 12.2902 10.4314 12.3083C9.70578 12.4081 9.05272 12.8163 8.64456 13.4331C8.56293 13.551 8.49036 13.687 8.43595 13.814C8.40875 13.8684 8.41781 13.9319 8.44502 13.9864C8.51759 14.1133 8.60828 14.2403 8.68991 14.3492C8.81689 14.5215 8.95295 14.6757 9.10715 14.8208C9.23413 14.9478 9.37925 15.0657 9.52439 15.1836C10.2409 15.7188 11.1026 15.9999 11.9915 15.9999C12.8804 15.9999 13.7421 15.7188 14.4586 15.1836C14.6038 15.0748 14.7489 14.9478 14.8759 14.8208C15.021 14.6757 15.1661 14.5215 15.2931 14.3492C15.3838 14.2312 15.4655 14.1133 15.538 13.9864C15.5833 13.9319 15.5924 13.8684 15.5652 13.814Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <!--begin::Value-->
                                    <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                        <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="5903" data-kt-countup-suffix="+">0</div>
                                    </div>
                                    <!--end::Value-->
                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-bold fs-5 lh-0">Anggota Yang Telah Lulus</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain" style="background-image: url('assets/media/svg/misc/octagon.svg')">
                                <!--begin::Symbol-->
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-white mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M20 19.725V18.725C20 18.125 19.6 17.725 19 17.725H5C4.4 17.725 4 18.125 4 18.725V19.725H3C2.4 19.725 2 20.125 2 20.725V21.725H22V20.725C22 20.125 21.6 19.725 21 19.725H20Z" fill="black" />
                                        <path opacity="0.3" d="M22 6.725V7.725C22 8.325 21.6 8.725 21 8.725H18C18.6 8.725 19 9.125 19 9.725C19 10.325 18.6 10.725 18 10.725V15.725C18.6 15.725 19 16.125 19 16.725V17.725H15V16.725C15 16.125 15.4 15.725 16 15.725V10.725C15.4 10.725 15 10.325 15 9.725C15 9.125 15.4 8.725 16 8.725H13C13.6 8.725 14 9.125 14 9.725C14 10.325 13.6 10.725 13 10.725V15.725C13.6 15.725 14 16.125 14 16.725V17.725H10V16.725C10 16.125 10.4 15.725 11 15.725V10.725C10.4 10.725 10 10.325 10 9.725C10 9.125 10.4 8.725 11 8.725H8C8.6 8.725 9 9.125 9 9.725C9 10.325 8.6 10.725 8 10.725V15.725C8.6 15.725 9 16.125 9 16.725V17.725H5V16.725C5 16.125 5.4 15.725 6 15.725V10.725C5.4 10.725 5 10.325 5 9.725C5 9.125 5.4 8.725 6 8.725H3C2.4 8.725 2 8.325 2 7.725V6.725L11 2.225C11.6 1.925 12.4 1.925 13.1 2.225L22 6.725ZM12 3.725C11.2 3.725 10.5 4.425 10.5 5.225C10.5 6.025 11.2 6.725 12 6.725C12.8 6.725 13.5 6.025 13.5 5.225C13.5 4.425 12.8 3.725 12 3.725Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Symbol-->
                                <!--begin::Info-->
                                <div class="mb-0">
                                    <!--begin::Value-->
                                    <div class="fs-lg-2hx fs-2x fw-bolder text-white d-flex flex-center">
                                        <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="15" data-kt-countup-suffix="M+">0</div>
                                    </div>
                                    <!--end::Value-->
                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-bold fs-5 lh-0">Lembaga Pendidikan Kerjasama</span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Testimonial-->
                    <div class="fs-2 fw-bold text-muted text-center mb-3">
                        <!-- <span class="fs-1 lh-1 text-gray-700">“</span>When you care about your topic, you’ll write about it in a
                        <br />
                        <span class="text-gray-700 me-1">more powerful</span>, emotionally expressive way
                        <span class="fs-1 lh-1 text-gray-700">“</span></div> -->
                        <!--end::Testimonial-->
                        <!--begin::Author-->
                        <div class="fs-2 fw-bold text-muted text-center">
                            <!-- <a href="../../demo13/dist/account/security.html" class="link-primary fs-4 fw-bolder">Marcus Levy,</a> -->
                            <!-- <span class="fs-4 fw-bolder text-gray-600">KeenThemes CEO</span> -->
                        </div>
                        <!--end::Author-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Statistics Section-->
            <!--begin::Team Section-->
            <div class="py-10 py-lg-20">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Heading-->
                    <div class="text-center mb-12">
                        <!--begin::Title-->
                        <h3 class="fs-2hx text-dark mb-5" id="team" data-kt-scroll-offset="{default: 100, lg: 150}">Galeri</h3>
                        <!--end::Title-->
                        <!--begin::Sub-title-->
                        <div class="fs-5 text-muted fw-bold">MELAKSANAKAN PENDIDIKAN PENGEMBANGAN UMUM TERTINGGI DI LINGKUNGAN TNI ANGKATAN LAUT DAN PENDALAMAN MATERI KEJUANGAN
                            <br />SERTA PENGKAJIAN MASALAH - MASALAH PERTAHANAN DI LAUT TINGKAT STRATEGI DAN OPERASI DI LINGKUNGAN TNI ANGKATAN LAUT.</div>
                        <!--end::Sub-title=-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Product slider-->
                    <div class="tns tns-default">
                        <!--begin::Slider-->
                        <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000" data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true" data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false" data-tns-prev-button="#kt_team_slider_prev1" data-tns-next-button="#kt_team_slider_next1">
                            <!--begin::Item-->
                            <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                                <img src="{{asset('landing_page/dist/assets/media/product-demos/demo1.png')}}" class="card-rounded shadow mw-100" alt="" />
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                                <img src="{{asset('landing_page/dist/assets/media/product-demos/demo2.png')}}" class="card-rounded shadow mw-100" alt="" />
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                                <img src="{{asset('landing_page/dist/assets/media/product-demos/demo4.png')}}" class="card-rounded shadow mw-100" alt="" />
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                                <img src="{{asset('landing_page/dist/assets/media/product-demos/demo5.png')}}" class="card-rounded shadow mw-100" alt="" />
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Slider-->
                        <!--begin::Slider button-->
                        <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev1">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
                            <span class="svg-icon svg-icon-3x">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Slider button-->
                        <!--begin::Slider button-->
                        <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next1">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr071.svg-->
                            <span class="svg-icon svg-icon-3x">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Slider button-->
                    </div>
                    <!--end::Product slider-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Team Section-->
            <!--begin::Footer Section-->
            <div class="mb-0">
                <!--begin::Curve top-->
                <!-- <div class="landing-curve landing-dark-color">
                    <svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z" fill="currentColor"></path>
                    </svg>
                </div> -->
                <!--end::Curve top-->
                <!--begin::Wrapper-->
                <div class="landing-dark-bg pt-0">
                    <!--begin::Separator-->
                    <!-- <div class="landing-dark-separator"></div> -->
                    <!--end::Separator-->
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                            <!--begin::Copyright-->
                            <div class="d-flex align-items-center order-2 order-md-1">
                                <!--begin::Logo-->
                                <a href="">
                                    <img alt="Logo" src="{{asset('custom/logo/academisys.png')}}" class="logo-default h-25px h-lg-30px" />
                                </a>
                                <!--end::Logo image-->
                                <!--begin::Logo image-->
                                <span class="mx-5 fs-6 fw-bold text-gray-600 pt-1" href="https://seskoal.ac.id/">© 2022 SESKOAL.</span>
                                <!--end::Logo image-->
                            </div>
                            <!--end::Copyright-->
                            <!--begin::Menu-->
                            <ul class="menu menu-gray-600 menu-hover-primary fw-bold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
                                <li class="menu-item">
                                    <a href="https://seskoal.ac.id/visimisi/" target="_blank" class="menu-link px-2">About</a>
                                </li>
                                <li class="menu-item mx-5">
                                    <a href="https://seskoal.ac.id/" target="_blank" class="menu-link px-2">Portal</a>
                                </li>
                            </ul>
                            <!--end::Menu-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Footer Section-->
            <!--begin::Scrolltop-->
            <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                <span class="svg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                        <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Scrolltop-->
        </div>
    </div>
    <!--end::Main-->
    <script>
        // var hostUrl = "{{asset('landing_page/dist/assets/')}}";
    </script>
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{asset('landing_page/dist/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('landing_page/dist/assets/js/scripts.bundle.js')}}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{asset('landing_page/dist/assets/plugins/custom/fslightbox/fslightbox.bundle.js')}}"></script>
    <script src="{{asset('landing_page/dist/assets/plugins/custom/typedjs/typedjs.bundle.js')}}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{asset('landing_page/dist/assets/js/custom/landing.js')}}"></script>
    <!-- <script src="{{asset('landing_page/dist/assets/js/custom/pages/company/pricing.js')}}"></script> -->
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>

</html>