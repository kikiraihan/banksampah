@extends('layouts.app',[
'title'=>'Transaksi Reward',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">

        @if ($errors->any())
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-warning"></i> <b>There is an some invalid</b>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


            <div class="card">
                <div class="card-header pl-3">Transaksi Reward</div>
                <div class="card-body container">


                    {{--  @role('Member')
                    <a href="{{ route('transaksiReward.create') }}" class="btn btn-outline-primary btn-sm border border-white-50">Tambah Manual +</a>
                    <hr>
                    @endrole  --}}

                    <div class="table-responsive">
                        <table class="table table-striped table-borderless border border-white-50 table-sm small">
                            <caption class="text-left ">Daftar history transaksi reward</caption>
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No</th>
                                    @foreach ($columns as $col)
                                    <th class="text-capitalize">{{ $col }}</th>
                                    @endforeach

                                    <th class="text-right pr-2">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php $no=0 @endphp
                                @foreach ($transaksiReward as $transaksiReward)
                                <tr>
                                    <th>{{ ++$no }}</th>
                                    @foreach ($columns as $col)
                                        @if ($col=="id_nasabah")
                                        <td>
                                            <i class="text-success">#{{ $transaksiReward->$col }}</i> {{ $transaksiReward->nasabah->user->name }}
                                        </td>
                                        @elseif ($col=="id_reward")
                                        <td>
                                            <i class="text-success">#{{ $transaksiReward->$col }}</i> {{ $transaksiReward->reward->nama }}
                                        </td>
                                        @else
                                        <td>{{ $transaksiReward->$col }}</td>
                                        @endif
                                    @endforeach

                                    <td class="text-right pr-2 dropdown dropleft">

                                            <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                                ☰
                                            </span>
                                            <div class="dropdown-menu">

                                                <form style="display: inline;" method="post" action="{{ route('transaksiReward.validasi') }}">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="id_transaksi" value="{{$transaksiReward->id}}">
                                                        {{ csrf_field()}}
                                                    <button class="dropdown-item small text-success" >
                                                        <i class="fas fa-check"></i>
                                                        Validasi
                                                    </button>
                                                </form>

                                                <form style="display: inline;" method="post" action="{{ route('transaksiReward.destroy', ['id'=>$transaksiReward->id]) }}">
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
                            <caption class="text-left ">Divalidasi</caption>
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No</th>
                                    @foreach ($columns as $col)
                                    <th class="text-capitalize">{{ $col }}</th>
                                    @endforeach

                                    <th class="text-right pr-2">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php $no=0 @endphp
                                @foreach ($transaksiValid as $tvalid)
                                <tr>
                                    <th>{{ ++$no }}</th>
                                    @foreach ($columns as $col)
                                        @if ($col=="id_nasabah")
                                        <td>
                                            <i class="text-success">#{{ $tvalid->$col }}</i> {{ $tvalid->nasabah->user->name }}
                                        </td>
                                        @elseif ($col=="id_reward")
                                        <td>
                                            <i class="text-success">#{{ $tvalid->$col }}</i> {{ $tvalid->reward->nama }}
                                        </td>
                                        @else
                                        <td>{{ $tvalid->$col }}</td>
                                        @endif
                                    @endforeach

                                    <td class="text-right pr-2 dropdown dropleft">

                                            <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                                ☰
                                            </span>
                                            <div class="dropdown-menu">

                                                <form style="display: inline;" method="post" action="{{ route('transaksiReward.validasi') }}">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="id_transaksi" value="{{$tvalid->id}}">
                                                        {{ csrf_field()}}
                                                    <button class="dropdown-item small text-success" >
                                                        <i class="fas fa-check"></i>
                                                        Validasi
                                                    </button>
                                                </form>

                                                <form style="display: inline;" method="post" action="{{ route('transaksiReward.destroy', ['id'=>$tvalid->id]) }}">
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