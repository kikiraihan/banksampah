@extends('layouts.app',[
'title'=>'Jenis Sampah',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header pl-3">Jenis Sampah</div>
                <div class="card-body container px-2">


                    @role('Pengepul')
                    <a href="{{ route('sampah.create') }}" class="btn btn-outline-primary btn-sm border border-white-50">Tambah +</a>
                    <hr>
                    @endrole
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless border border-white-50 table-sm small">
                            <caption class="text-left ">Data jenis sampah yang akan diterima</caption>
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
                                @foreach ($sampah as $sampah)
                                <tr>
                                    <th>{{ ++$no }}</th>
                                    @foreach ($columns as $col)
                                        @if ($col=="deskripsi")
                                        <td class="text-left" >{{ str_limit($sampah->$col, 83) }}</td>
                                        @elseif ($col=="satuan")
                                        <td >/{{ $sampah->$col }}</td>
                                        @elseif ($col=="point")
                                        <td class="text-success">{{ $sampah->$col }} pts</td>
                                        @elseif ($col=="id_pengepul")
                                        <td class="text-info">{{ $sampah->pemilik->user->name }} : {{ $sampah->pemilik->user->telepon }}</td>
                                        @else
                                        <td >{{ $sampah->$col }}</td>
                                        @endif
                                    @endforeach

                                    <td class="text-right pr-2 dropdown dropleft">

                                            <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                                ☰
                                            </span>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item small" href="{{ route('sampah.edit', ['id'=>$sampah->id]) }}">
                                                    <i class="far fa-edit"></i>
                                                    Edit
                                                </a>

                                                <form style="display: inline;" method="post" action="{{ route('sampah.destroy', ['id'=>$sampah->id]) }}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        {{ csrf_field()}}
                                                    <button class="dropdown-item small text-danger" >
                                                        {{-- <i class="fas fa-trash-alt"></i> --}}
                                                        <i class="far fa-trash-alt"></i>
                                                        Hapus
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