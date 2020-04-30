@extends('layouts.app',[
'title'=>'Update User',
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

                        <form action="{{ route('user.update', ['id'=>$user->id]) }}" method="post">
                            <input type="hidden" name="_method" value="put">
                            {{ csrf_field() }}
                            <input name="id_kategori" type="text" hidden value="{{ $user->katget->id }}">

                            @foreach ($columns as $col)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="{{$col}}">{{$col}} </label>
                                    <div class="col-sm-10">

                                        @if ($col=='kategori')
                                            <select disabled class="custom-select custom-select-sm {{ $errors->has($col) ? ' is-invalid' : '' }}">
                                                <option class="m-2" value="">-Pilih-</option>
                                                <option class="m-2" value="Nasabah" {{old($col,$user->$col) =="Nasabah"?"selected":"" }}>Nasabah</option>
                                                <option class="m-2" value="Admin" {{old($col,$user->$col) =="Admin"?"selected":"" }}>Admin</option>
                                                <option class="m-2" value="Member" {{old($col,$user->$col) =="Member"?"selected":"" }}>Member</option>
                                            </select>

                                            <input name="{{$col}}" type="text" hidden value="{{ $user->kategori }}"id="{{$col}}">


                                        @elseif ($col=='provinsi')
                                            <select  name="{{$col}}" class="custom-select custom-select-sm {{ $errors->has($col) ? ' is-invalid' : '' }}">
                                                <option class="m-2" value="">-Pilih-</option>
                                                <option class="m-2" value="Aceh" {{old($col,$user->katget->$col)=="Aceh"?"selected":"" }}>Aceh</option>
                                                <option class="m-2" value="Sumatera Utara" {{old($col,$user->katget->$col)=="Sumatera Utara"?"selected":"" }}>Sumatera Utara (Sumut)</option>
                                                <option class="m-2" value="Sumatera Barat" {{old($col,$user->katget->$col)=="Sumatera Barat"?"selected":"" }}>Sumatera Barat (Sumbar)</option>
                                                <option class="m-2" value="Riau" {{old($col,$user->katget->$col)=="Riau"?"selected":"" }}>Riau</option>
                                                <option class="m-2" value="Kepulauan Riau" {{old($col,$user->katget->$col)=="Kepulauan Riau"?"selected":"" }}>Kepulauan Riau (Kepri)</option>
                                                <option class="m-2" value="Jambi" {{old($col,$user->katget->$col)=="Jambi"?"selected":"" }}>Jambi</option>
                                                <option class="m-2" value="Bengkulu" {{old($col,$user->katget->$col)=="Bengkulu"?"selected":"" }}>Bengkulu</option>
                                                <option class="m-2" value="Sumatera Selatan" {{old($col,$user->katget->$col)=="Sumatera Selatan"?"selected":"" }}>Sumatera Selatan (Sumsel)</option>
                                                <option class="m-2" value="Kepulauan Bangka Belitung" {{old($col,$user->katget->$col)=="Kepulauan Bangka Belitung"?"selected":"" }}>Kepulauan Bangka Belitung</option>
                                                <option class="m-2" value="Lampung" {{old($col,$user->katget->$col)=="Lampung"?"selected":"" }}>Lampung</option>
                                                <option class="m-2" value="Banten" {{old($col,$user->katget->$col)=="Banten"?"selected":"" }}>Banten</option>
                                                <option class="m-2" value="Jawa Barat" {{old($col,$user->katget->$col)=="Jawa Barat"?"selected":"" }}>Jawa Barat (Jabar)</option>
                                                <option class="m-2" value="DKI Jakarta" {{old($col,$user->katget->$col)=="DKI Jakarta"?"selected":"" }}>DKI Jakarta</option>
                                                <option class="m-2" value="Jawa Tengah" {{old($col,$user->katget->$col)=="Jawa Tengah"?"selected":"" }}>Jawa Tengah (Jateng)</option>
                                                <option class="m-2" value="Yogyakarta" {{old($col,$user->katget->$col)=="Yogyakarta"?"selected":"" }}>Yogyakarta</option>
                                                <option class="m-2" value="Jawa Timur" {{old($col,$user->katget->$col)=="Jawa Timur"?"selected":"" }}>Jawa Timur (Jatim)</option>
                                                <option class="m-2" value="Bali" {{old($col,$user->katget->$col)=="Bali"?"selected":"" }}>Bali</option>
                                                <option class="m-2" value="Nusa Tenggara Barat" {{old($col,$user->katget->$col)=="Nusa Tenggara Barat"?"selected":"" }}>Nusa Tenggara Barat (NTB)</option>
                                                <option class="m-2" value="Nusa Tenggara Timur" {{old($col,$user->katget->$col)=="Nusa Tenggara Timur"?"selected":"" }}>Nusa Tenggara Timur (NTT)</option>
                                                <option class="m-2" value="Kalimantan Utara" {{old($col,$user->katget->$col)=="Kalimantan Utara"?"selected":"" }}>Kalimantan Utara (Kaltara)</option>
                                                <option class="m-2" value="Kalimantan Barat" {{old($col,$user->katget->$col)=="Kalimantan Barat"?"selected":"" }}>Kalimantan Barat (Kalbar)</option>
                                                <option class="m-2" value="Kalimantan Tengah" {{old($col,$user->katget->$col)=="Kalimantan Tengah"?"selected":"" }}>Kalimantan Tengah (Kalteng)</option>
                                                <option class="m-2" value="Kalimantan Selatan" {{old($col,$user->katget->$col)=="Kalimantan Selatan"?"selected":"" }}>Kalimantan Selatan (Kalsel)</option>
                                                <option class="m-2" value="Kalimantan Timur" {{old($col,$user->katget->$col)=="Kalimantan Timur"?"selected":"" }}>Kalimantan Timur (Kaltim)</option>
                                                <option class="m-2" value="Gorontalo" {{old($col,$user->katget->$col)=="Gorontalo"?"selected":"" }}>Gorontalo</option>
                                                <option class="m-2" value="Sulawesi Utara" {{old($col,$user->katget->$col)=="Sulawesi Utara"?"selected":"" }}>Sulawesi Utara (Sulut)</option>
                                                <option class="m-2" value="Sulawesi Barat" {{old($col,$user->katget->$col)=="Sulawesi Barat"?"selected":"" }}>Sulawesi Barat (Sulbar)</option>
                                                <option class="m-2" value="Sulawesi Tengah" {{old($col,$user->katget->$col)=="Sulawesi Tengah"?"selected":"" }}>Sulawesi Tengah (Sulteng)</option>
                                                <option class="m-2" value="Sulawesi Selatan" {{old($col,$user->katget->$col)=="Sulawesi Selatan"?"selected":"" }}>Sulawesi Selatan (Sulsel)</option>
                                                <option class="m-2" value="Sulawesi Tenggara" {{old($col,$user->katget->$col)=="Sulawesi Tenggara"?"selected":"" }}>Sulawesi Tenggara (Sultra)</option>
                                                <option class="m-2" value="Maluku Utara" {{old($col,$user->katget->$col)=="Maluku Utara"?"selected":"" }}>Maluku Utara</option>
                                                <option class="m-2" value="Maluku" {{old($col,$user->katget->$col)=="Maluku"?"selected":"" }}>Maluku</option>
                                                <option class="m-2" value="Papua" {{old($col,$user->katget->$col)=="Papua"?"selected":"" }}>Papua</option>
                                                <option class="m-2" value="Papua Barat" {{old($col,$user->katget->$col)=="Papua Barat"?"selected":"" }}>Papua Barat</option>

                                            </select>

                                        @elseif ($col=='alamat')
                                            <textarea name="{{$col}}" type="password" class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}"
                                                id="{{$col}}" placeholder="Masukan {{$col}}" cols="30" rows="10">{{ old($col,$user->katget->$col) }}</textarea>
                                        @elseif ($col=='ktp')
                                            <input name="{{$col}}" type="text"
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col,$user->katget->$col) }}"
                                            id="{{$col}}" placeholder="Masukan {{$col}}">
                                        @elseif ($col=='dusun')
                                            <input name="{{$col}}" type="text"
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col,$user->katget->$col) }}"
                                            id="{{$col}}" placeholder="Masukan {{$col}}">
                                        @elseif ($col=='password')
                                            <input name="{{$col}}" type="password"
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value=""
                                            id="{{$col}}" placeholder="Masukan {{$col}}">
                                        @else
                                            <input name="{{$col}}" type="text"
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col,$user->$col) }}"
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


                            <div class="row">
                                <button type='submit' class='mt-3  btn btn-sm btn-secondary'>Update</button>
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
{{-- <script src="{{ asset('assets/form_kriteria.js') }}"></script> --}}
@endsection