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
        'id_member',
    ];


    //RELASI
    public function pemilik(){
        return $this->belongsTo('App\Models\Member','id_member');//boleh null
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
