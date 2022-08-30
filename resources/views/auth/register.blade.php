<!DOCTYPE html>
<html lang="en">

<head>
    <base href="">
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
                                <h3 class="">Registrasi</h3>
                                <p class="text-muted font-weight-bold">Registrasi Perusahaan IUP OPK</p>
                            </div>

                            <!--begin::Form-->
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">E-mail:</label>
                                    <div class="col-lg-7">
                                        <input type="email" style="text-transform: lowercase;" id="email" name="email" class="form-control form-control-solid" required placeholder="Alamat E-mail" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Kata Sandi:</label>
                                    <div class="col-lg-7">
                                        <div class="input-group">
                                            <input class="form-control form-control-solid py-7 px-6" required placeholder="Kata Sandi" id="password" type="password" name="password" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-default" type="button" onclick="myFunction()"><i class="fa fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Konfirmasi Kata Sandi :</label>
                                    <div class="col-lg-7">
                                        <div class="input-group">
                                            <input class="form-control form-control-solid py-7 px-6" required placeholder="Konfirmasi Kata Sand" id="repassword" type="password" name="repassword" autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-default" type="button" onclick="myFunction2()"><i class="fa fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-5">

                                    </div>
                                    <div class="col-md-7">
                                        <meter max="4" id="password-strength-meter" style="width:80%;"></meter>
                                        <button type="button" class="btn btn-icon btn-outline-default btn-circle" data-toggle="popover" title="Informasi" data-html="true" data-content="Kata sandi lebih dari 8 karakter, berisi setidaknya 1 huruf besar, 1 huruf kecil, dan 1 angka karakter khusus kecuali <code>!#$%&'()*+,-./:;<=>?@[\]^_`{|}~</code>">
                                            <i class="far fa-question-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group-row">
                                    <span id="password-strength-text" class="text-warning"></span>
                                </div>
                                <br />
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Modi ID</label>
                                    <div class="col-lg-7">
                                        <input type="text" style="" name="modi_id" id="modi_id" class="form-control form-control-solid" required placeholder="Modi ID" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Nama PIC</label>
                                    <div class="col-lg-7">
                                        <input type="text" style="" name="nama_pic" id="nama_pic" required class="form-control form-control-solid" required placeholder="Nama PIC" />
                                        <input type="hidden" name="captcha" id="captcha" />
                                        <input type="hidden" name="ip" id="ip" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-5 col-form-label">Surat Penugasan</label>
                                    <div class="col-lg-7">
                                        <input type="file" style="" id="surat_penugasan" accept=".pdf" name="surat_penugasan" class="form-control form-control-solid" required />
                                        <br />
                                        <span><a href="{{ asset('dokumen-contoh/Penugasan dan Permintaan Kode Trader MVP.docx') }}" download="">Unduh Contoh Dokumen Penugasan</a></span>
                                    </div>
                                </div>
                                <div class="form-group d-flex flex-wrap flex-center">
                                    <div id="captcha-perusahaan"></div>
                                </div>
                                <hr />
                                <div class="form-group d-flex flex-wrap flex-center">
                                    <a href="{{route('/')}}" id="back" class="btn btn-outline-danger btn-md font-weight-bold px-9 py-4 my-3 mx-2">Batal</a>
                                    <button id="submit" type="submit" onclick="verifyCaptchaPerusahaan(grecaptcha.getResponse(widget))" class="btn btn-primary btn-md font-weight-bold px-9 py-4 my-3 mx-2">Daftar</button>
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
            <div class="order-1 order-lg-2 flex-column-auto flex-lg-row-fluid d-flex flex-column p-7" style="background-image:  url({{asset('assets/media/bg/bg-4.jpg')}});">
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
        $('input[name=email]').on('change', function() {
            var email = $('input[name=email]').val();
            var result = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);

            if (result == false) {
                $('input[name=email]').addClass('is-invalid');
            } else {
                $('input[name=email]').removeClass('is-invalid');
                $('input[name=email]').addClass('is-valid');
            }
        });

        $('input[name=email]').on('change', function() {
            var inputnpwp = $("#email").val();
            // alert(inputnpwp);
            $.get("{{route('cek_email')}}", {
                email: $("#email").val(),
            }, function(data) {
                json = JSON.parse(data);
                console.log(data);
                if (data == 0) {} else {
                    Swal.fire({
                        text: "E-mail sudah di gunakan, mohon ganti alamat E-mail",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light"
                        }
                    });
                    $('#email').val('');
                }

            })

        });

        $('input[name=modi_id]').on('change', function() {
            var inputnpwp = $("#modi_id").val();
            // alert(inputnpwp);
            $.get("{{route('cek_modi')}}", {
                modi_id: $("#modi_id").val(),
            }, function(data) {
                json = JSON.parse(data);
                console.log(data);
                if (data == 1) {
                    Swal.fire({
                        text: "Modi Id Sudah Terdaftar di Aplikasi",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light"
                        }
                    });
                    $('#modi_id').val('');
                } else if (data == 2) {
                    Swal.fire({
                        text: "Modi Id Tidak Terdaftar Sebagai IUP Angkut Jual",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light"
                        }
                    });
                    $('#modi_id').val('');
                } else if (data == 0) {
                    Swal.fire({
                        text: "Modi Id dapat digunakan",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light"
                        }
                    });
                } else {
                    Swal.fire({
                        text: "Terjadi Kesalahan, Harap coba kembali",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light"
                        }
                    });
                    $('#modi_id').val('');
                }

            })

        });

        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function myFunction2() {
            var x = document.getElementById("repassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script>
        var strength = [
            "Worst ",
            "Bad",
            "Weak",
            "Good",
            "Strong"
        ]

        var password = document.getElementById('password');
        var meter = document.getElementById('password-strength-meter');
        var text = document.getElementById('password-strength-text');
        var repassword = document.getElementById('repassword');
        password.addEventListener('input', function() {
            var val = password.value;
            var result = zxcvbn(val);
            // Update the password strength meter
            meter.value = result.score;
            // Update the text indicator
            if (val !== "") {
                text.innerHTML = "Strength: " + "<strong>" + strength[result.score] + "</strong>" + "<span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span";
            } else {
                text.innerHTML = "";
            }
        });
        repassword.addEventListener('input', function() {
            var repass = repassword.value;
            var pass = password.value;
            if (repass == pass) {
                var result = zxcvbn(repass);
                // Update the password strength meter
                meter.value = result.score;
                // Update the text indicator
                if (repass !== "") {
                    text.innerHTML = "Strength: " + "<strong>" + strength[result.score] + "</strong> " + "<span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span";
                } else {
                    text.innerHTML = "";
                }
            } else {
                text.innerHTML = "<strong>Kata Sandi Tidak Sesuai</strong> ";
            }

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