@extends('layouts.app',[
    'title'=>'register',
    'bodyStyle'=>""
])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{--  <div class="card-header">{{ __('Register') }}</div>  --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf


                        <h3 class="h4 text-black mb-4">Mendaftar</h3>
                        <div class="form-group">
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control  {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nama" >
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="form-group">
                        <input name="email" value="{{ old('email') }}" type="text" class="form-control  {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" >
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="form-group">
                        <input name="telepon" value="{{ old('telepon') }}" type="text" class="form-control  {{ $errors->has('telepon') ? ' is-invalid' : '' }}" placeholder="Nomor Whatsapp" >
                        @if ($errors->has('telepon'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('telepon') }}</strong>
                            </span>
                        @endif
                        </div>


                        <div class="form-group">
                            <input  name="ktp" value="{{ old('ktp') }}" type="text" class="form-control {{ $errors->has('ktp') ? ' is-invalid' : '' }}" placeholder="No KTP " >
                            <span class="small text-muted">
                            *optional
                            </span>
                            @if ($errors->has('ktp'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ktp') }}</strong>
                                </span>
                            @endif
                        </div>



                        <div class="form-group">
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
                        <div class="form-group">
                            <select class="form-control {{ $errors->has("kota") ? ' is-invalid' : '' }}" name="kota" id="kota">
                                <option></option>
                            </select>
                            @if ($errors->has('kota'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('kota') }}</strong>
                            </span>
                            @endif
                            <img src="{{ asset('assets-wilayah-indonesia/img/loading.gif') }}" width="35" id="load2" style="display:none;" />

                        </div>
                        <div class="form-group">
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
                        <div class="form-group">
                            <select class="form-control {{ $errors->has("kelurahan") ? ' is-invalid' : '' }}" name="kelurahan" id="kelurahan">
                                <option></option>
                            </select>
                            @if ($errors->has('kelurahan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('kelurahan') }}</strong>
                            </span>
                            @endif
                        </div>



                        <div class="form-group">
                            <textarea  name="alamat" class="form-control  {{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="Alamat" rows=4>{{ old('ktp') }}</textarea>
                            @if ($errors->has('alamat'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                            @endif
                        </div>



                        <div class="form-group">
                        <input name="username" value="{{ old('username') }}" type="text" class="form-control  {{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="Username" >
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                        </div>

                        <div class="form-group">
                        <input name="password" value="{{ old('password') }}" type="password" class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" >
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>

                        <div class="form-group">
                        <input id="password-confirm" value="{{ old('password') }}" type="password" class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="Retype Password" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                        </div>







                        <div class="form-group-row">
                        <div class="row no-gutters">
                        <span class="p-1 col-6"><a href="{{ route('login') }}" class="btn btn-outline-secondary w-100 btn-pill" >< Kembali</a>
                        </span>
                        <span class="p-1 col-6"><input type="submit" class="btn btn-success w-100 btn-pill" value="Kirim >"></span>
                        </div>
                        </div>









                    </form>
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
