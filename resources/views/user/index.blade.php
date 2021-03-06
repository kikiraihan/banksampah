@extends('layouts.app',[
'title'=>'User',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header pl-3">All User </div>
                <div class="card-body container">


                    @role('Admin')
                    <a href="{{ route('user.create',['kategori'=>'Admin']) }}"
                        class="btn btn-outline-primary btn-sm border border-white-50">Tambah +</a>
                    <hr>
                    <div class="table-responsive">
                    <table class="table table-striped table-borderless border border-white-50 table-sm small">
                        <caption class="text-left ">Data setiap admin</caption>
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
                            @foreach ($admin as $admin)
                            <tr>
                                <th>{{ ++$no }}</th>
                                @if(isset($admin))
                                @foreach ($columns as $col)
                                <td>{{ $admin->$col }}</td>
                                @endforeach
                                @endif

                                <td class="text-right pr-2 dropdown dropleft">

                                    <span class="btn btn-sm btn-light" data-toggle="dropdown">
                                        ☰
                                    </span>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item small py-3"
                                            href="{{ route('user.edit', ['id'=>$admin->id]) }}">
                                            <i class="far fa-edit"></i>
                                            Edit
                                        </a>

                                        <form style="display: inline;" method="post"
                                            action="{{ route('user.destroy', ['id'=>$admin->id]) }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field()}}
                                            <button class="dropdown-item small py-3 text-danger">
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
                    @endrole

                    <a href="{{ route('user.create',['kategori'=>'Nasabah']) }}"
                        class="btn btn-outline-primary btn-sm border border-white-50">Tambah +</a>
                    <hr>

                    <div class="table-responsive">
                    <table class="table table-striped table-borderless border border-white-50 table-sm small">
                        <caption class="text-left ">Data setiap nasabah @role('Pengepul') di provinsi anda @endrole</caption>
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>
                                @foreach ($columns as $col)
                                <th class="text-capitalize">{{ $col }}</th>
                                @endforeach

                                <th>Saldo</th>
                                <th>Provinsi</th>
                                <th class="text-right pr-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php $no=0 @endphp

                            @if (isset($nasabah))
                                @foreach ($nasabah as $nasabah)
                                <tr>
                                    <th>{{ ++$no }}</th>
                                    @foreach ($columns as $col)
                                    <td>{{ $nasabah->$col }}</td>
                                    @endforeach

                                    <td class="text-success">{{ $nasabah->nasabah->saldo }} pts</td>
                                    <td>{{ $nasabah->nasabah->provinsi }}</td>

                                    <td class="text-right pr-2 dropdown dropleft">

                                        <span class="btn btn-sm btn-light" data-toggle="dropdown">
                                            ☰
                                        </span>
                                        <div class="dropdown-menu">

                                            <a class="dropdown-item small py-3"
                                                href="{{ route('user.edit', ['id'=>$nasabah->id]) }}">
                                                <i class="far fa-edit"></i>
                                                Edit
                                            </a>

                                            <form style="display: inline;" method="post"
                                                action="{{ route('user.destroy', ['id'=>$nasabah->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field()}}
                                                <button class="dropdown-item small py-3 text-danger">Hapus</button>
                                            </form>


                                        </div>

                                    </td>


                                </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                    </div>



                    <a href="{{ route('user.create',['kategori'=>'Pengepul']) }}"
                        class="btn btn-outline-primary btn-sm border border-white-50">Tambah +</a>
                    <hr>

                    <div class="table-responsive">
                    <table class="table table-striped table-borderless border border-white-50 table-sm small">
                        <caption class="text-left ">Data setiap Pengepul Avatar / Pengepul</caption>
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>
                                @foreach ($columns as $col)
                                <th class="text-capitalize">{{ $col }}</th>
                                @endforeach

                                <th>Provinsi</th>
                                <th class="text-right pr-2">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php $no=0 @endphp
                            @if(isset($pengepul))
                                @foreach ($pengepul as $pengepul)
                                <tr>
                                    <th>{{ ++$no }}</th>
                                    @foreach ($columns as $col)
                                    <td>{{ $pengepul->$col }}</td>
                                    @endforeach

                                    <td>{{ $pengepul->pengepul->provinsi }}</td>

                                    <td class="text-right pr-2 dropdown dropleft">

                                        <span class="btn btn-sm btn-light" data-toggle="dropdown">
                                            ☰
                                        </span>
                                        <div class="dropdown-menu">

                                            <a class="dropdown-item small py-3"
                                                href="{{ route('user.edit', ['id'=>$pengepul->id]) }}">
                                                <i class="far fa-edit"></i>
                                                Edit
                                            </a>

                                            <form style="display: inline;" method="post"
                                                action="{{ route('user.destroy', ['id'=>$pengepul->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field()}}
                                                <button class="dropdown-item small py-3 text-danger">Hapus</button>
                                            </form>


                                        </div>

                                    </td>


                                </tr>
                                @endforeach
                            @endif

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
    table tbody tr th {
        text-align: center;
        width: 1em;
    }
</style>
@endsection

@section('script-halaman')

@endsection