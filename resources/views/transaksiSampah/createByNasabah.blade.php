@extends('layouts.app',[
'title'=>'Transaksi Baru : Nasabah',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">


            <div class="row no-gutters">
            @foreach ($sampah as $s)
            <div class="col-md-3 p-1">
                <div class="card">


                    <ul class="list-group list-group-flush small ">
                        <li class="list-group-item">
                        <h4 class="card-title mb-0">{{$s->nama}}</h4>
                        {{-- <small class="card-subtitle mb-2 text-muted"><small><b>{{$s->pemilik->user->name}} - </b>{{$s->pemilik->alamat}}</small></small> --}}
                        <small class="card-subtitle mb-2 text-muted">{{$s->point}} point/{{$s->satuan}}</small>
                        </li>
                        {{-- <li class="list-group-item">{{$s->pemilik->user->name}} - {{$s->pemilik->provinsi}} </li> --}}
                        {{-- <li class="list-group-item ">{{$s->point}} point/{{$s->satuan}}</li> --}}
                        <li class="list-group-item"><b> Deskripsi :</b><p class="card-text small">
                        {{$s->deskripsi}}
                        </p></li>
                        <li class="list-group-item"><p class="card-text small">
                        <b> {{$s->pemilik->user->name}} - </b>{{$s->pemilik->alamat}}
                        </p></li>
                    </ul>
                    <div class="card-body">
                    <form action="{{ route('transaksiSampahByNasabah.store') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="put">
                        <input type="hidden" name="id_sampah" value="{{$s->id}}">
                        {{ csrf_field() }}



                            <div class="form-group">
                                <label class="text-capitalize" for="total_satuan">Total Satuan</label>
                                <input name="total_satuan" type="number" class="form-control form-control-sm
                                    {{ $errors->has('total_satuan') ? ' is-invalid' : '' }}" value="{{ old('total_satuan') }}"
                                    id="total_satuan" placeholder="kg, gram, ..">

                                <span class="invalid-feedback" role="alert">
                                    <strong>*{{ $errors->first('total_satuan') }}</strong>
                                </span>
                            </div>



                        <div class="row">
                            <button type='submit' class='mt-3  btn btn-sm btn-block btn-secondary'>Order</button>
                        </div>


                    </form>
                    </div>
                </div>

            </div>

            @endforeach
            </div>





        </div>
    </div>
</div>

@endsection

@section('css-halaman')

@endsection

@section('script-halaman')



@endsection