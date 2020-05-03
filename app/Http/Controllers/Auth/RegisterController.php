<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use App\Models\Nasabah;
use App\Traits\wilayahIndonesia;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    use wilayahIndonesia;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:6|confirmed',

            // "ktp" => 'required|string|max:255|unique:nasabahs',
            // "alamat" => 'required|string',
            // "telepon" => 'required|string|max:255|unique:users',
            // "username" => 'required|string|max:255|unique:users',

            "name" =>"required|string",
            "email" =>"required|email|unique:users",
            "telepon"=>"required|string|unique:users",
            "ktp"=>"nullable|string|unique:nasabahs",

            "provinsi"=>"required|string",
            "kota"=>"required|string",
            "kecamatan"=>"required|string",
            "kelurahan"=>"required|string",
            "alamat"=>"required|string",

            "username"=>"required|string|unique:users",
            "password" =>"required|min:6",
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        // dd($this->kota($data['kota'])->name);


        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'telepon'=> $data['telepon'],
            'username'=> $data['username'],
            'kategori'=>"Nasabah",
        ]);

        // if($data['ktp']==NULL)
        // $ktp=$user->id;
        // else
        // $ktp=$data['ktp'];

        // if($data['dusun']==NULL)
        // $dusun=1;
        // else
        // $dusun=$data['dusun'];

        Nasabah::create([
            'id_user'=>$user->id,
            'ktp'=> $data['ktp'],//$ktp,
            'alamat'=> $data['alamat'],
            'provinsi'=> $this->provinsi($data['provinsi'])->name,
            'kota'=> $this->kota($data['kota'])->name,
            'kecamatan'=> $this->kecamatan($data['kecamatan'])->name,
            'kelurahan'=> $this->kelurahan($data['kelurahan'])->name,
        ]);

        $user->assignRole('Nasabah');

        return $user;

    }


    public function showRegistrationForm()
    {

        $sql_provinsi =DB::table('provinces')->orderBy('name','ASC')->get();//DB::select("SELECT * FROM provinces ORDER BY name ASC");

        return view('auth.register',compact(['sql_provinsi']));
    }



}
