@extends('layouts.app',[
'title'=>'Buat Reward',
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

                        <form action="{{ route('reward.store') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="put">
                            {{ csrf_field() }}

                            @foreach ($columns as $col)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="{{$col}}">{{$col}} </label>
                                    <div class="col-sm-10">

                                        @if ($col=='foto')

                                            {{-- <input name="{{$col}}" type="file"
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col) }}"
                                            id="{{$col}}" placeholder="{{$col}}"> --}}


                                            <div class="image-editor">
                                                <input type="file" class="cropit-image-input">
                                                <div class="cropit-preview"></div>
                                                <div class="image-size-label">
                                                    Resize image
                                                </div>
                                                <input type="range" class="cropit-image-zoom-input">
                                                <input type="hidden" name="{{$col}}" class="hidden-image-data" />
                                            </div>

                                            <div id="result">
                                                <code>$form.serialize() =</code>
                                                <code id="result-data"></code>
                                            </div>


                                        @elseif($col=='point')
                                            <input name="{{$col}}" type="number"
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col) }}"
                                            id="{{$col}}" placeholder="angka">
                                        @else
                                            <input name="{{$col}}" type="text"
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col) }}"
                                            id="{{$col}}" placeholder="{{$col}}">
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
    {{-- cropit --}}
    <style>
        .cropit-preview {
            background-color: #f8f8f8;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 7px;
            width: 250px;
            height: 250px;
        }

        .cropit-preview-image-container {
            cursor: move;
        }

        .image-size-label {
            margin-top: 10px;
        }

        /* input {
            display: block;
        }

        button[type="submit"] {
            margin-top: 10px;
        } */

        #result {
            margin-top: 10px;
            width: 900px;
        }

        #result-data {
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            word-wrap: break-word;
        }
    </style>
@endsection

@section('script-halaman')
{{-- <script src="{{ asset('assets/form_kriteria.js') }}"></script> --}}


{{-- //cropit --}}
<script src="{{ asset('/assets/cropit/jquery2.min.js') }}"></script>
<script src="{{ asset('/assets/cropit/cropit.js') }}"></script>
<script>
    $(function() {
        $('.image-editor').cropit();

        $('form').submit(function() {
            // Move cropped image data to hidden input
            var imageData = $('.image-editor').cropit('export');
            $('.hidden-image-data').val(imageData);

            // Print HTTP request params
            var formValue = $(this).serialize();
            $('#result-data').text(formValue);

            // Prevent the form from actually submitting
            return true;//false
        });
    });
</script>

@endsection