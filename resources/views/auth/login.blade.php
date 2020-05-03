@extends('layouts.app',[
    'title'=>'login',
    'bodyStyle'=>""
])

@section('content')
<div class="container">






    <div class="container text-center">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">

      <form id="formBase" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf

            <div class="form-login-regis">

                    <h3 class="h4 text-black mb-4">Login</h3>

                    <div class="form-group">
                        <label class="sr-only" for="input1-signin-02">Email</label>
                        <input class="{{ $errors->has('email') ? ' is-invalid' : '' }} form-control my-3 bg-light"
                        id="input1-signin-02" type="email" placeholder="Email"
                        name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>



                    <div class="form-group">
                        <label class="sr-only" for="input3-signin-02">Password</label>
                        <input class="form-control my-3 bg-light {{ $errors->has('password') ? ' is-invalid' : '' }}"
                        id="input3-signin-02" type="password" placeholder="Password"
                        name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group-row">
                        <div class="row no-gutters">
                        <span class="col-6 pr-1"><input type="submit" class="btn btn-outline-primary btn-block py-2 mr-3 btn-pill" value="Login!"></span>
                        <span class="col-6 pl-1"><a href="{{ route('register') }}" class="btn btn-primary btn-block py-2 mt-0 btn-pill" >Mendaftar!</a></span>
                        <span class="w-100 mt-2"><a href="{{ route('landing_page') }}" class="btn btn-outline-secondary w-100 btn-pill" >Kembali</a></span>
                        </div>
                    </div>
                    {{--  <p class="text-secondary text-muted mt-3" data-config-id="terms">By signing in you agree with the <a href="">Terms and Conditions</a> and <a href="">Privacy Policy</a>.</p>  --}}

            </div>

        </form>




      </div>
    </div>
  </div>





    <br><br><br>

    <div class="card p-0 text-center" style="overflow:hidden;">
        <a class="d-xl-none" href="https://my.idcloudhost.com/aff.php?aff=5605"><img src="https://idcloudhost.com/wp-content/uploads/2017/01/970x250.png" height="100" width="388.2" border="0" alt="IDCloudHost | SSD Cloud Hosting Indonesia" /></a>
        <a class="d-none d-xl-inline " href="https://my.idcloudhost.com/aff.php?aff=5605"><img src="https://idcloudhost.com/wp-content/uploads/2017/01/IDCloudHost-SSD-Cloud-Hosting-Indonesia-970x250.jpg" height="250" width="970" border="0" alt="IDCloudHost | SSD Cloud Hosting Indonesia" /></a>
        <p class="lead small container pt-3">
            Website Avatrash di hosting menggunakan teknologi web server dari idcloudhost.com
            <a class="d-block btn btn-info  mt-1" href="https://my.idcloudhost.com/aff.php?aff=5605"> Buat startup saya! </a>
        </p>
    </div>

</div>
@endsection
