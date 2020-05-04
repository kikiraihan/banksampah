@extends('layouts.app',[
'title'=>'Transaksi Sampah',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">

        @if(Session::has('sukses'))
            <div class="alert alert-info text-center" role="alert" style="margin-bottom:-5px">
                <em> <strong>
                    Terima kasih telah bertransaksi!
                </strong> </em>
                <br>
                Silahkan konfirmasi via WhatsApp berikut :
                <br>
                {{Session::get('sukses')->sampah->pemilik->user->name}}
                <strong>
                {{Session::get('sukses')->sampah->pemilik->user->telepon}}
                </strong>
                <br><br>
                <a class="btn btn-sm btn-success"
                href="https://api.whatsapp.com/send?phone={{'+62'.Session::get('sukses')->sampah->pemilik->user->telepon}}&text=
                Assalamu%27alaikum%0Asaya%20telah%20bertransaksi%20di%20Avatrash%2C%20untuk%20sampah%20berikut%20%3A%0A
                {{Session::get('sukses')->sampah->nama}}%2C%0A
                Sebanyak%20{{Session::get('sukses')->total_jumlah}}%20x%20{{Session::get('sukses')->sampah->per_angka}}%20{{Session::get('sukses')->sampah->per_satuan}}%2C%20untuk%20ditukar%20dengan%20{{number_format(Session::get('sukses')->total_pembayaran)}}%20Rupiah.%0A
                mohon%20di%20cek%20akun%20avatrash%20anda.%0ATerimakasih%0A
                %23avatrash"><i class="fab fa-whatsapp"></i> Konfirmasi</a>



                {{--  Assalamualaikum%20saya%20telah%20berdonasi%20di%20pada%20kegiatan%20%22{{str_replace(" ","%20",session('data')->proposal->judul)}}%22,%0A
                sebesar%20Rp.{{number_format(session('data')->nominal)}}%20atas%20nama%20{{str_replace(" ","%20",session('data')->nama_donor)}} ..%0A
                %23kongkongpay  --}}

            </div>
        @endif


            <div class="card">
                <div class="card-header pl-3">Transaksi Sampah
                <span class="badge badge-info"><span class="font-weight-normal">Beta</span></span>
                </div>
                <div class="card-body container px-2">


                    {{-- <a href="{{ route('transaksiSampah.create') }}" class="btn btn-outline-primary btn-sm border border-white-50">Tambah +</a>
                    <hr> --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless border border-white-50 table-sm small">
                            <caption class="text-left ">Transaksi sampah bulan {{date('m')}}</caption>
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No</th>
                                    @foreach ($columns as $col)
                                    @if ($col=="created_at")
                                    <th class="text-capitalize">Dibuat tanggal</th>
                                    @else
                                    <th class="text-capitalize">{{ $col }}</th>
                                    @endif
                                    @endforeach

                                    <th >Validasi</th>
                                    <th class="text-right pr-2">Action</th>


                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php $no=0 @endphp
                                @foreach ($transaksiSampah as $transaksiSampah)
                                <tr>
                                    <th>{{ ++$no }}</th>
                                    @foreach ($columns as $col)
                                        @if ($col=="id_sampah")
                                        <td>
                                            <i class="text-success">#{{ $transaksiSampah->$col }}</i> {{ $transaksiSampah->sampah->nama }}
                                        </td>
                                        @elseif ($col=="total_jumlah")
                                        <td>
                                            {{ $transaksiSampah->$col }} x {{ $transaksiSampah->sampah->per_angka }} {{ $transaksiSampah->sampah->per_satuan }}
                                        </td>
                                        @elseif ($col=="created_at")
                                        <td>
                                            {{ $transaksiSampah->$col->format('D, d M Y') }}
                                        </td>
                                        @elseif ($col=="total_pembayaran")
                                            <td>
                                                Rp. {{ number_format($transaksiSampah->$col) }}
                                            </td>
                                        @else
                                        <td>{{ $transaksiSampah->$col }}</td>
                                        @endif
                                    @endforeach

                                    <td>
                                        {!! $transaksiSampah->validasi_pengepul==1?"<span class='badge badge-success'>Pengepul</span>":""!!}
                                        {!! $transaksiSampah->validasi_nasabah==1?"<span class='badge badge-info'>Nasabah</span>":""!!}
                                    </td>


                                    <td class="text-right pr-2 dropdown dropleft">
                                        <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                            ☰
                                        </span>
                                        <div class="dropdown-menu">


                                            @if ($transaksiSampah->validasi_nasabah==1)
                                            <a href="https://api.whatsapp.com/send?phone={{'+62'.$transaksiSampah->sampah->pemilik->user->telepon}}&text=
                                                        Assalamu%27alaikum%0Asaya%20telah%20bertransaksi%20di%20Avatrash%2C%20untuk%20sampah%20berikut%20%3A%0A
                                                        {{$transaksiSampah->sampah->nama}}%2C%0A
                                                        Sebanyak%20{{$transaksiSampah->total_jumlah}}%20x%20{{$transaksiSampah->sampah->per_angka}}%20{{$transaksiSampah->sampah->per_satuan}}%2C%20untuk%20ditukar%20dengan%20{{number_format($transaksiSampah->total_pembayaran)}}%20Rupiah.%0A
                                                        mohon%20di%20cek%20akun%20avatrash%20anda.%0ATerimakasih%0A
                                                        %23avatrash"
                                                class="dropdown-item small text-info" >
                                                <i class="fab fa-whatsapp"></i>
                                                Hubungi
                                            </a>
                                            @endif


                                            <form style="display: inline;" method="post" action="{{ route('transaksiSampah.validasi') }}">
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <input type="hidden" name="id_transaksi" value="{{$transaksiSampah->id}}">
                                                    {{ csrf_field()}}
                                                <button class="dropdown-item small text-success" >
                                                    <i class="fas fa-check"></i>
                                                    Validasi
                                                </button>
                                            </form>

                                            <form style="display: inline;" method="post" action="{{ route('transaksiSampah.destroy', ['id'=>$transaksiSampah->id]) }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field()}}
                                                <button class="dropdown-item small text-danger" >
                                                    <i class="fas fa-window-close"></i>
                                                    Batalkan
                                                </button>
                                            </form>

                                        </div>
                                    </td>




                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>










                    <div class="table-responsive">
                        <table class="table table-striped table-borderless border border-white-50 table-sm small">
                            <caption class="text-left ">History transaksi Sampah</caption>
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No</th>
                                    @foreach ($columns as $col)
                                    @if ($col=="created_at")
                                    <th class="text-capitalize">Dibuat tanggal</th>
                                    @else
                                    <th class="text-capitalize">{{ $col }}</th>
                                    @endif
                                    @endforeach

                                    <th >Validasi</th>
                                    <th class="text-right pr-2">Action</th>


                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php $no=0 @endphp
                                @foreach ($transaksiOld as $transaksiOld)
                                <tr>
                                    <th>{{ ++$no }}</th>
                                    @foreach ($columns as $col)
                                        @if ($col=="id_sampah")
                                        <td>
                                            <i class="text-success">#{{ $transaksiOld->$col }}</i> {{ $transaksiOld->sampah->nama }}
                                        </td>
                                        @elseif ($col=="total_jumlah")
                                        <td>
                                            {{ $transaksiOld->$col }} x {{ $transaksiOld->sampah->per_angka }} {{ $transaksiOld->sampah->per_satuan }}
                                        </td>
                                        @elseif ($col=="created_at")
                                        <td>
                                            {{ $transaksiOld->$col->format('D, d M Y') }}
                                        </td>
                                        @elseif ($col=="total_pembayaran")
                                            <td>
                                                Rp. {{ number_format($transaksiOld->$col) }}
                                            </td>
                                        @else
                                        <td>{{ $transaksiOld->$col }}</td>
                                        @endif
                                    @endforeach

                                    <td>
                                        {!! $transaksiOld->validasi_pengepul==1?"<span class='badge badge-success'>Pengepul</span>":""!!}
                                        {!! $transaksiOld->validasi_nasabah==1?"<span class='badge badge-info'>Nasabah</span>":""!!}
                                    </td>


                                    <td class="text-right pr-2 dropdown dropleft">
                                        <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                            ☰
                                        </span>
                                        <div class="dropdown-menu">


                                            <form style="display: inline;" method="post" action="{{ route('transaksiSampah.destroy', ['id'=>$transaksiOld->id]) }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    {{ csrf_field()}}
                                                <button class="dropdown-item small text-danger" >
                                                    <i class="fas fa-window-close"></i>
                                                    Batalkan
                                                </button>
                                            </form>

                                        </div>
                                    </td>




                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>



        </div>
    </div>
</div>

@endsection

@section('css-halaman')
<style>
    table tbody tr th{
        text-align: center;
        width: 1em;
    }
</style>
@endsection

@section('script-halaman')

@endsection