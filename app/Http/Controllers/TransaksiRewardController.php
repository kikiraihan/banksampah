<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiReward;
use App\Models\Nasabah;
use App\Models\Reward;
use App\Traits\arrayTrait;
use Illuminate\Support\Facades\Auth;
use Session;

class TransaksiRewardController extends Controller
{
    use arrayTrait;

    public function index()
    {


        if(auth::user()->kategori=="Admin")
        {
            $transaksiReward=TransaksiReward::with(['nasabah.user','reward'])->where('validasi',0)->get();
            $transaksiValid=TransaksiReward::with(['nasabah.user','reward'])->where('validasi',1)->get();
        }
        elseif(auth::user()->kategori=="Member")
        {
            $transaksiReward=TransaksiReward::with(['nasabah.user','reward'])
            ->whereHas('reward', function($reward){
                $reward->where('id_member',auth::user()->member->id);
            })->where('validasi',0)->get();
            $transaksiValid=TransaksiReward::with(['nasabah.user','reward'])
            ->whereHas('reward', function($reward){
                $reward->where('id_member',auth::user()->member->id);
            })->where('validasi',1)->get();

        }

        // if (!$transaksiReward->isEmpty()) {
        //     $columns = $transaksiReward[0]->getFillable();
        // }
        // else $columns=null;

        $transaksi=new TransaksiReward;
        $columns = $transaksi->getFillable();

        // array_push($columns,'nasabah->user->name');
        // dd($columns);

        return view('transaksiReward.index',compact(['transaksiReward','transaksiValid','columns']));
    }




    public function tampilPerNasabah()
    {

        $transaksiReward=TransaksiReward::with(['nasabah.user','reward'])
        ->where('id_nasabah',Auth::user()->nasabah->id)
        ->get();

        // dd($transaksiReward->toArray());

        $transaksi=new TransaksiReward;
        $columns = $transaksi->getFillable();



        //mutasi getFillable
        //hapus
        $columns=$this->removeIndexByValue(['id_nasabah'], $columns);

        //tambah
        array_push($columns,'created_at');


        // dd($columns);
        return view('transaksiReward.perNasabah',compact(['transaksiReward','columns']));
    }


    public function createByNasabah()
    {
        $reward=Reward::whereHas('pemilik', function($pemilik){
            $pemilik->where('provinsi',auth::user()->nasabah->provinsi);
        })->get();
        // dd($reward);

        $transaksi=new TransaksiReward;
        $columns = $transaksi->getFillable();

        return view('transaksiReward.createByNasabah',compact(['columns','nasabah','reward']));

    }


    public function storeByNasabah(Request $request)
    {
        //validasi
        $this->validate($request, [
            'id_reward'=>"required|string",
            'total_jumlah'=>"required|int",
            ]);
        // echo "<p class='ini'>valid</p>";
        // dd($request->all());


        $transaksi=new TransaksiReward;
        $reward=Reward::find($request->id_reward);
        $nasabah=auth::user()->nasabah;


        //isi transaksi
        $transaksi->id_nasabah=$nasabah->id;
        $transaksi->id_reward=$request->id_reward;
        $transaksi->total_jumlah=$request->total_jumlah;
        $transaksi->total_point= $transaksi->total_jumlah * $reward->point;

        // cek saldo
        if(!$this->cekSaldoCukup($nasabah, $transaksi)){

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['errorTransaksi'=>'Saldo tidak cukup : tersisa '.$nasabah->saldo.' pts, dan permintaan '. $transaksi->total_point.' pts ' ]);
        }

