<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //



    public function sampah()
    {
        return $this->hasMany('App\Models\Sampah', 'id_member');
    }

    public function reward()
    {
        return $this->hasMany('App\Models\Reward', 'id_member');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');//pasti ada
    }
}
