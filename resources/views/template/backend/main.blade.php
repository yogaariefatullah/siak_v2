<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
    @include('template.backend.header.header_script')
    <script src="{{url('js/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{url('js/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('js/sweetalert2/dist/sweetalert2.min.css')}}">
    @yield('css')
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">

    <!--begin::Main-->
    @include('template.backend.header.header_mobile')
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->

                @include('template.backend.navbar.navbar')

                <!--end::Header-->

                <!--begin::Content-->
                @yield('content')

                <!--end::Content-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
    <!--begin::Sticky Toolbar-->
   
    <!--end::Sticky Toolbar-->
    @include('template.backend.footer.footer')
    @include('template.backend.plugins.plugins_quick_panel')
    @include('template.backend.plugins.plugins_user')
    @include('template.backend.plugins.scroll_top')

    @include('template.backend.footer.footer_script')
    @yield('javascript')
</body>
<!--end::Body-->

</html>