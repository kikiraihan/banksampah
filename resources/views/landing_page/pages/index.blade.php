@extends('landing_page.template')

@section('login')
    <div id="login-section">
        <br><br><br><br><br>
    </div>
    <div class="site-section courses-entry-wrap mt-3" data-aos="fade-up" data-aos-delay="100">
        <div class="container">
            <div class="row justify-content-center text-center ">
                <form id="formBase" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf

                    <div class="form-login-regis">

                            <h3 class="h4 text-black mb-4">Login</h3>

                            <div class="form-group">
                                <input type="text" placeholder="Email Addresss"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>



                            <div class="form-group">
                                <input type="password" placeholder="Password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="submit" class="text-white btn btn-success btn-pill" value="Login">
                                <a href="#" class="ml-3 btn btn-outline-secondary btn-pill register-button">
                                    Register</a>
                            </div>

                    </div>

                </form>
            </div>
        </div>
    </div>



@endsection

@section('jenis-sampah')
<div class="site-section" id="sampah-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
                <h2 class="section-title">Tukar Sampah Dengan Poin</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class="owl-carousel col-12 nonloop-block-14">


                @foreach ($sampah as $s)

                    <div class="card course bg-white h-100 align-self-stretch">
                        <div class="course-inner-text py-4 px-4">
                            <h2><a href="#" class="text-success">{{$s->nama}}</a></h2>
                            <p>{{ $s->deskripsi }}</p>
                            <p class="badge badge-success p-2 text-white">{{ $s->point }} point / {{ $s->satuan }} </p>
                        </div>
                    </div>

                @endforeach




            </div>
        </div>
        <div class="row justify-content-center">
            {{-- <div class="col-7 text-center">
                <button class="customPrevBtn btn btn-success m-1">Prev</button>
                <button class="customNextBtn btn btn-success m-1">Next</button>
            </div> --}}
            <-- Geser ({{$sampah->count()}}) -->
        </div>
    </div>
</div>
@endsection

@section('rewards')
<div class="site-section" id="rewards-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
                <h2 class="section-title">Tukar Poin Dengan Hadiah</h2>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="owl-carousel col-12 nonloop-block-14">


                @foreach ($reward as $r)
                    <div class="course bg-white h-100 align-self-stretch">
                        <figure class="m-0">
                            <a href="#rewards-section"><img src="{{ asset($r->foto) }}" alt="Image" class="img-fluid"></a>
                        </figure>
                        <div class="course-inner-text py-4 px-4">
                            <span class="course-price bg-success">{{$r->point}} Point</span>
                            <h3><a href="#" class="text-success">{{$r->nama}}</a></h3>
                            <p>Stock : {{$r->stock}} </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div class="row justify-content-center">
            {{-- <div class="col-7 text-center">
                <button class="customPrevBtn btn btn-success m-1">Prev</button>
                <button class="customNextBtn btn btn-success m-1">Next</button>
            </div> --}}
            <-- Geser ({{$reward->count()}}) -->
        </div>
    </div>
</div>
@endsection

@section('user-point')
<div id="users-section" class="site-section bg-image overlay" style="background-image: url('{{ asset('assets-landing/images/hero_1.jpg') }}');">

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
                <h2 class="section-title text-white">Nasabah Teraktif Menukar Sampah</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center">

            @foreach ($nasabah as $n)
                <div class="col-md-4 text-center testimony">
                    <img src="{{ asset('assets-landing/images/avatar_2x.png') }}" alt="Image" class="img-fluid w-25 mb-4 rounded-circle">
                    <h3 class="mb-4">{{$n->user->name}}</h3>
                    <blockquote>
                        <b class="text-success">{{$n->transaksiSampahs->count()}} Tranksaksi </b><br>
                    </blockquote>
                    <p class="text-light">Dusun : {{$n->dusun}}</p>
                    {{$n->alamat}}
                </div>
            @endforeach
        </div>
        <br><br><br>
        <a href="{{ route('nasabahTrans') }}" class="btn btn-outline-success btn-block ml-auto mr-auto col-4">Semua Nasabah</a>
    </div>
</div>
@endsection

@section('script-halaman')
<script>
    let login =
    `<h3 class="h4 text-black mb-4">Login</h3>

    <div class="form-group">
        <input type="text" placeholder="Email Addresss"
        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
        name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <input type="password" placeholder="Password"
        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
        name="password" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <input type="submit" class="text-white btn btn-success btn-pill" value="Login">
        <a href="#" class="ml-3 btn btn-outline-secondary btn-pill register-button">
            Register</a>
    </div>`;

let regis =

    '<h3 class="h4 text-black mb-4">Register</h3>' +
    '<div class="form-group">' +
    '<input name="ktp" type="text" class="form-control" placeholder="No KTP" name="nik">' +
    '</div>' +
    '<div class="form-group">' +
    '<input name="name" type="text" class="form-control" placeholder="Nama" >' +
    '</div>' +
    '<div class="form-group">' +
    '<input name="email" type="text" class="form-control" placeholder="Email" >' +
    '</div>' +
    '<div class="form-group">' +
    '<textarea  name="alamat" class="form-control" placeholder="Alamat" rows=4></textarea>' +
    '</div>' +
    '<div class="form-group">' +
    '<input name="telepon" type="text" class="form-control" placeholder="Telepone" >' +
    '</div>' +
    '<div class="form-group">' +
    '<input name="dusun" type="text" class="form-control" placeholder="Dusun" >' +
    '</div>' +
    '<div class="form-group">' +
    '<input name="username" type="text" class="form-control" placeholder="Username" >' +
    '</div>' +

    '<div class="form-group">' +
    '<input name="password" type="password" class="form-control" placeholder="Password" >' +
    '</div>' +

    '<div class="form-group">' +
    '<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Retype Password" required>'+
    '</div>' +

    '<div class="form-group">' +
    '<input type="submit" class="text-white btn btn-success btn-pill" value="Register">' +
    '<a href="#" class="ml-3 login-button btn btn-outline-secondary btn-pill"> Login</a>' +
    '</div>' ;

let formLoginRegis = $('.form-login-regis');

formLoginRegis.on('click', '.register-button', function (e) {
    e.preventDefault();
    formLoginRegis.html(regis);

    var form= document.getElementById("formBase");
    var str=form.action;
    form.action=str.replace("login","register")
});

formLoginRegis.on('click', '.login-button', function (e) {
    e.preventDefault();
    formLoginRegis.html(login);

    var form= document.getElementById("formBase");
    var str=form.action;
    form.action=str.replace("register","login")
});
</script>
@endsection