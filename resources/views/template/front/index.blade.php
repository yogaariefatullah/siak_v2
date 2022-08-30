<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Academic Information System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Academic Information System (SESKOAL)">
    <meta name="description" content="Bertujuan untuk membantu proses belajar mengajar di SESKOAL">
    <meta name="keywords" content="Student & Teachers Module,SESKOAL, SEKOLAH KOMANDO, TNI AL">
    <meta name="robots" content="index, follow">

    <!-- Favicons -->
    <link href="{{url('front_layout/img/favicon.png')}}" rel="icon">
    <link href="{{url('front_layout/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{url('front_layout/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{url('front_layout/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('front_layout/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{url('front_layout/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{url('front_layout/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{url('front_layout/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{url('front_layout/css/style.css')}}" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

</head>

<body>

    <header id="header" class="fixed-top">
        <div class="container">
            <div class="logo float-left">
                <a href="{{route('login')}}" class="scrollto"><img src="{{asset('/assets/logo.gif')}}" alt="logo" class="img-fluid"></a>
            </div>

            <nav class="main-nav float-right d-none d-lg-block">
                <ul>
                    <li><a href="{{ asset('dokumen-contoh/mvp.pdf') }}" download>Dokumen Juknis Batubara</a></li>
                    <li><a href="{{ asset('dokumen-contoh/mvp_mineral.pdf') }}" download>Dokumen Juknis Mineral</a></li>
                </ul>
            </nav><!-- .main-nav -->

        </div>
    </header><!-- #header -->
    <main class="main-pages">
        <section id="intro" class="clearfix">
            <div class="container">
                <div class="intro-info">
                    <h2 style="color:#000;">Modul Verifikasi Penjualan</h2>
                    <a href="{{route('login')}}" class="btn btn-lg btn-outline-dark">Log In<i class="fa fa-arrow-right"></i /></a>
                </div>
            </div>
        </section><!-- #intro -->
    </main>

    <footer id="footer">
        <div class="container">
            <div class="copyright">
                2020 &copy; Kementerian Energi dan Sumber Daya Mineral Republik Indonesia
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- Uncomment below i you want to use a preloader -->
    <!-- <div id="preloader"></div> -->

    <!-- JavaScript Libraries -->
    <script src="{{url('front_layout/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{url('front_layout/lib/jquery/jquery-migrate.min.js')}}"></script>
    <script src="{{url('front_layout/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('front_layout/lib/easing/easing.min.js')}}"></script>
    <script src="{{url('front_layout/lib/mobile-nav/mobile-nav.js')}}"></script>
    <script src="{{url('front_layout/lib/wow/wow.min.js')}}"></script>
    <script src="{{url('front_layout/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{url('front_layout/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{url('front_layout/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{url('front_layout/lib/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{url('front_layout/lib/lightbox/js/lightbox.min.js')}}"></script>
    <!-- Contact Form JavaScript File -->
    <script src="{{url('front_layout/contactform/contactform.js')}}"></script>

    <!-- Template Main Javascript File -->
    <script src="{{url('front_layout/js/main.js')}}"></script>

</body>

</html>