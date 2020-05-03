@extends('layouts.app',[
'title'=>'Buat User',
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

                        <form action="{{ route('user.store') }}" method="post">
                            <input type="hidden" name="_method" value="put">
                            {{ csrf_field() }}

                            @foreach ($columns as $col)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="{{$col}}">{{$col}} </label>
                                    <div class="col-sm-10">

                                        @if ($col=='kategori')

                                            {{-- <select  name="{{$col}}" class="custom-select custom-select-sm {{ $errors->has($col) ? ' is-invalid' : '' }}">
                                                <option class="m-2" value="">-Pilih-</option>
                                                <option class="m-2" value="Nasabah" {{old($col)=="Nasabah"?"selected":"" }}>Nasabah</option>
                                                <option class="m-2" value="Admin" {{old($col)=="Admin"?"selected":"" }}>Admin</option>
                                            </select> --}}

                                            <input type="text" disabled
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ $kategori }}"
                                            id="{{$col}}" placeholder="Masukan {{$col}}">

                                            <input name="{{$col}}" type="text" hidden value="{{ $kategori }}"
                                            id="{{$col}}" placeholder="Masukan {{$col}}">

                                        @elseif ($col=='password')
                                            <input name="{{$col}}" type="password"
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col) }}"
                                            id="{{$col}}" placeholder="Masukan {{$col}}">
                                        @elseif ($col=='ktp')
                                            <input name="{{$col}}" type="text"
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col) }}"
                                            id="{{$col}}" placeholder="Masukan {{$col}}">
                                            <span class="text-muted small" role="alert">
                                                *optional
                                            </span>
                                        @elseif ($col=='alamat')
                                            <textarea name="{{$col}}" type="password" class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}"
                                                id="{{$col}}" placeholder="Masukan {{$col}}" cols="30" rows="10">{{ old($col) }}</textarea>
                                        @else
                                            <input name="{{$col}}" type="text"
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col) }}"
                                            id="{{$col}}" placeholder="Masukan {{$col}}">
                                        @endif

                                        @if ($errors->has($col))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>*{{ $errors->first($col) }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            @endforeach



                        @if($kategori!="Admin")
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="provinsi">Provinsi </label>
                            <div class="col-sm-10">
                            <select class="form-control {{ $errors->has("provinsi") ? ' is-invalid' : '' }}" name="provinsi" id="provinsi">
                                <option></option>

                                @foreach ($sql_provinsi as $rs_provinsi)
                                    <option value="{{$rs_provinsi->id}}" {{old("kota")==$rs_provinsi->id?"selected":"" }}>{{$rs_provinsi->name}}</option>;
                                @endforeach
                            </select>
                            @if ($errors->has('provinsi'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('provinsi') }}</strong>
                            </span>
                            @endif
                            <img src="{{ asset('assets-wilayah-indonesia/img/loading.gif') }}" width="35" id="load1" style="display:none;" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="kota">Kota / Kabupaten </label>
                            <div class="col-sm-10">
                                <select class="form-control {{ $errors->has("kota") ? ' is-invalid' : '' }}" name="kota" id="kota">
                                    {{--  <option value="{{old('kota')}}" selected>{{old('kota')}}</option>;  --}}
                                    <option></option>;
                                </select>
                                @if ($errors->has('kota'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('kota') }}</strong>
                                </span>
                                @endif
                                <img src="{{ asset('assets-wilayah-indonesia/img/loading.gif') }}" width="35" id="load2" style="display:none;" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="kecamatan">Kecamatan </label>
                            <div class="col-sm-10">
                                <select class="form-control {{ $errors->has("kecamatan") ? ' is-invalid' : '' }}" name="kecamatan" id="kecamatan">
                                    <option></option>
                                </select>
                                @if ($errors->has('kecamatan'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('kecamatan') }}</strong>
                                </span>
                                @endif
                                <img src="{{ asset('assets-wilayah-indonesia/img/loading.gif') }}" width="35" id="load3" style="display:none;" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="kelurahan">Kelurahan </label>
                            <div class="col-sm-10">
                                <select class="form-control {{ $errors->has("kelurahan") ? ' is-invalid' : '' }}" name="kelurahan" id="kelurahan">
                                    <option></option>
                                </select>
                                @if ($errors->has('kelurahan'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('kelurahan') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @endif


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
  <link rel="stylesheet" href="{{ asset('assets-wilayah-indonesia/select2-4.0.6-rc.1/dist/css/select2.min.css') }}">
@endsection

@section('script-halaman')
  {{--  <script src="{{ asset('assets-wilayah-indonesia/jquery/jquery-3.3.1.min.js') }}"></script>  --}}
  {{--  <script src="{{ asset('assets-wilayah-indonesia/bootstrap-3.3.7/dist/js/bootstrap.min.js') }}"></script>  --}}
  <script src="{{ asset('assets-wilayah-indonesia/select2-4.0.6-rc.1/dist/js/select2.min.js') }}"></script>
  <script src="{{ asset('assets-wilayah-indonesia/select2-4.0.6-rc.1/dist/js/i18n/id.js') }}"></script>
  <script src="{{ asset('assets-wilayah-indonesia/js/app.js') }}"></script>
@endsection