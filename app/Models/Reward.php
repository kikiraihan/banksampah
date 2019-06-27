<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{

    protected $fillable = [
        'nama',
        'point',
        'stock',
        'foto',
    ];


    //RELASI
    public function tranksaksiReward()
    {
        return $this->hasOne('App\Models\TransaksiReward', 'id_reward');
    }



    //assessor muttator
    public function getFotoAttribute($value){
        if($value!=NULL){
            return '/storage/'.$value;//kalau dihosting musti ada '/storage/' bagitu supaya bkrja dpe link
        }
        return "link default gambar";
        // return asset("assets_landing/img/poster-3(387x500).png");//default kalau null
    }
}
