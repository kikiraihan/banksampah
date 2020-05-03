<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nasabah;
use App\Models\TransaksiSampah;
use  Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // PERDUSUN
        //transaksi
        $nasProv = Nasabah::with('transaksiSampahs')->get()->groupBy('provinsi');
        foreach ($nasProv as $provinsi => $nasabah) {
            $transProv[$provinsi] = 0;
            foreach ($nasabah as $n) {
                $transProv[$provinsi] = $transProv[$provinsi]+count($n->transaksiSampahs);
            }
        }

        //nasabah
        foreach ($nasProv as $provinsi => $nasabah) {
            $nasabahProvinsi[$provinsi] = count($nasabah);
        }


        $user=Auth::user();


        return view('home',compact('transProv','nasabahProvinsi','user'));
    }


}
