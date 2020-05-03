@extends('layouts.app',[
'title'=>'Transaksi Sampah',
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
                <div class="card-header pl-3">Transaksi Sampah</div>
                <div class="card-body container px-2">


                    @role('Pengepul')
                    <a href="{{ route('transaksiSampah.create') }}" class="btn btn-outline-primary btn-sm border border-white-50">Tambah Manual +</a>
                    <hr>
                    @endrole

                        <div class="table-responsive">
                            <table class="table table-striped table-borderless border border-white-50 table-sm small">
                                <caption class="text-left ">Daftar history transaksi Sampah</caption>
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th>No</th>
                                        @foreach ($columns as $col)
                                        @if ($col=='total_point')
                                        <th class="text-capitalize">Total point yang ditambahkan</th>
                                        @else
                                        <th class="text-capitalize">{{ $col }}</th>
                                        @endif
                                        @endforeach

                                        <th class="text-right pr-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php $no=0 @endphp
                                    @foreach ($transaksiSampah as $transaksiSampah)
                                    <tr>
                                        <th>{{ ++$no }}</th>
                                        @foreach ($columns as $col)
                                            @if ($col=="id_nasabah")
                                            <td>
                                                <i class="text-success">#{{ $transaksiSampah->$col }}</i> {{ $transaksiSampah->nasabah->user->name }}
                                            </td>
                                            @elseif ($col=="id_sampah")
                                            <td>
                                                <i class="text-success">#{{ $transaksiSampah->$col }}</i> {{ $transaksiSampah->sampah->nama }}
                                            </td>
                                            @elseif ($col=="total_jumlah")
                                            <td>
                                                {{ $transaksiSampah->$col }} {{ $transaksiSampah->sampah->satuan }}
                                            </td>
                                            @else
                                            <td>{{ $transaksiSampah->$col }}</td>
                                            @endif
                                        @endforeach

                                        <td class="text-right pr-2 dropdown dropleft">

                                                <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                                    ☰
                                                </span>
                                                <div class="dropdown-menu">

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
                                <caption class="text-left text-success">Divalidasi / sudah dibayarkan</caption>
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th>No</th>
                                        @foreach ($columns as $col)
                                        @if ($col=='total_point')
                                        <th class="text-capitalize">Total point yang ditambahkan</th>
                                        @else
                                        <th class="text-capitalize">{{ $col }}</th>
                                        @endif
                                        @endforeach

                                        <th class="text-right pr-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php $no=0 @endphp
                                    @foreach ($transaksiValid as $transaksiValid)
                                    <tr>
                                        <th>{{ ++$no }}</th>
                                        @foreach ($columns as $col)
                                            @if ($col=="id_nasabah")
                                            <td>
                                                <i class="text-success">#{{ $transaksiValid->$col }}</i> {{ $transaksiValid->nasabah->user->name }}
                                            </td>
                                            @elseif ($col=="id_sampah")
                                            <td>
                                                <i class="text-success">#{{ $transaksiValid->$col }}</i> {{ $transaksiValid->sampah->nama }}
                                            </td>
                                            @elseif ($col=="total_jumlah")
                                            <td>
                                                {{ $transaksiValid->$col }} {{ $transaksiValid->sampah->satuan }}
                                            </td>
                                            @else
                                            <td>{{ $transaksiValid->$col }}</td>
                                            @endif
                                        @endforeach

                                        <td class="text-right pr-2 dropdown dropleft">

                                                <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                                    ☰
                                                </span>
                                                <div class="dropdown-menu">

                                                    <form style="display: inline;" method="post" action="{{ route('transaksiSampah.validasi.batal') }}">
                                                            <input type="hidden" name="_method" value="PUT">
                                                            <input type="hidden" name="id_transaksi" value="{{$transaksiValid->id}}">
                                                            {{ csrf_field()}}
                                                        <button class="dropdown-item small text-danger" >
                                                            <i class="fas fa-window-close"></i>
                                                            Batalkan Validasi
                                                        </button>
                                                    </form>

                                                    {{-- <form style="display: inline;" method="post" action="{{ route('transaksiSampah.destroy', ['id'=>$transaksiValid->id]) }}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            {{ csrf_field()}}
                                                        <button class="dropdown-item small text-danger" >
                                                            <i class="fas fa-window-close"></i>
                                                            Batalkan
                                                        </button>
                                                    </form> --}}

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