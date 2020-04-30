<nav id="sidebar">

    <div class="text-center pt-3 m-0">
        <a href="{{ url('/') }}" >
        <h5 class="font-weight-bold text-secondary">
            {{-- <i class="fas fa-brain fa-sm mr-1"></i> --}}
            {{-- <i class="fas fa-store-alt"></i> --}}
            AVATRASH
        </h5>
        </a>
    </div>
    <hr class="col-8 my-1">

    <ul class="list-unstyled components" >

        <li >
            <a href="{{ route('home') }}" >
                <i class="fas fa-home"></i>
                <small>Home</small>
            </a>
        </li>

        @role('Nasabah')

        {{-- <li >
            <a href="#" > --}}
                {{-- {{ route('transaksiReward.create') }} --}}
                {{-- <i class="fas fa-hand-holding-heart"></i>
                <small>Tukar Poin</small>
            </a>
        </li> --}}

        <li >
            <a href="{{ route('createTransaksiSampahByNasabah') }}" >
                <small><i class="fas fa-recycle"></i> Sampah</small>
            </a>
        </li>

        <li >
            <a href="{{ route('transaksiRewardByNasabah.create') }}" >
                <i class="fas fa-gift"></i>
                <small>Hadiah</small>
            </a>
        </li>



        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-receipt"></i>
                <small>History Transaksi</small>
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li >
                    <a href="{{ route('transaksiSampahPerNasabah') }}" >

                        <small><i class="fas fa-recycle"></i> Sampah</small>
                    </a>
                </li>

                <li >
                    <a href="{{ route('transaksiRewardPerNasabah') }}" >
                        <small><i class="fas fa-gift"></i> Reward</small>
                    </a>
                </li>
            </ul>
        </li>

        @endrole

        @role('Admin|Member')
        <li>
            <a href="{{ route('user') }}" >
                <i class="far fa-id-badge"></i>
                <small>User</small>
            </a>
        </li>

        <li >
            <a href="{{ route('sampah') }}" >
                {{-- <i class="fas fa-dumpster"></i> --}}
                <i class="fas fa-recycle"></i>
                <small>Sampah</small>
            </a>
        </li>

        <li >
            <a href="{{ route('reward') }}" >
                <i class="fas fa-gift"></i>
                <small>Hadiah</small>
            </a>
        </li>

        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-donate"></i>
                {{-- <i class="fas fa-receipt"></i> --}}
                {{-- <i class="fas fa-hand-holding-heart"></i> --}}
                <small>Transaksi</small>
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="{{ route('transaksiSampah') }}" >
                        <small>Sampah</small>
                    </a>
                </li>
                <li>
                    <a href="{{ route('transaksiReward') }}" >
                        <small>Reward</small>
                    </a>
                </li>
            </ul>
        </li>

        {{-- <li>
            <a href="#" >
                <i class="far fa-chart-bar"></i>
                <small>Criteria-Prefference</small>
            </a>
        </li> --}}
        @endrole

        {{-- <li>
            <a href="#">Portfolio</a>
        </li> --}}

        <li>
            <a  href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            <small>{{ __('Logout') }}</small>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>

</nav>