        // cek stock
        if(!$this->cekStockCukup($reward, $transaksi)){

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['errorTransaksi'=>'Stock tidak cukup, tersisa '.$reward->stock.' '.$reward->nama]);
        }



        //simpan
        $transaksi->save();

        Session::flash('sukses', $transaksi);
        // dd(Session::get('sukses')->reward->pemilik->user->name);
        return redirect()->route('transaksiRewardPerNasabah');
    }


    public function validasi(Request $request){

        $transaksi=TransaksiReward::find($request->id_transaksi);


        // cek saldo
        if(!$this->cekSaldoCukup($transaksi->nasabah, $transaksi)){

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['errorTransaksi'=>'Saldo tidak cukup : tersisa '.$transaksi->nasabah->saldo.' pts, dan permintaan '. $transaksi->total_point.' pts ' ]);
        }

        // cek stock
        if(!$this->cekStockCukup($transaksi->reward, $transaksi)){

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['errorTransaksi'=>'Stock tidak cukup, tersisa '.$transaksi->reward->stock.' '.$transaksi->reward->nama]);
        }



        $transaksi->validasi=1;

        // kurangi saldo nasabah
        $transaksi->nasabah->saldo = $transaksi->nasabah->saldo - $transaksi->total_point;
        $transaksi->nasabah->save();

        // kurangi stock reward
        $transaksi->reward->stock = $transaksi->reward->stock - $transaksi->total_jumlah;
        $transaksi->reward->save();

        $transaksi->save();

        return redirect()->route('transaksiReward');

    }





    public function create()
    {
        $nasabah=Nasabah::select('id','id_user')->with('user')->get();
        $reward=Reward::all();
        // dd($Reward);

        $transaksi=new TransaksiReward;
        $columns = $transaksi->getFillable();

        return view('transaksiReward.create',compact(['columns','nasabah','reward']));
    }






    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //validasi
        $this->validate($request, [
            'id_nasabah'=>"required|string",
            'id_reward'=>"required|string",
            'total_jumlah'=>"required|int",
            ]);
        // echo "<p class='ini'>valid</p>";
        // dd($request->all());


        $transaksi=new TransaksiReward;
        $reward=Reward::find($request->id_reward);
        $nasabah=Nasabah::find($request->id_nasabah);


        //isi transaksi
        $columns = $transaksi->getFillable();
        foreach($columns as $col)
        {
            $transaksi->$col=$request->$col;
        }
        $transaksi->total_point= $transaksi->total_jumlah * $reward->point;
        $transaksi->status='terkonfirmasi';

        // cek saldo
        if(!$this->cekSaldoCukup($nasabah, $transaksi)){

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['errorTransaksi'=>'Saldo tidak cukup : tersisa '.$nasabah->saldo.' pts, dan permintaan '. $transaksi->total_point.' pts ' ]);
        }

        // cek stock
        if(!$this->cekStockCukup($reward, $transaksi)){

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['errorTransaksi'=>'Stock tidak cukup, tersisa '.$reward->stock.' '.$reward->nama]);
        }

        //kurangi saldo nasabah
        $nasabah->saldo = $nasabah->saldo - $transaksi->total_point;
        $nasabah->save();

        //kurangi stock reward
        $reward->stock = $reward->stock - $transaksi->total_jumlah;
        $reward->save();

        //simpan
        $transaksi->save();

        return redirect()->route('transaksiReward');
    }

    public function cekSaldoCukup($nasabah, $transaksi){
        //cek saldo > transaksi total_point
        if($nasabah->saldo < $transaksi->total_point)

        return false;

        else return true;
    }

    public function cekStockCukup($reward, $transaksi){
        //cek saldo > transaksi total_point
        if($reward->stock < $transaksi->total_jumlah)

        return false;

        else return true;
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $transaksiReward=TransaksiReward::with(['nasabah'])->find($id);

        //tambah saldo nasabah
        $transaksiReward->nasabah->saldo = $transaksiReward->nasabah->saldo + $transaksiReward->total_point;
        $transaksiReward->nasabah->save();

        //tambah stock reward
        $transaksiReward->reward->stock = $transaksiReward->reward->stock + $transaksiReward->total_jumlah;
        $transaksiReward->reward->save();

        $transaksiReward->delete();

        return redirect()->route('transaksiReward');
    }








}
