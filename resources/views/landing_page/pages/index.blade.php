@extends('landing_page.template')


@section('logo')
    <div class="site-section" id="sampah-section">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
                    <h2 class="section-title">About Us</h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-md-4">
                    <div class="d-flex justify-content-center align-middle">
                        <img src="{{asset('img/logo.jpeg')}}" alt="logo" class=" w-75">
                    </div>
                </div>


                <div class="col-md-8 d-flex align-items-center ">
                    <div class="card-text text-justify px-3">
                    <br class="d-block d-md-none">
                        <b class="text-success font-weight-bold">Avatrash</b><br>
                        Sebuah komunitas non profit yang memiliki visi menanamkan kesadaran, lingkungan, dan budaya mengolah sampah dimasyarakat.<br>
                        <b class="text-secondary font-weight-bold">What we do?</b><br>
                        Kami menawarkan solusi alternatif mencari pemasukan pasif dari mengumpul sampah di rumah. Selain uang juga bisa ditukar dengan sembako.<br>
                        <span  class="small">
                        <b class="text-success font-weight-bold">Our Team</b> :
                        Moh Zulkifli Katili, Aditya Febriyansah, Bagus Hariyanto, Melati Isti R, dan Fauziyyah Khoirunnisa.
                        </span>
                    </div>
                </div>

            </div>
        </div>

        <br><br>

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

@endsection