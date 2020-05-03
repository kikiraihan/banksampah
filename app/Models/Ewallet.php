<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ewallet extends Model
{
    // cara save
    // $nasabah = Nasabah::find(1);
    // $ewallet = new Ewallet;
    // $nasabah->ewallet()->save($ewallet);

    protected $fillable = [
        'ewalletable_id',
        'ewalletable_type',
        'nomor',
        'qrcode',
        'nama_akun',
    ];

    public function ewalletable()
    {
        //nasabah, dan pengepul
        return $this->morphTo();
    }
}
