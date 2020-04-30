<!DOCTYPE html>
<html lang="en">

<head>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-164971038-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-164971038-1');
    </script>

    {{-- google analytics custom, Sumber https://www.mastimon.com/2017/11/cara-daftar-google-analitic-untuk.html --}}
    {{-- <script type='text/javascript'>
    var _gaq = _gaq || [];
    _gaq.push([&#39;_setAccount&#39;, &#39;UA-164971038-1&#39;]);

    _gaq.push([&#39;_trackPageview&#39;]);

    (function() {
        var ga = document.createElement(&#39;script&#39;); ga.type = &#39;text/javascript&#39;; ga.async = true;
        ga.src = (&#39;https:&#39; == document.location.protocol ?  &#39;https://ssl&#39; : &#39;http://www&#39;) + &#39;.google-analytics.com/ga.js&#39;;
        var s = document.getElementsByTagName(&#39;script&#39;)[0]; s.parentNode.insertBefore(ga, s);
    })();
    </script> --}}



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Avatrash</title>

    {{-- BOOTSTRAP, CSS, FONT AWESOME --}}
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-landing/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/style.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets-landing/fonts/font-awesome/css/font-awesome.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets-landing/css/custom.css') }}">

    {{-- icon --}}
    {{-- <link href="{{ asset('assets/pe-icon-7-stroke.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    {{--  Manifest.Json PWA  --}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">
        {{-- Halaman Navigasi --}}
        @include('landing_page.pages.nav')

        <div class="intro-section" id="home-section" >

            <div class="slide-1" style="background-image: url('{{ asset('assets-landing/images/background-sampah.jpeg') }}');"
                data-stellar-background-ratio="0.5">
                <div class="container ">
                    <div class="row align-items-center">
                        <div class="col-12">

                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4">
                                    <br>
                                    <br class="d-md-none"><br class="d-md-none">
                                    <h1 data-aos="fade-up" data-aos-delay="100">Selamat Datang <br> Di Avatrash</h1>
                                    <p class="mb-4" data-aos="fade-up" data-aos-delay="200">
                                        Website Penukaran Sampah dan Komunitas Pengendali Ekosistem. Kami akan mengolah #sampah_masyarakat menjadi sesuatu yang lebih berharga :)
                                    </p>
                                </div>

                                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                                    <div class="row justify-content-center text-center text-white">
                                        <div class="col-md-4 p-3 rounded">
                                            <div class="col-12 counter">
                                                <i class="fa fa-recycle statistik-icon mb-4" aria-hidden="true"></i>
                                                <h2 class="timer count-title count-number"
                                                    data-to="{{$nTransaksiSampah}}" data-speed="1500"></h2>
                                                <p class="count-text">Transaksi Sampah</p>
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                        <div class="col-md-4 p-3 rounded">
                                            <div class="col-12 counter">
                                                <i class="fa fa-user statistik-icon mb-4" aria-hidden="true"></i>
                                                <h2 class="timer count-title count-number" data-to="{{$nNasabah}}"
                                                    data-speed="1500"></h2>
                                                <p class="count-text ">Nasabah Terdaftar</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Halaman Login --}}
        @yield('logo')

        {{-- Halaman Jenis Sampah --}}
        @yield('jenis-sampah')

        {{-- Halaman Rewards --}}
        @yield('rewards')

        {{-- Halaman User Point --}}
        @yield('user-point')



        {{-- Halaman Footer --}}
        @include('landing_page.pages.footer')
    </div>

    {{-- JAVASCRIPT --}}
    <script src="{{ asset('assets-landing/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets-landing/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets-landing/js/aos.js') }}"></script>
    <script src="{{ asset('assets-landing/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets-landing/js/main.js') }}"></script>
    {{-- <script src="{{ asset('assets-landing/js/script.js') }}"></script> --}}
    <script src="{{ asset('assets/countDisplayKiki.js') }}"></script>

    @yield('script-halaman')
</body>

</html>