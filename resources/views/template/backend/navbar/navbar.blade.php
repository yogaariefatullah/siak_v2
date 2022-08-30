<div id="kt_header" class="header flex-column  header-fixed ">
    <!--begin::Top-->
    <div class="header-top">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::Left-->
            <div class="d-none d-lg-flex align-items-center mr-3">
                <!--begin::Logo-->
                <div class="row">
                    <div class="col-2">
                        <a href="#" class="mr-10"><img alt="Logo" src="{{asset('assets/logo_esdm_baru.png')}}" class="max-h-60px" /></a>
                    </div>
                </div>
                <!--end::Logo-->

                <!--begin::Dropdown-->

                <!--end::Dropdown-->
            </div>
            <!--end::Left-->

            <!--begin::Topbar-->
            <div class="topbar">
                
                <!--begin::User-->
                <div class="topbar-item">
                    <div class="btn btn-icon w-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                        <div class="d-flex text-right pr-3">
                            <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-md-inline mr-1">MVP, </span>
                            @if(Auth::guard('adminstrator')->check())
                                <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">{{Auth::guard('adminstrator')->user()->name}}</span>
                            @elseif(Auth::guard('traders')->check())
                                <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">{{Auth::guard('traders')->user()->nama}}</span>
                            @elseif(Auth::guard('surveyors')->check())
                                <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">{{Auth::guard('surveyors')->user()->name}}</span>
                            @elseif(Auth::guard('surveyors_perusahaan')->check())
                                <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">{{Auth::guard('surveyors_perusahaan')->user()->name}}</span>
                            @elseif(Auth::guard('adminstrator')->check())
                                <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">{{Auth::guard('adminstrator')->user()->name}}</span>
                            @else
                                <span class="text-white font-weight-bolder font-size-sm d-none d-md-inline">-</span>
                            @endif
                        </div>
                        <span class="symbol symbol-35">
                            <span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-15"><i class="fab fa-slack"></i></span>
                        </span>
                    </div>
                </div>
                <!--end::User-->

                <!--begin::Quick panel-->
                <div class="topbar-item">
                    <div class="btn btn-icon btn-dropdown btn-lg mr-1 pulse pulse-white" id="">
                        <span class="svg-icon svg-icon-xl svg-icon-warning">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
                                    <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon--></span> <span class="pulse-ring"></span>
                    </div>
                </div>
                <!--end::Quick panel-->

            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->

    </div>
    <!--end::Top-->

    <!--begin::Bottom-->
    <div class="header-bottom">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                <!--begin::Header Menu-->
                @include('template.backend.navbar.menu')
                <!--end::Header Menu-->
            </div>
            <!--end::Header Menu Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Bottom-->
</div>