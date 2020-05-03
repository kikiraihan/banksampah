<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WilayahIndonesiaController extends Controller
{
    public function getWilayah($jenis)
    {

        switch ($jenis) {
            //ambil data kota / kabupaten
            case 'kota':
            $id_provinces = $_POST['id_provinces'];
            if($id_provinces == ''){
                exit;
            }else{
                $getcity =DB::table('regencies')->where('province_id',$id_provinces)->orderBy('name','ASC')->get() or die ('Query Gagal');
                foreach($getcity as $data)
                {
                    echo '<option value="'.$data->id.'" {{old("kota")=="'.$data->id.'"?"selected":"" }}>'.$data->name.'</option>';
                }
                exit;
            }
            break;

            //ambil data kecamatan
            case 'kecamatan':
            $id_regencies = $_POST['id_regencies'];
            if($id_regencies == ''){
                exit;
            }else{
                $getcity =DB::table('districts')->where('regency_id',$id_regencies)->orderBy('name','ASC')->get() or die ('Query Gagal');
                foreach($getcity as $data)
                {
                    echo '<option value="'.$data->id.'" {{old("kecamatan")=="'.$data->id.'"?"selected":"" }}>'.$data->name.'</option>';
                }
                exit;
            }
            break;


            //ambil data kelurahan
            case 'kelurahan':
            $id_district = $_POST['id_district'];
            if($id_district == ''){
                exit;
            }else{
                $getcity =DB::table('villages')->where('district_id',$id_district)->orderBy('name','ASC')->get() or die ('Query Gagal');
                foreach($getcity as $data)
                {
                    echo '<option value="'.$data->id.'" {{old("kelurahan")=="'.$data->id.'"?"selected":"" }}>'.$data->name.'</option>';
                }
                exit;
            }
            break;

        }
    }
}
