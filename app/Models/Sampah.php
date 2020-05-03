<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    protected $fillable = [
        'id_pengepul',
        'nama',
        'deskripsi',
        'harga',
        'per_angka',
        'per_satuan',
    ];

    //relasi
    public function pemilik(){
        return $this->belongsTo('App\Models\Pengepul','id_pengepul');//boleh null
    }

    public function tranksaksiSampah()
    {
        return $this->hasOne('App\Models\TransaksiSampah', 'id_sampah');
        //dalam satu kali transaksi, hanya terdiri dari 1 sampah
        //supaya gampang ba track jumlah transaksi sebenarnya
    }

    public function challengge()
    {
        return $this->belongsToMany('App\Models\Challengge','challengge_sampah', 'id_sampah', 'id_challengge');//boleh null
    }


}
