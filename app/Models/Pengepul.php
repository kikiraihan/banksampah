<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengepul extends Model
{

    protected $fillable = [
        'id_user',
        'ktp',
        'alamat',

        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
    ];



    public function sampah()
    {
        return $this->hasMany('App\Models\Sampah', 'id_pengepul');
    }



    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');//pasti ada
    }

    public function ewallet()
    {
        return $this->morphMany('App\Models\Ewallet', 'ewalletable');
    }
}
