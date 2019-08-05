<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Bank Sampah</title>

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
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">
        {{-- Halaman Navigasi --}}
        @include('landing_page.pages.nav')

        <div class="intro-section" id="home-section">

            <div class="slide-1"
                style="background-image: url('{{ asset('assets-landing/images/background-sampah.jpeg') }}');"
                data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4">
                                    <h1 data-aos="fade-up" data-aos-delay="100">Selamat Datang <br> Di Bank Sampah</h1>
                                    <p class="mb-4" data-aos="fade-up" data-aos-delay="200">
                                        Website Pengolahan Sampah di Desa Hungayonaa. <br>
                                        Kami mengolah sampah menjadi sesuatu yang lebih berharga :)
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

        {{-- Halaman Jenis Sampah --}}
        @yield('jenis-sampah')

        {{-- Halaman Rewards --}}
        @yield('rewards')

        {{-- Halaman User Point --}}
        @yield('user-point')

        {{-- Halaman Login --}}
        @yield('login')

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