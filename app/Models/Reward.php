<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{

    protected $fillable = [
        'nama',
        'point_harga',
        'stock',
        'foto',
        // 'validasi',
        'id_challengge',
    ];


    //RELASI
    public function challengge(){
        return $this->belongsTo('App\Models\Challengge','id_challengge');//boleh null
    }

    public function tranksaksiReward()
    {
        return $this->hasOne('App\Models\TransaksiReward', 'id_reward');
    }



    //assessor muttator
    public function getFotoAttribute($value){
        if($value!=NULL){
            return '/storage/'.$value;//kalau dihosting musti ada '/storage/' bagitu supaya bkrja dpe link
        }
        return asset("img/image-placeholder.png");//default kalau null
    }
}
