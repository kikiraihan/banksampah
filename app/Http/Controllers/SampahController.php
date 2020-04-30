<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sampah;
use Illuminate\Support\Facades\Auth;

class SampahController extends Controller
{

    public function index()
    {
        if(auth::user()->kategori=="Admin")$sampah=Sampah::all();
        elseif(auth::user()->kategori=="Member")$sampah=Sampah::where('id_member',auth::user()->member->id)->get();
        $columns=new Sampah;
        $columns = $columns->getFillable();

        //tambah
        array_push($columns,'updated_at');

        return view('sampah.index',compact(['sampah','columns']));
    }


    public function create()
    {
        $sampah=new Sampah;
        $columns = $sampah->getFillable();

        $c=collect($columns);
        $key = $c->search(function($item) {
            return $item == 'id_member';
        });$c->pull($key);
        $columns=$c->toArray();

        return view('sampah.create',compact(['columns']));
    }


    public function store(Request $request)
    {
        //validasi
        // dd($request->all());

        $this->validate($request, [
            'nama'=>"required|string",
            'point'=>"required|int",
            'satuan'=>"required|string",
            'deskripsi'=>"required|string",
            // 'id_member'=>"required",
        ]);
        // echo "<p class='ini'>valid</p>";
        // dd($request->all());

        //simpan
        $sampah=new Sampah;
        $columns = $sampah->getFillable();
        foreach($columns as $col){
            if($col=="id_member")
            $sampah->id_member=auth::user()->member->id;
            else
            $sampah->$col=$request->$col;
        }
        $sampah->save();

        return redirect()->route('sampah');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $sampah=Sampah::find($id);
        $columns = $sampah->getFillable();

        return view('sampah.edit',compact(['columns','sampah']));
    }


    public function update(Request $request, $id)
    {
        //validasi

        $this->validate($request, [
            'nama'=>"required|string",
            'point'=>"required|int",
            'satuan'=>"required|string",
            'deskripsi'=>"required|string",
        ]);
        // echo "<p class='ini'>valid</p>";
        // dd($request->all());

        //simpan
        $sampah=Sampah::find($id);
        $columns = $sampah->getFillable();
        foreach($columns as $col){
            $sampah->$col=$request->$col;
        }
        $sampah->save();

        return redirect()->route('sampah');
    }


    public function destroy($id)
    {
        Sampah::find($id)
            ->delete()
        ;
        return redirect()->route('sampah');
    }
}
