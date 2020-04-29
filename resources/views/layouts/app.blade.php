<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>


    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N46TS69');</script>
    <!-- End Google Tag Manager -->


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    {{-- icon --}}
    {{-- <link href="{{ asset('assets/pe-icon-7-stroke.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('assets/bootstrap4/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    @yield('css-halaman')
    <link rel="stylesheet" href="{{ asset('assets/Chart.min.css') }}">
</head>

<body style="{{ $bodyStyle }}">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N46TS69"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    <div id="app" class="wrapper">
        @auth
        @include('layouts.sidebar')
        @endauth

        <div id="content">
            @include('layouts.navbar')
            <main class="py-4">
                @yield('content')
            </main>

        </div>
    </div>
    {{-- <footer class="footer text-center">
        ini footer
    </footer> --}}

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="{{ asset('assets/bootstrap4/js/jquery-3.3.1.js') }}"></script>
    <!-- Popper.JS -->
    <script src="{{ asset('assets/bootstrap4/js/popper.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/bootstrap4/js/bootstrap.js') }}"></script>

    <script type="text/javascript">
        // $('#sidebar').toggleClass('active');

        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').css('width','calc(100%-250px)');
            });
        });

        $(function() {
            $('#sidebar a[href~="' + location.href + '"]').parents('li').addClass('active');
        });

    </script>

    <script src="{{ asset('assets/countDisplayKiki.js') }}"></script>

    @yield('script-halaman')

    <script src="{{ asset('assets/Chart.min.js') }}"></script>

    <script src="{{ asset('assets/script.js') }}"></script>

</body>

</html>