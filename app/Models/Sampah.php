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
    ];

    //relasi
    public function nasabah(){
        return $this->belongsTo('App\Models\Nasabah','id_user');//boleh null
    }

    public function tranksaksiSampah()
    {
        return $this->hasOne('App\Models\TransaksiSampah', 'id_sampah');
    }


}
