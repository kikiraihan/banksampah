 <div id="login-section">
    </div>
    <div class="site-section courses-entry-wrap mt-3" data-aos="fade-up" data-aos-delay="100">
        <div class="container">
            <div class="row justify-content-center text-center ">
                <form id="formBase" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf

                    <div class="form-login-regis">

                            <h3 class="h4 text-black mb-4">Login</h3>

                            <div class="form-group">
                                <input type="text" placeholder="Email Addresss"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>



                            <div class="form-group">
                                <input type="password" placeholder="Password"
                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="submit" class="text-white btn btn-success btn-pill" value="Login">
                                <a href="#" class="ml-3 btn btn-outline-secondary btn-pill register-button">
                                    Register</a>
                            </div>

                    </div>

                </form>
            </div>
            <br><br><br><br><br>
        </div>
    </div>





    <script>
    let login =
    <h3 class="h4 text-black mb-4">Login</h3>

    <div class="form-group">
        <input type="text" placeholder="Email Addresss"
        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
        name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <input type="password" placeholder="Password"
        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
        name="password" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <input type="submit" class="text-white btn btn-success btn-pill" value="Login">
        <a href="#" class="ml-3 btn btn-outline-secondary btn-pill register-button">
            Register</a>
    </div>;

let regis =



let formLoginRegis = $('.form-login-regis');

formLoginRegis.on('click', '.register-button', function (e) {
    e.preventDefault();
    formLoginRegis.html(regis);

    var form= document.getElementById("formBase");
    var str=form.action;
    form.action=str.replace("login","register")
});

formLoginRegis.on('click', '.login-button', function (e) {
    e.preventDefault();
    formLoginRegis.html(login);

    var form= document.getElementById("formBase");
    var str=form.action;
    form.action=str.replace("register","login")
});
</script>