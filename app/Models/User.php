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
        'username',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    //relasi
    public function nasabah(){
        return $this->hasOne('App\Models\Nasabah','id_user');//boleh null
    }

    public function pengepul(){
        return $this->hasOne('App\Models\Pengepul','id_user');//boleh null
    }

    public function challengger(){
        return $this->hasOne('App\Models\Challengger','id_user');//boleh null
    }

    public function katget(){
        if($this->kategori=="Nasabah")
        return $this->hasOne('App\Models\Nasabah','id_user');//boleh null
        elseif($this->kategori=="Pengepul")
        return $this->hasOne('App\Models\Pengepul','id_user');//boleh null
        elseif($this->kategori=="Challengger")
        return $this->hasOne('App\Models\Challengger','id_user');//boleh null
        else return null;
    }

    // public function transaksiSampah(){
    //     return $this->through('App\Models\TransaksiSampah','id_user');//boleh null
    // }



    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] =  bcrypt($password);
    }



}
