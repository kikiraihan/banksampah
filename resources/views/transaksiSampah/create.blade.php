@extends('layouts.app',[
'title'=>'Transaksi Baru',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header pl-3">New +</div>

                <div class="container">
                    <div class="card-body">

                            {{--
                            'id_nasabah',
                            'id_sampah',
                            'total_point',
                            'total_satuan',
                            --}}

                        <form action="{{ route('transaksiSampah.store') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="put">
                            {{ csrf_field() }}


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="id_nasabah">Nasabah </label>
                                    <div class="col-sm-10">

                                            <select  name="id_nasabah" class="custom-select custom-select-sm {{ $errors->has("id_nasabah") ? ' is-invalid' : '' }}">
                                                <option class="m-2" value="">-Pilih-</option>
                                                @foreach ($nasabah as $n)
                                                    <option class="m-2" value="{{ $n->id }}" {{old("id_nasabah")==$n->id?"selected":"" }}>{{$n->user->name}}</option>
                                                @endforeach
                                            </select>

                                        <span class="invalid-feedback" role="alert">
                                            <strong>*{{ $errors->first('id_nasabah') }}</strong>
                                        </span>

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="id_sampah">Jenis Sampah</label>
                                    <div class="col-sm-10">

                                            <select name="id_sampah" class="custom-select custom-select-sm {{ $errors->has("id_sampah") ? ' is-invalid' : '' }}">
                                                <option class="m-2" value="">-Pilih-</option>
                                                @foreach ($sampah as $sampah)
                                                    <option class="m-2" value="{{ $sampah->id }}" {{old("id_sampah")==$sampah->id?"selected":"" }}>{{$sampah->nama}}</option>
                                                @endforeach
                                            </select>

                                        <span class="invalid-feedback" role="alert">
                                            <strong>*{{ $errors->first('id_sampah') }}</strong>
                                        </span>

                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="total_satuan">Total Satuan</label>
                                    <div class="col-sm-10">

                                        <input name="total_satuan" type="text" class="form-control form-control-sm
                                        {{ $errors->has('total_satuan') ? ' is-invalid' : '' }}" value="{{ old('total_satuan') }}"
                                        id="total_satuan" placeholder="kg, gram, ..">

                                        <span class="invalid-feedback" role="alert">
                                            <strong>*{{ $errors->first('total_satuan') }}</strong>
                                        </span>
                                    </div>
                                </div>



                                {{-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="total_point">Point yang diterima</label>
                                    <div class="col-sm-10">

                                        <input name="total_point" type="text" class="form-control form-control-sm
                                        {{ $errors->has('total_point') ? ' is-invalid' : '' }}" value="{{ old('total_point') }}"
                                        id="total_point" placeholder="total point yang diterima">

                                        <span class="invalid-feedback" role="alert">
                                            <strong>*{{ $errors->first('total_point') }}</strong>
                                        </span>
                                    </div>
                                </div> --}}



                            <div class="row">
                                <button type='submit' class='mt-3  btn btn-sm btn-secondary'>Create</button>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css-halaman')

@endsection

@section('script-halaman')



@endsection