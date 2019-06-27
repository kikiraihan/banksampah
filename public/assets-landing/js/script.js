let login =
    '<h3 class="h4 text-black mb-4">Login</h3>' +
    '<div class="form-group">' +
    '<input type="text" class="form-control" placeholder="Email Addresss">' +
    '</div>' +
    '<div class="form-group">' +
    '<input type="password" class="form-control" placeholder="Password">' +
    '</div>' +
    '<div class="form-group">' +
    '<input type="submit" class="text-white btn btn-success btn-pill" value="Login">' +
    '<a href="#" class="ml-3 register-button btn btn-outline-secondary btn-pill"> Register</a>' +
    '</div>' ;

let regis =

    '<h3 class="h4 text-black mb-4">Register</h3>' +
    '<div class="form-group">' +
    '<input name="ktp" type="text" class="form-control" placeholder="No KTP" name="nik">' +
    '</div>' +
    '<div class="form-group">' +
    '<input name="name" type="text" class="form-control" placeholder="Nama" >' +
    '</div>' +
    '<div class="form-group">' +
    '<input name="email" type="text" class="form-control" placeholder="Email" >' +
    '</div>' +
    '<div class="form-group">' +
    '<textarea  name="alamat" class="form-control" placeholder="Alamat" rows=4></textarea>' +
    '</div>' +
    '<div class="form-group">' +
    '<input name="telepon" type="text" class="form-control" placeholder="Telepone" >' +
    '</div>' +
    '<div class="form-group">' +
    '<input name="username" type="text" class="form-control" placeholder="Username" >' +
    '</div>' +
    '<div class="form-group">' +
    '<input name="password" type="password" class="form-control" placeholder="Password" >' +
    '</div>' +
    '<div class="form-group">' +
    '<input type="submit" class="text-white btn btn-success btn-pill" value="Register">' +
    '<a href="#" class="ml-3 login-button btn btn-outline-secondary btn-pill"> Login</a>' +
    '</div>' ;

let formLoginRegis = $('.form-login-regis');
var form= document.getElementById("formBase");
console.log(form.action);

formLoginRegis.on('click', '.register-button', function (e) {
    e.preventDefault();
    formLoginRegis.html(regis);
});

formLoginRegis.on('click', '.login-button', function (e) {
    e.preventDefault();
    formLoginRegis.html(login);
});






