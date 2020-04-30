<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use App\Traits\arrayTrait;
use App\Models\Nasabah;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use arrayTrait;

    public function index()
    {
        if(auth::user()->kategori=="Admin"){
            $user=User::
            // with(['nasabah'])->
            get()->groupBy('kategori');
            $admin=$user['Admin'];
            $nasabah=$user['Nasabah'];
            $member=$user['Member'];
        }
        elseif(auth::user()->kategori=="Member"){

            $admin="";
            $nasabah=User::where('kategori','Nasabah')->whereHas('Nasabah', function($usernasabah){
                $usernasabah->where('provinsi',auth::user()->member->provinsi);
            })->get();
            $member=User::where('kategori','Member')
            // ->whereHas('Member', function($usermember){
            //     $usermember->where('provinsi',auth::user()->member->provinsi);
            // })
            ->get();
        }


        $columns=new User;
        $columns = $columns->getFillable();unset($columns[4]);

        // dd($columns);
        // $columns = $this->removeIdTimestampKategoriPasswordAndRememberTokenCol(Schema::getColumnListing('users'));


        return view('user.index',compact(['admin','nasabah','member','columns']));

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
        array_push($columns,'alamat','ktp','dusun','provinsi');

        if($kategori=='Member')
        //tambah
        array_push($columns,'alamat','ktp','dusun','provinsi');

        return view('user.create',compact(['columns','kategori']));
    }


    public function store(Request $request)
    {
        //validasi
        if($request->kategori=='Nasabah')
        {
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah,Admin,Member",
                "name" =>"required|string",
                "email" =>"required|email|unique:users",
                "telepon"=>"required|string|unique:users",
                "username"=>"required|string|unique:users",
                "password" =>"required|min:6",
                "alamat"=>"required|string",
                "ktp"=>"required|string|unique:nasabahs",
                "dusun"=>"required",
                "provinsi"=>"required"
            ]);
        }
        if($request->kategori=='Member')
        {
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah,Admin,Member",
                "name" =>"required|string",
                "email" =>"required|email|unique:users",
                "telepon"=>"required|string|unique:users",
                "username"=>"required|string|unique:users",
                "password" =>"required|min:6",
                "alamat"=>"required|string",
                "ktp"=>"required|string|unique:nasabahs",
                "dusun"=>"required",
                "provinsi"=>"required"
            ]);
        }
        else{
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah,Admin,Member",
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
            $nasabah->provinsi=$request->provinsi;
            $nasabah->saldo=0;
            $user->nasabah()->save($nasabah);
        }
        elseif($request->kategori=='Member'){
            $member = new Member;
            $member->ktp=$request->ktp;
            $member->alamat=$request->alamat;
            $member->dusun=$request->dusun;
            $member->provinsi=$request->provinsi;
            $user->member()->save($member);
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


        if($user->kategori=='Nasabah')
        //tambah
        array_push($columns,'alamat','ktp','dusun','provinsi');

        if($user->kategori=='Member')
        //tambah
        array_push($columns,'alamat','ktp','dusun','provinsi');

        return view('user.edit',compact(['columns','user']));
    }


    public function update(Request $request, $id)
    {
        //validasi
        if($request->kategori=='Nasabah')
        {
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah,Admin,Member",
                "name" =>"required|string",
                "email" =>'sometimes|required|email|unique:users,id,' . $id,
                "telepon"=>"sometimes|required|string|unique:users,id," . $id,
                "username"=>"sometimes|required|string|unique:users,id," . $id,
                "password" =>"nullable|min:6",
                "alamat"=>"required|string",
                "ktp"=>"required|string|unique:nasabahs,id,' . $request->id_kategori,",
                "dusun"=>"required",
                "provinsi"=>"required"
            ]);
        }
        elseif($request->kategori=='Member')
        {
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah,Admin,Member",
                "name" =>"required|string",
                "email" =>'sometimes|required|email|unique:users,id,' . $id,
                "telepon"=>"sometimes|required|string|unique:users,id," . $id,
                "username"=>"sometimes|required|string|unique:users,id," . $id,
                "password" =>"nullable|min:6",
                "alamat"=>"required|string",
                "ktp"=>"required|string|unique:members,id,' . $request->id_kategori,",
                "dusun"=>"required",
                "provinsi"=>"required"
            ]);
        }
        else{
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah,Admin,Member",
                "name" =>"required|string",
                "email" =>'sometimes|required|email|unique:users,id,' . $id,
                "telepon"=>"sometimes|required|string|unique:users,id," . $id,
                "username"=>"sometimes|required|string|unique:users,id," . $id,
                "password" =>"nullable|min:6",
            ]);
        }
        // echo "<p class='ini'>valid</p>";
        // dd($request->ktp);

        //simpan
        $user=User::find($id);
        $columns = $user->getFillable();
        foreach($columns as $col){
            if($request->$col!=null) //jika tidak null, karena kalau pass null jangan insert
            $user->$col=$request->$col;

            // $user->kategori=='Nasabah'?$user->assignRole('Nasabah'):$user->assignRole('Admin');
        }
        $user->save();

        if($request->kategori=='Nasabah'){

            $nasabah=$user->nasabah;
            $nasabah->ktp=$request->ktp;
            $nasabah->alamat=$request->alamat;
            $nasabah->dusun=$request->dusun;
            $nasabah->provinsi=$request->provinsi;
            $user->nasabah()->save($nasabah);
        }

        elseif($request->kategori=='Member'){

            $member=$user->member;
            $member->ktp=$request->ktp;
            $member->alamat=$request->alamat;
            $member->dusun=$request->dusun;
            $member->provinsi=$request->provinsi;
            $user->member()->save($member);
        }

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
