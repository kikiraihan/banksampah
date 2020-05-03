<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{

    protected $fillable = [
        'id_nasabah',
        'id_transaksi_sampah',
        'id_challengge',
        'isi',
        //isi = sampah->challengge_sampah->point_didapat*transaksi->total_jumlah
    ];



    public function nasabah()
    {
        return $this->belongsTo('App\Models\Nasabah', 'id_nasabah');
    }

    public function transaksisampah()
    {
        return $this->belongsTo('App\Models\TransaksiSampah', 'id_transaksi_sampah');
    }

    public function challengge()
    {
        return $this->belongsTo('App\Models\Challengge', 'id_challengge');
    }
}
