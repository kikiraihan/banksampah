<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challengger extends Model
{

    protected $fillable = [
        'id_user',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
    ];

    //has many through
    // public function reward()
    // {
    //     return $this->hasMany('App\Models\Reward', 'id_challengger');
    // }

    public function challengge()
    {
        return $this->hasMany('App\Models\Challengge', 'id_challengger');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');//pasti ada
    }
}
