<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiReward extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_nasabah',
        'id_reward',
        'status',
        'total_jumlah',
        'total_point',
    ];

    //relasi
    public function nasabah(){
        return $this->belongsTo('App\Models\Nasabah','id_nasabah');//boleh null
    }

    public function reward()
    {
        return $this->belongsTo('App\Models\Reward', 'id_reward');//nanti ganti jo jadi many to many
    }


}
