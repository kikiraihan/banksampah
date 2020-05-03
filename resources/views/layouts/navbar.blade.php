<nav class="navbar navbar-expand-md navbar-light navbar-laravel m-0 px-2">
    <div class="container-fluid px-2">
        @auth
        <a class="pl-0 pr-3 font-weight-bold" href="#" id="sidebarCollapse" role="button">
            ☰
        </a>
        <span class=" small" style="font-family: 'sans'">
            {{-- {{ config('app.name', 'Laravel') }} | --}}
            {{-- SISPEK - Mahasiswa | --}}
            Privilege : {{Auth::user()->kategori}}
        </span>
        @endauth



        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            {{--  <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>  --}}
            @else

            @if(Auth::user()->kategori=='Nasabah')
            <li class="nav-item ">
                <div class="nav-link small">
                    {{-- <div class="timer count-title count-number d-inline" data-to="{{ Auth::user()->nasabah->saldo }}" data-speed="1500"></div> --}}
                    {{ Auth::user()->nasabah->point->sum() }} pts
                    <i class="fas fa-donate text-success"></i>
                    {{-- <i class="fas fa-wallet"></i> --}}
                    {{-- <i class="fas fa-coins"></i> --}}
                </div>
            </li>
            @endif

            <li class="nav-item dropdown d-none d-lg-inline">
                <a id="navbarDropdown" class="small nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{-- {{ Auth::user()->kategori }} -  --}}
                    {{ Auth::user()->name }}
                    <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                    <p class="dropdown-item small text-center" href="#">
                        <i class="far fa-user"></i>
                        {{ Auth::user()->kategori }} -
                        {{ Auth::user()->username }}
                    </p>

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
            {{--  <li class="nav-item dropdown d-lg-none">
                <span  class="nav-link small" >
                    {{ Auth::user()->name }} <span class="caret"></span>
                </span>
            </li>  --}}
        @endguest
    </ul>

</div>
</nav>

