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
            $transaksiOld=TransaksiSampah::with(['nasabah.user','sampah'])->where('validasi',1)->get();
        }
        elseif(auth::user()->kategori=="Pengepul")
        {
            $transaksiOld=TransaksiSampah::with(['nasabah.user','sampah'])
            ->whereHas('sampah', function($sampah){
                $sampah->where('id_pengepul',auth::user()->pengepul->id);
            })
            // ->where('validasi_pengepul',1)->where('validasi_nasabah',1)
            ->whereMonth('created_at','<',date('m'))// bulan lalu
            ->latest()->get();

            $transaksiSampah=TransaksiSampah::with(['nasabah.user','sampah'])
            ->whereHas('sampah', function($sampah){
                $sampah->where('id_pengepul',auth::user()->pengepul->id);
            })
            // ->where('validasi_pengepul',0)->orWhere('validasi_nasabah',0)
            ->whereMonth('created_at','>=',date('m'))
            ->latest()->get();
        }

        // if (!$transaksiSampah->isEmpty()) {
        //     $columns = $transaksiSampah[0]->getFillable();
        // }
        // else $columns=null;

        $transaksi=new TransaksiSampah;
        $columns = $transaksi->getFillable();unset($columns[4],$columns[5]);

        //mutasi getFillable
        //hapus
        $columns=$this->removeIndexByValue(['validasi_pengepul','validasi_nasabah'], $columns);
        //tambah
        array_push($columns,'created_at');

        return view('transaksiSampah.index',compact(['transaksiSampah','transaksiOld','columns']));
    }



    public function tampilPerNasabah()
    {
        $transaksiSampah=TransaksiSampah::with(['nasabah.user','sampah'])
        ->where('id_nasabah',Auth::user()->nasabah->id)
        ->whereMonth('created_at','>=',date('m'))// bulan lalu
        ->latest()->get();

        $transaksiOld=TransaksiSampah::with(['nasabah.user','sampah'])
        ->where('id_nasabah',Auth::user()->nasabah->id)
        ->whereMonth('created_at','<',date('m'))// bulan lalu
        ->latest()->get();

        $transaksi=new TransaksiSampah;
        $columns = $transaksi->getFillable();

        //mutasi getFillable
        //hapus
        $columns=$this->removeIndexByValue(['id_nasabah','validasi_pengepul','validasi_nasabah'], $columns);
        //tambah
        array_push($columns,'created_at');

        return view('transaksiSampah.perNasabah',compact(['transaksiSampah','transaksiOld','columns']));
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
        $transaksi->validasi_nasabah=1;
        $transaksi->validasi_pengepul=0;
        $transaksi->save();


        Session::flash('sukses', $transaksi);
        return redirect()->route('transaksiSampahPerNasabah');
    }


    public function validasi(Request $request)
    {
        $transaksi=TransaksiSampah::find($request->id_transaksi);

        if(AUTH::user()->kategori=="Pengepul")
        $transaksi->validasi_pengepul=1;
        elseif(AUTH::user()->kategori=="Nasabah")
        $transaksi->validasi_nasabah=1;

        //untuk pembelian harga
        // if(!$this->ceksaldocukup($nasabah, $transaksi))
        // return redirect()->route('transaksiSampah')
        //     ->withErrors(['error'=>'saldo tidak cukup']);

        //tambah saldo
        // $transaksi->nasabah->saldo = $transaksi->nasabah->saldo + $transaksi->total_pembayaran;
        // $transaksi->nasabah->save();

        $transaksi->save();


        if(AUTH::user()->kategori=="Pengepul")
        return redirect()->route('transaksiSampah')->withToastSuccess('berhasil divalidasi');
        elseif(AUTH::user()->kategori=="Nasabah")
        return redirect()->route('transaksiSampahPerNasabah')->withToastSuccess('berhasil divalidasi');
    }


    // public function validasiBatal(Request $request){
    //     $transaksi=TransaksiSampah::find($request->id_transaksi);
    //     return $this->pembatalan($transaksi);
    // }

    public function pembatalan(TransaksiSampah $transaksi)
    {
        if($transaksi->validasi_pengepul==1 && $transaksi->validasi_nasabah==1)
        {
            if(AUTH::user()->kategori=="Pengepul")
            return redirect()->route('transaksiSampah')->withToastError('tidak bisa dibatalkan, telah divalidasi 2 pihak');
            elseif(AUTH::user()->kategori=="Nasabah")
            return redirect()->route('transaksiSampahPerNasabah')->withToastError('tidak bisa dibatalkan, telah divalidasi 2 pihak');
        }
        elseif(AUTH::user()->kategori=="Pengepul")
        $transaksi->validasi_pengepul=0;
        elseif(AUTH::user()->kategori=="Nasabah")
        $transaksi->validasi_nasabah=0;

        $transaksi->save();

        if(AUTH::user()->kategori=="Pengepul")
        return redirect()->route('transaksiSampah')->withToastSuccess('berhasil '.AUTH::user()->kategori.' dibatalkan');
        elseif(AUTH::user()->kategori=="Nasabah")
        return redirect()->route('transaksiSampahPerNasabah')->withToastSuccess('berhasil '.AUTH::user()->kategori.' dibatalkan');
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
        // $nasabah->saldo = $nasabah->saldo + $transaksi->total_pembayaran;
        $nasabah->save();

        //simpan
        $transaksi->validasi_nasabah=0;
        $transaksi->validasi_pengepul=1;
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

        if(($transaksiSampah->validasi_nasabah==1 XOR $transaksiSampah->validasi_pengepul==1) AND ($transaksiSampah->created_at->format('m') < date('m')))
        {
            // jika minimal salah satu 0 dan sudah lewat satu bulan created_at, maka langsung destroy boleh
            $transaksiSampah->delete();

            if(AUTH::user()->kategori=="Pengepul")
            return redirect()->route('transaksiSampah')->withToastSuccess('berhasil transaksi dihapus');
            elseif(AUTH::user()->kategori=="Nasabah")
            return redirect()->route('transaksiSampahPerNasabah')->withToastSuccess('berhasil transaksi dihapus');

        }
        elseif($transaksiSampah->validasi_nasabah==1 OR $transaksiSampah->validasi_pengepul==1)
        {
            return $this->pembatalan($transaksiSampah);
        }
        else{//jika n dan p belum validasi



            //hapus saldo
            // $transaksiSampah->nasabah->saldo = $transaksiSampah->nasabah->saldo - $transaksiSampah->total_pembayaran;
            // $transaksiSampah->nasabah->save();

            $transaksiSampah->delete();

            if(AUTH::user()->kategori=="Pengepul")
            return redirect()->route('transaksiSampah')->withToastSuccess('berhasil transaksi dihapus');
            elseif(AUTH::user()->kategori=="Nasabah")
            return redirect()->route('transaksiSampahPerNasabah')->withToastSuccess('berhasil transaksi dihapus');
        }
    }



}
