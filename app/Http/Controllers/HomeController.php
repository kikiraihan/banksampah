<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Nasabah;

use App\Models\TransaksiSampah;

use  Illuminate\Support\Facades\DB;

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
        $nasDus = Nasabah::with('transaksiSampahs')->get()->groupBy('dusun');
        foreach ($nasDus as $dusun => $nasabah) {
            $transDus[$dusun] = 0;
            foreach ($nasabah as $n) {
                $transDus[$dusun] = $transDus[$dusun]+count($n->transaksiSampahs);
            }
        }

        //nasabah
        foreach ($nasDus as $dusun => $nasabah) {
            $nasabahDusun[$dusun] = count($nasabah);
        }

        return view('home',compact('transDus','nasabahDusun'));
    }

    public function login_page()
    {
        return view('landing_page.login');
    }


}
