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


                        <h3 class="h4 text-black mb-4">Register</h3>
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
                            <select  name="provinsi" class="custom-select custom-select {{ $errors->has("provinsi") ? ' is-invalid' : '' }}">
                                <option class="m-2" value="">-Pilih Provinsi-</option>
                                <option class="m-2" value="Aceh" {{old("provinsi")=="Aceh"?"selected":"" }}>Aceh</option>
                                <option class="m-2" value="Sumatera Utara" {{old("provinsi")=="Sumatera Utara"?"selected":"" }}>Sumatera Utara (Sumut)</option>
                                <option class="m-2" value="Sumatera Barat" {{old("provinsi")=="Sumatera Barat"?"selected":"" }}>Sumatera Barat (Sumbar)</option>
                                <option class="m-2" value="Riau" {{old("provinsi")=="Riau"?"selected":"" }}>Riau</option>
                                <option class="m-2" value="Kepulauan Riau" {{old("provinsi")=="Kepulauan Riau"?"selected":"" }}>Kepulauan Riau (Kepri)</option>
                                <option class="m-2" value="Jambi" {{old("provinsi")=="Jambi"?"selected":"" }}>Jambi</option>
                                <option class="m-2" value="Bengkulu" {{old("provinsi")=="Bengkulu"?"selected":"" }}>Bengkulu</option>
                                <option class="m-2" value="Sumatera Selatan" {{old("provinsi")=="Sumatera Selatan"?"selected":"" }}>Sumatera Selatan (Sumsel)</option>
                                <option class="m-2" value="Kepulauan Bangka Belitung" {{old("provinsi")=="Kepulauan Bangka Belitung"?"selected":"" }}>Kepulauan Bangka Belitung</option>
                                <option class="m-2" value="Lampung" {{old("provinsi")=="Lampung"?"selected":"" }}>Lampung</option>
                                <option class="m-2" value="Banten" {{old("provinsi")=="Banten"?"selected":"" }}>Banten</option>
                                <option class="m-2" value="Jawa Barat" {{old("provinsi")=="Jawa Barat"?"selected":"" }}>Jawa Barat (Jabar)</option>
                                <option class="m-2" value="DKI Jakarta" {{old("provinsi")=="DKI Jakarta"?"selected":"" }}>DKI Jakarta</option>
                                <option class="m-2" value="Jawa Tengah" {{old("provinsi")=="Jawa Tengah"?"selected":"" }}>Jawa Tengah (Jateng)</option>
                                <option class="m-2" value="Yogyakarta" {{old("provinsi")=="Yogyakarta"?"selected":"" }}>Yogyakarta</option>
                                <option class="m-2" value="Jawa Timur" {{old("provinsi")=="Jawa Timur"?"selected":"" }}>Jawa Timur (Jatim)</option>
                                <option class="m-2" value="Bali" {{old("provinsi")=="Bali"?"selected":"" }}>Bali</option>
                                <option class="m-2" value="Nusa Tenggara Barat" {{old("provinsi")=="Nusa Tenggara Barat"?"selected":"" }}>Nusa Tenggara Barat (NTB)</option>
                                <option class="m-2" value="Nusa Tenggara Timur" {{old("provinsi")=="Nusa Tenggara Timur"?"selected":"" }}>Nusa Tenggara Timur (NTT)</option>
                                <option class="m-2" value="Kalimantan Utara" {{old("provinsi")=="Kalimantan Utara"?"selected":"" }}>Kalimantan Utara (Kaltara)</option>
                                <option class="m-2" value="Kalimantan Barat" {{old("provinsi")=="Kalimantan Barat"?"selected":"" }}>Kalimantan Barat (Kalbar)</option>
                                <option class="m-2" value="Kalimantan Tengah" {{old("provinsi")=="Kalimantan Tengah"?"selected":"" }}>Kalimantan Tengah (Kalteng)</option>
                                <option class="m-2" value="Kalimantan Selatan" {{old("provinsi")=="Kalimantan Selatan"?"selected":"" }}>Kalimantan Selatan (Kalsel)</option>
                                <option class="m-2" value="Kalimantan Timur" {{old("provinsi")=="Kalimantan Timur"?"selected":"" }}>Kalimantan Timur (Kaltim)</option>
                                <option class="m-2" value="Gorontalo" {{old("provinsi")=="Gorontalo"?"selected":"" }}>Gorontalo</option>
                                <option class="m-2" value="Sulawesi Utara" {{old("provinsi")=="Sulawesi Utara"?"selected":"" }}>Sulawesi Utara (Sulut)</option>
                                <option class="m-2" value="Sulawesi Barat" {{old("provinsi")=="Sulawesi Barat"?"selected":"" }}>Sulawesi Barat (Sulbar)</option>
                                <option class="m-2" value="Sulawesi Tengah" {{old("provinsi")=="Sulawesi Tengah"?"selected":"" }}>Sulawesi Tengah (Sulteng)</option>
                                <option class="m-2" value="Sulawesi Selatan" {{old("provinsi")=="Sulawesi Selatan"?"selected":"" }}>Sulawesi Selatan (Sulsel)</option>
                                <option class="m-2" value="Sulawesi Tenggara" {{old("provinsi")=="Sulawesi Tenggara"?"selected":"" }}>Sulawesi Tenggara (Sultra)</option>
                                <option class="m-2" value="Maluku Utara" {{old("provinsi")=="Maluku Utara"?"selected":"" }}>Maluku Utara</option>
                                <option class="m-2" value="Maluku" {{old("provinsi")=="Maluku"?"selected":"" }}>Maluku</option>
                                <option class="m-2" value="Papua" {{old("provinsi")=="Papua"?"selected":"" }}>Papua</option>
                                <option class="m-2" value="Papua Barat" {{old("provinsi")=="Papua Barat"?"selected":"" }}>Papua Barat</option>
                            </select>
                            @if ($errors->has('provinsi'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('provinsi') }}</strong>
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
                        <input name="dusun" value="{{ old('dusun') }}" type="text" class="form-control  {{ $errors->has('dusun') ? ' is-invalid' : '' }}" placeholder="Dusun" >
                        <span class="small text-muted">
                        *optional
                        </span>
                        @if ($errors->has('dusun'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dusun') }}</strong>
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
                        <input name="username" value="{{ old('username') }}" type="text" class="form-control  {{ $errors->has('dusun') ? ' is-invalid' : '' }}" placeholder="Username" >
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                        </div>

                        <div class="form-group">
                        <input name="password" value="{{ old('password') }}" type="password" class="form-control  {{ $errors->has('dusun') ? ' is-invalid' : '' }}" placeholder="Password" >
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>

                        <div class="form-group">
                        <input id="password-confirm" value="{{ old('password') }}" type="password" class="form-control  {{ $errors->has('dusun') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="Retype Password" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                        </div>

                        <div class="form-group-row">
                        <div class="row no-gutters">
                        <span class="col-6 p-1"><a href="{{ route('landing_page') }}" class="btn btn-outline-secondary w-100 btn-pill" >Kembali</a></span>
                        <span class="col-6 p-1"><input type="submit" class="text-white btn btn-success w-100 btn-pill" value="Register"></span>
                        </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>







    </div>
</div>
@endsection



