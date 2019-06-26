<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $fillable = [
        'id_user',
        'ktp',
        'alamat',
        'saldo',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');//pasti ada
    }

    public function transaksiSampahs()
    {
        return $this->hasMany('App\Models\TransaksiSampah', 'id_nasabah');
    }

    public function transaksiRewards()
    {
        return $this->hasMany('App\Models\TransaksiReward', 'id_nasabah');
    }
}
