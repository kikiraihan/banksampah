<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait wilayahIndonesia
{
    //cara pakai, taruh di luar controller
    // use App\Traits\wilayahIndonesia;
    //taruh di didalam controller
    // use wilayahIndonesia;
    // $this->method

    public function provinsi($id){
        return $provinsi=DB::table('provinces')->where('id', $id)->first();
    }

    public function kota($id)
    {
        return $getcity =DB::table('regencies')->where('id', $id)->first();
    }

    public function kecamatan($id)
    {
        return $getdistricts =DB::table('districts')->where('id', $id)->first();
    }

    public function kelurahan($id)
    {
         return $getvillages =DB::table('villages')->where('id', $id)->first();
    }



    public function allProvinsi()
    {
        return DB::table('provinces')->orderBy('name','ASC')->get();//DB::select("SELECT * FROM provinces ORDER BY name ASC");
    }



}


