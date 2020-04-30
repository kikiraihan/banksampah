<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <div class="site-logo mr-auto w-25"><a href="{{ route('landing_page') }}">Avatrash</a></div>
            <div class="mx-auto text-center">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                        <li><a href="#home-section" class="nav-link">Beranda</a></li>
                        {{-- <li><a href="#login-section" class="nav-link">Login</a></li> --}}
                        <li><a href="#sampah-section" class="nav-link">Jenis Sampah</a></li>
                        <li><a href="#rewards-section" class="nav-link">Hadiah</a></li>
                        <li><a href="#users-section" class="nav-link">Nasabah</a></li>
                    </ul>
                </nav>
            </div>



            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                @guest
                <li class="nav-item">
                    <a class="nav-link  btn btn-light py-1 px-2" href="{{ route('login') }}">{{ __('Login')." | Daftar" }}</a>
                </li>
                @else
                <li class="nav-item dropdown d-sm-none d-lg-inline">
                    <a id="navbarDropdown" class="small nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @if(Auth::user()->kategori=='Nasabah')
                        {{ Auth::user()->nasabah->saldo }} pts
                        <i class="fas fa-donate text-success"></i> |
                        @endif
                        {{ Auth::user()->name }}
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <a href="{{ route('home') }}" class="dropdown-item small text-center" href="#">
                            <i class="far fa-user"></i>
                            {{ Auth::user()->kategori }} -
                            {{ Auth::user()->username }}
                        </a>

                        <a class="dropdown-item small text-center" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown d-none">
                    <a  class="nav-link small" >
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                </li>
                @endguest
        </ul>

        </div>
    </div>
</header>