<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use App\Traits\arrayTrait;
use App\Models\Nasabah;

class UserController extends Controller
{
    use arrayTrait;

    public function index()
    {
        $user=User::with(['nasabah'])->get()->groupBy('kategori');
        $admin=$user['Admin'];
        $nasabah=$user['Nasabah'];

        $columns=new User;
        $columns = $columns->getFillable();unset($columns[4]);

        // dd($columns);
        // $columns = $this->removeIdTimestampKategoriPasswordAndRememberTokenCol(Schema::getColumnListing('users'));


        return view('user.index',compact(['admin','nasabah','columns']));

    }

    public function create($kategori)
    {
        $user=new User;
        $columns = $user->getFillable();
        // $columns['field'] = $user->getFillable();
        // $columns['tipe'] = ['text',''];
        // dd($columns);

        if($kategori=='Nasabah')
        //tambah
        array_push($columns,'alamat','ktp','dusun');

        return view('user.create',compact(['columns','kategori']));
    }


    public function store(Request $request)
    {
        //validasi
        if($request->kategori=='Nasabah')
        {
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah,Admin",
                "name" =>"required|string",
                "email" =>"required|email|unique:users",
                "telepon"=>"required|string|unique:users",
                "username"=>"required|string|unique:users",
                "password" =>"required|min:6",
                "alamat"=>"required|string",
                "ktp"=>"required|string|unique:nasabahs",
                "dusun"=>"required"
            ]);
        }
        else{
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah,Admin",
                "name" =>"required|string",
                "email" =>"required|email|unique:users",
                "telepon"=>"required|string|unique:users",
                "username"=>"required|string|unique:users",
                "password" =>"required|min:6",
            ]);
        }
        // echo "<p class='ini'>valid</p>";
        // dd($request->all());

        //simpan
        $user=new User;
        $columns = $user->getFillable();
        foreach($columns as $col){
            $user->$col=$request->$col;
            $user->kategori=='Nasabah'?$user->assignRole('Nasabah'):$user->assignRole('Admin');
        }
        $user->save();

        //simpan kalo nasabah
        if($request->kategori=='Nasabah'){
            $nasabah = new Nasabah;
            $nasabah->ktp=$request->ktp;
            $nasabah->alamat=$request->alamat;
            $nasabah->dusun=$request->dusun;
            $nasabah->saldo=0;
            $user->nasabah()->save($nasabah);
        }


        return redirect()->route('user');

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user=User::find($id);
        $columns = $user->getFillable();

        return view('user.edit',compact(['columns','user']));
    }


    public function update(Request $request, $id)
    {
        //validasi
        $this->validate($request, [
            "kategori" =>"required|in:Nasabah,Admin",
            "name" =>"required|string",
            "email" =>'sometimes|required|email|unique:users,id,' . $id,
            "telepon"=>"sometimes|required|string|unique:users,id," . $id,
            "username"=>"sometimes|required|string|unique:users,id," . $id,
            "password" =>"nullable|min:6",
        ]);
        // echo "<p class='ini'>valid</p>";
        // dd($request->all());

        //simpan
        $user=User::find($id);
        $columns = $user->getFillable();
        foreach($columns as $col){
            if($request->$col!=null) //jika tidak null, karena kalau pass null jangan insert
            $user->$col=$request->$col;

            // $user->kategori=='Nasabah'?$user->assignRole('Nasabah'):$user->assignRole('Admin');
        }
        $user->save();

        return redirect()->route('user');
    }


    public function destroy($id)
    {
        User::find($id)
            ->delete()
        ;
        return redirect()->route('user');
    }
}
