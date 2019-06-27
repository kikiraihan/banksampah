<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiSampah;
use App\Models\Nasabah;
use App\Models\Sampah;
use App\Traits\arrayTrait;
use Illuminate\Support\Facades\Auth;

class TransaksiSampahController extends Controller
{

    use arrayTrait;

    public function index()
    {
        $transaksiSampah=TransaksiSampah::with(['nasabah.user','sampah'])->get();

        // if (!$transaksiSampah->isEmpty()) {
        //     $columns = $transaksiSampah[0]->getFillable();
        // }
        // else $columns=null;

        $transaksi=new TransaksiSampah;
        $columns = $transaksi->getFillable();

        // array_push($columns,'nasabah->user->name');
        // dd($columns);

        return view('transaksiSampah.index',compact(['transaksiSampah','columns']));
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






    public function create()
    {
        $nasabah=Nasabah::select('id','id_user')->with('user')->get();
        $sampah=Sampah::all();
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
            'total_satuan'=>"required|int",
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
        $transaksi->total_point= $transaksi->total_satuan * $sampah->point;

        //untuk pembelian point
        // if(!$this->ceksaldocukup($nasabah, $transaksi))
        // return redirect()->route('transaksiSampah')
        //     ->withErrors(['error'=>'saldo tidak cukup']);

        //tambah saldo
        $nasabah->saldo = $nasabah->saldo + $transaksi->total_point;
        $nasabah->save();

        //simpan
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
        $transaksiSampah->nasabah->saldo = $transaksiSampah->nasabah->saldo - $transaksiSampah->total_point;
        $transaksiSampah->nasabah->save();

        $transaksiSampah->delete();

        return redirect()->route('transaksiSampah');
    }



}
