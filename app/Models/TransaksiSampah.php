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
        'total_satuan',
        'total_point',
        'validasi',
    ];

    //relasi
    public function nasabah(){
        return $this->belongsTo('App\Models\Nasabah','id_nasabah');//boleh null
    }

    // public function user(){
    //     return $this->belongsTo('App\Models\Nasabah','id_nasabah');//boleh null
    // }

    public function sampah()
    {
        return $this->belongsTo('App\Models\Sampah', 'id_sampah');//nanti ganti jo jadi many to many
    }



}
