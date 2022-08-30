<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../">
    <meta charset="utf-8" />
    <title>MVP | Modul Verifikasi Penjualan</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->


    <!--begin::Page Custom Styles(used by this page)-->
    <link href="assets/css/pages/login/classic/login-2.css?v=7.0.6" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{asset('assets/plugins/global/plugins.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->


    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="{{asset('assets/logo.gif')}}" />

</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-row-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside order-2 order-lg-1 d-flex flex-column-fluid flex-lg-row-auto bgi-size-cover bgi-no-repeat p-7 p-lg-15">
                <!--begin: Aside Container-->
                <div class="d-flex flex-row-fluid flex-column justify-content-between">
                    <!--begin::Aside body-->
                    <div class="d-flex flex-column-fluid flex-column flex-center mt-5 mt-lg-0">
                        <!-- <a href="#" class="mb-15 text-center">
                            <img src="assets/media/logos/logo-letter-1.png" class="max-h-75px" alt="" />
                        </a> -->
                        <!--begin::Signin-->
                        <div class="login-form login-signin">
                            <div class="text-center mb-10 mb-lg-20">
                                <h3 class="">Lupa Kata Sandi</h3>
                                <p class="text-muted font-weight-bold">Masukan E-mail Akun </p>
                            </div>

                            <!--begin::Form-->
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Signin-->
                    </div>
                    <!--end::Aside body-->

                    <!--begin: Aside footer for desktop-->
                    <div class="d-flex flex-column-auto justify-content-center mt-15">
                        <div class="text-dark-75 font-weight-bold order-2 order-sm-1 my-2">
                            2020 &copy; Kementerian Energi dan Sumber Daya Mineral Republik Indonesia
                        </div>
                        <!-- <div class="d-flex order-1 order-sm-2 my-2">
                            <a href="#" class="text-muted text-hover-primary">Privacy</a>
                            <a href="#" class="text-muted text-hover-primary ml-4">Legal</a>
                            <a href="#" class="text-muted text-hover-primary ml-4">Contact</a>
                        </div> -->
                    </div>
                    <!--end: Aside footer for desktop-->
                </div>
                <!--end: Aside Container-->
            </div>
            <!--begin::Aside-->

            <!--begin::Content-->
            <div class="order-1 order-lg-2 flex-column-auto flex-lg-row-fluid d-flex flex-column p-7" style="background-image: url({{asset('assets/media/bg/bg-4.jpg')}});">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-lg-center">
                    <div class="d-flex flex-column justify-content-center">
                        <img src="{{asset('assets/images/logos.png')}}" class="max-h-400px max-w-450px" alt="Logo MVP">
                        <p class="font-weight-bolder font-size-h2-md font-size-lg text-dark">
                            Direktorat Jenderal Mineral dan Batubara
                        </p>
                    </div>
                </div>
                <!--end::Content body-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{asset('assets/plugins/global/plugins.bundle.js?v=7.0.6')}}"></script>
    <script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js?v=7.0.6')}}"></script>
    <!--end::Global Theme Bundle-->
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
    <script src="{{asset('assets/js/pages/custom/login/login-general.js?v=7.0.6')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script>
        $.getJSON('https://json.geoiplookup.io/?callback=?', function(data) {
            var json = data;
            console.log(data);
            var ip = json.ip;
            $('#ip').val(ip);
        });
    </script>

    <script type="text/javascript">
        var verifyCallback = function(response) {
            alert(response);
            $('#captcha').val(response);
        }
        var widget;
        var onloadCallback = function() {
            widget =
                grecaptcha.render('captcha-perusahaan', {
                    'sitekey': "{{ config('mvp.site_key_recaptcha') }}",
                    'theme': 'light'
                });
        }

        function verifyCaptchaPerusahaan(result) {
            if (result != '') {

            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                })

                Toast.fire({
                    icon: 'info',
                    title: 'Harap Isi Recaptcha'
                })
            }
        }
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

    @if(Session::has('success'))
    <script type="text/javascript">
        // swal('Berhasil', '{{Session::get("success")}}', 'success');
        Swal.fire({
            text: "{{Session::get('success')}}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok",
            customClass: {
                confirmButton: "btn font-weight-bold btn-light"
            }
        });
    </script>
    <?php
    Session::forget('success');
    ?>
    @endif
    @if(Session::has('error'))
    <script type="text/javascript">
        // swal('Gagal', '{{Session::get("error")}}', 'error');
        Swal.fire({
            text: "{{Session::get('error')}}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok",
            customClass: {
                confirmButton: "btn font-weight-bold btn-light"
            }
        });
    </script>
    <?php
    Session::forget('error');
    ?>
    @endif
</body>

</html>