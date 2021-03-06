@extends('layouts.app',[
'title'=>'Transaksi Reward',
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
                {{Session::get('sukses')->reward->pemilik->user->name}}
                <strong>
                {{Session::get('sukses')->reward->pemilik->user->telepon}}
                </strong>
                <br><br>
                <a class="btn btn-sm btn-info" href="https://api.whatsapp.com/send?phone={{'+62'.Session::get('sukses')->reward->pemilik->user->telepon}}&text=
                Assalamu%27alaikum%20min%2C%20saya%20telah%20bertransaksi%20di%20avatrash%20terimakasih%20%3A%29%0A
                %23avatrash">Konfirmasi</a>

                {{--  Assalamualaikum%20saya%20telah%20berdonasi%20di%20pada%20kegiatan%20%22{{str_replace(" ","%20",session('data')->proposal->judul)}}%22,%0A
                sebesar%20Rp.{{number_format(session('data')->nominal)}}%20atas%20nama%20{{str_replace(" ","%20",session('data')->nama_donor)}} ..%0A
                %23kongkongpay  --}}

            </div>
        @endif


            <div class="card">
                <div class="card-header pl-3">Transaksi Reward</div>
                <div class="card-body container px-2">


                    {{-- <a href="{{ route('transaksiReward.create') }}" class="btn btn-outline-primary btn-sm border border-white-50">Tambah +</a>
                    <hr> --}}
                    <div class="table-responsive">
                    <table class="table table-striped table-borderless border border-white-50 table-sm small">
                            <caption class="text-left ">Daftar history transaksi reward</caption>
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No</th>
                                    @foreach ($columns as $col)
                                    @if ($col=="created_at")
                                    <th class="text-capitalize">Dibuat tanggal</th>
                                    @elseif ($col=="id_reward")
                                    <th class="text-capitalize">Barang</th>
                                    @else
                                    <th class="text-capitalize">{{ $col }}</th>
                                    @endif
                                    @endforeach


                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php $no=0 @endphp
                                @foreach ($transaksiReward as $transaksiReward)
                                <tr>
                                    <th>{{ ++$no }}</th>
                                    @foreach ($columns as $col)
                                        @if ($col=="id_reward")
                                        <td>
                                            <i class="text-success">#{{ $transaksiReward->$col }}</i> {{ $transaksiReward->reward->nama }}
                                        </td>
                                        @elseif ($col=="total_point")
                                        <td class="text-success">{{ $transaksiReward->$col }} pts</td>
                                        @elseif ($col=="created_at")
                                        <td>
                                            {{ $transaksiReward->$col->format('D, d M Y') }}
                                        </td>
                                        @else
                                        <td>{{ $transaksiReward->$col }}</td>
                                        @endif
                                    @endforeach



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