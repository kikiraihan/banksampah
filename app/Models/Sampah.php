<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    protected $fillable = [
        'nama',
        'point',
        'satuan',
        'deskripsi',
        'id_member',
    ];

    //relasi
    public function pemilik(){
        return $this->belongsTo('App\Models\Member','id_member');//boleh null
    }

    public function tranksaksiSampah()
    {
        return $this->hasOne('App\Models\TransaksiSampah', 'id_sampah');
    }


}
