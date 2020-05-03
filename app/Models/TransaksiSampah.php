<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiSampah extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_nasabah',
        'id_sampah',
        'total_jumlah',
        'total_pembayaran',
        'validasi',
    ];

    //relasi
    public function nasabah(){
        return $this->belongsTo('App\Models\Nasabah','id_nasabah');//boleh null
    }

    public function sampah()
    {
        return $this->belongsTo('App\Models\Sampah', 'id_sampah');//nanti ganti jo jadi many to many
    }


    public function point(){
        return $this->hasOne('App\Models\Point','id_transaksi_sampah');//boleh null
    }



}
