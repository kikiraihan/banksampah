<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;
    protected $guard_name="web";


    protected $fillable = [
        'kategori',
        'name',
        'email',
        'telepon',
        'password',
        'username',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    //relasi
    public function nasabah(){
        return $this->hasOne('App\Models\Nasabah','id_user');//boleh null
    }

    // public function transaksiSampah(){
    //     return $this->through('App\Models\TransaksiSampah','id_user');//boleh null
    // }



    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] =  bcrypt($password);
    }



}
