@extends('layouts.app',[
'title'=>'Transaksi Sampah',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">


            <div class="card">
                <div class="card-header pl-3">Transaksi Sampah</div>
                <div class="card-body container">


                    {{-- <a href="{{ route('transaksiSampah.create') }}" class="btn btn-outline-primary btn-sm border border-white-50">Tambah +</a>
                    <hr> --}}
                    <table class="table table-striped table-borderless border border-white-50 table-sm small">
                            <caption class="text-left ">Daftar history transaksi Sampah</caption>
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No</th>
                                    @foreach ($columns as $col)
                                    @if ($col=="created_at")
                                    <th class="text-capitalize">Dibuat tanggal</th>
                                    @elseif ($col=='total_point')
                                    <th class="text-capitalize">Total point yang ditambahkan</th>
                                    @else
                                    <th class="text-capitalize">{{ $col }}</th>
                                    @endif
                                    @endforeach


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
                                        @elseif ($col=="total_point")
                                        <td class="text-success">
                                            {{ $transaksiSampah->$col }} pts
                                        </td>
                                        @elseif ($col=="total_satuan")
                                        <td>
                                            {{ $transaksiSampah->$col }} {{ $transaksiSampah->sampah->satuan }}
                                        </td>
                                        @elseif ($col=="created_at")
                                        <td>
                                            {{ $transaksiSampah->$col->format('D, d M Y') }}
                                        </td>
                                        @else
                                        <td>{{ $transaksiSampah->$col }}</td>
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