<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiSampah;
use App\Models\Nasabah;
use App\Models\Sampah;
use App\Traits\arrayTrait;
use Illuminate\Support\Facades\Auth;
use Session;

class TransaksiSampahController extends Controller
{

    use arrayTrait;

    public function index()
    {
        if(auth::user()->kategori=="Admin")
        {
            $transaksiSampah=TransaksiSampah::with(['nasabah.user','sampah'])->where('validasi',0)->get();
            $transaksiValid=TransaksiSampah::with(['nasabah.user','sampah'])->where('validasi',1)->get();
        }
        elseif(auth::user()->kategori=="Pengepul")
        {
            $transaksiValid=TransaksiSampah::with(['nasabah.user','sampah'])
            ->whereHas('sampah', function($sampah){
                $sampah->where('id_pengepul',auth::user()->pengepul->id);
            })->where('validasi',1)->get();

            $transaksiSampah=TransaksiSampah::with(['nasabah.user','sampah'])
            ->whereHas('sampah', function($sampah){
                $sampah->where('id_pengepul',auth::user()->pengepul->id);
            })->where('validasi',0)->get();

        }

        // if (!$transaksiSampah->isEmpty()) {
        //     $columns = $transaksiSampah[0]->getFillable();
        // }
        // else $columns=null;

        $transaksi=new TransaksiSampah;
        $columns = $transaksi->getFillable();

        // array_push($columns,'nasabah->user->name');
        // dd($columns);

        return view('transaksiSampah.index',compact(['transaksiSampah','transaksiValid','columns']));
    }



    public function tampilPerNasabah()
    {
        $transaksiSampah=TransaksiSampah::with(['nasabah.user','sampah'])
        ->where('id_nasabah',Auth::user()->nasabah->id)
        ->get();

        $transaksi=new TransaksiSampah;
        $columns = $transaksi->getFillable();

        //mutasi getFillable
        //hapus
        $columns=$this->removeIndexByValue(['id_nasabah'], $columns);

        //tambah
        array_push($columns,'created_at');

        return view('transaksiSampah.perNasabah',compact(['transaksiSampah','columns']));
    }


    public function createByNasabah()
    {
        // $nasabah=Nasabah::select('id','id_user')->with('user')->get();
        // $nasabah=auth->user()->nasabah;
        $sampah=Sampah::whereHas('pemilik', function($pemilik){
            $pemilik->where('provinsi',auth::user()->nasabah->provinsi);
        })->get();
        // dd($sampah);

        $transaksi=new TransaksiSampah;
        $columns = $transaksi->getFillable();

        return view('transaksiSampah.createByNasabah',compact(['columns','sampah']));
    }

    public function storeByNasabah(Request $request)
    {
        //validasi

        $this->validate($request, [
            'id_sampah'=>"required|string",
            'total_jumlah'=>"required|int",
        ]);
        // echo "<p class='ini'>valid</p>";
        // dd($request->all());


        $transaksi=new TransaksiSampah;
        $sampah=Sampah::find($request->id_sampah);
        $nasabah=auth::user()->nasabah;


        //isi transaksi
        $transaksi->id_nasabah=$nasabah->id;
        $transaksi->id_sampah=$sampah->id;
        $transaksi->total_jumlah=$request->total_jumlah;
        $transaksi->total_pembayaran= $transaksi->total_jumlah * $sampah->harga;
        $transaksi->save();


        Session::flash('sukses', $transaksi);
        return redirect()->route('transaksiSampahPerNasabah');
    }


    public function validasi(Request $request){

        $transaksi=TransaksiSampah::find($request->id_transaksi);
        $transaksi->validasi=1;

        //untuk pembelian harga
        // if(!$this->ceksaldocukup($nasabah, $transaksi))
        // return redirect()->route('transaksiSampah')
        //     ->withErrors(['error'=>'saldo tidak cukup']);

        //tambah saldo
        $transaksi->nasabah->saldo = $transaksi->nasabah->saldo + $transaksi->total_pembayaran;
        $transaksi->nasabah->save();

        $transaksi->save();


        return redirect()->route('transaksiSampah');

    }


    public function validasiBatal(Request $request){

        $transaksi=TransaksiSampah::find($request->id_transaksi);
        $transaksi->validasi=0;

        //untuk pembelian harga
        // if(!$this->ceksaldocukup($nasabah, $transaksi))
        // return redirect()->route('transaksiSampah')
        //     ->withErrors(['error'=>'saldo tidak cukup']);

        //tambah saldo
        $transaksi->nasabah->saldo = $transaksi->nasabah->saldo - $transaksi->total_pembayaran;
        $transaksi->nasabah->save();

        $transaksi->save();


        return redirect()->route('transaksiSampah');

    }







    public function create()
    {
        $nasabah=Nasabah::select('id','id_user')->where('provinsi',AUTH::user()->pengepul->provinsi)->with('user')->get();
        $sampah=AUTH::user()->pengepul->sampah;
        // dd($sampah);

        $transaksi=new TransaksiSampah;
        $columns = $transaksi->getFillable();

        return view('transaksiSampah.create',compact(['columns','nasabah','sampah']));
    }


    public function store(Request $request)
    {
        //validasi
        $this->validate($request, [
            'id_nasabah'=>"required|string",
            'id_sampah'=>"required|string",
            'total_jumlah'=>"required|int",
        ]);
        // echo "<p class='ini'>valid</p>";
        // dd($request->all());


        $transaksi=new TransaksiSampah;
        $sampah=Sampah::find($request->id_sampah);
        $nasabah=Nasabah::find($request->id_nasabah);


        //isi transaksi
        $columns = $transaksi->getFillable();
        foreach($columns as $col){
            $transaksi->$col=$request->$col;
        }
        $transaksi->total_pembayaran= $transaksi->total_jumlah * $sampah->harga;

        //untuk pembelian harga
        // if(!$this->ceksaldocukup($nasabah, $transaksi))
        // return redirect()->route('transaksiSampah')
        //     ->withErrors(['error'=>'saldo tidak cukup']);

        //tambah saldo
        $nasabah->saldo = $nasabah->saldo + $transaksi->total_pembayaran;
        $nasabah->save();

        //simpan
        $transaksi->validasi=1;
        $transaksi->save();

        return redirect()->route('transaksiSampah');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $transaksiSampah=TransaksiSampah::with(['nasabah'])->find($id);

        //hapus saldo
        $transaksiSampah->nasabah->saldo = $transaksiSampah->nasabah->saldo - $transaksiSampah->total_pembayaran;
        $transaksiSampah->nasabah->save();

        $transaksiSampah->delete();

        return redirect()->route('transaksiSampah');
    }



}
