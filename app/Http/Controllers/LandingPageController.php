<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nasabah;
use App\Models\TransaksiSampah;
use App\Models\Sampah;
use App\Models\Reward;

class LandingPageController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index()
    {

        $nNasabah = Nasabah::count();
        $nTransaksiSampah = TransaksiSampah::where('validasi',1)->count();

        $sampah=Sampah::all();
        $reward=Reward::all();

        $nasabah = Nasabah::Has('transaksiSampahs')->with(['transaksiSampahs'])->get()->take(3);


        // dd($nasabah[1]->transaksiSampahs);

        // $reward=Reward::all();
        // $columns=new Reward;
        // $columns = $columns->getFillable();

        // //tambah
        // array_push($columns,'updated_at');

        return view('landing_page.pages.index',compact([
            'nNasabah',
            'nTransaksiSampah',
            'sampah',
            'reward',
            'nasabah',
            ]));
    }
}
