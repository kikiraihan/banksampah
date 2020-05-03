<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challengge extends Model
{

    protected $fillable = [
        'judul',
        'expired_date',
        'id_challengger',
    ];

    //
    public function reward()
    {
        return $this->hasMany('App\Models\Reward', 'id_challengge');//has many through
    }

    public function point()
    {
        return $this->hasMany('App\Models\Point', 'id_challengge');//has many through
    }

    public function challengger()
    {
        return $this->belongsTo('App\Models\Challengge','id_challengger');//boleh null
    }

    public function sampah()
    {
        return $this->belongsToMany('App\Models\Sampah','challengge_sampah','id_challengge', 'id_sampah');//boleh null
    }


}
