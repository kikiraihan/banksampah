<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use App\Traits\arrayTrait;
use App\Models\Nasabah;
use App\Models\Pengepul;
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
            foreach($user as $kategori=>$userkat){
                if($kategori=='Admin') $admin=$userkat;
                elseif($kategori=='Nasabah') $nasabah=$userkat;
                elseif($kategori=='Pengepul') $pengepul=$userkat;
            }
        }
        elseif(auth::user()->kategori=="Pengepul"){

            $admin="";
            $nasabah=User::where('kategori','Nasabah')->whereHas('Nasabah', function($usernasabah){
                $usernasabah->where('provinsi',auth::user()->pengepul->provinsi);
            })->get();
            $pengepul=User::where('kategori','Pengepul')
            // ->whereHas('Pengepul', function($userPengepul){
            //     $userpengepul->where('provinsi',auth::user()->pengepul->provinsi);
            // })
            ->get();
        }


        $columns=new User;
        $columns = $columns->getFillable();unset($columns[4]);

        // dd($columns);
        // $columns = $this->removeIdTimestampKategoriPasswordAndRememberTokenCol(Schema::getColumnListing('users'));


        return view('user.index',compact(['admin','nasabah','pengepul','columns']));

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
        array_push($columns,'alamat','ktp','provinsi');

        if($kategori=='Pengepul')
        //tambah
        array_push($columns,'alamat','ktp','provinsi');

        return view('user.create',compact(['columns','kategori']));
    }


    public function store(Request $request)
    {
        //validasi
        if($request->kategori=='Nasabah')
        {
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah,Admin,Pengepul",
                "name" =>"required|string",
                "email" =>"required|email|unique:users",
                "telepon"=>"required|string|unique:users",
                "username"=>"required|string|unique:users",
                "password" =>"required|min:6",
                "alamat"=>"required|string",
                "ktp"=>"nullable|sometimes|string|unique:nasabahs",
                "provinsi"=>"required"
            ]);
        }
        if($request->kategori=='Pengepul')
        {
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah,Admin,Pengepul",
                "name" =>"required|string",
                "email" =>"required|email|unique:users",
                "telepon"=>"required|string|unique:users",
                "username"=>"required|string|unique:users",
                "password" =>"required|min:6",
                "alamat"=>"required|string",
                "ktp"=>"nullable|sometimes|string|unique:nasabahs",
                "provinsi"=>"required"
            ]);
        }
        else{
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah,Admin,Pengepul",
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
            if($user->kategori=='Nasabah')$user->assignRole('Nasabah');
            elseif($user->kategori=='Pengepul')$user->assignRole('Pengepul');
            else$user->assignRole('Admin');
        }
        $user->save();

        //simpan kalo nasabah
        if($request->kategori=='Nasabah'){
            $nasabah = new Nasabah;
            $nasabah->ktp=$request->ktp==NULL?$user->id:$request->ktp;
            $nasabah->alamat=$request->alamat;
            $nasabah->provinsi=$request->provinsi;
            $nasabah->saldo=0;
            $user->nasabah()->save($nasabah);
        }
        elseif($request->kategori=='Pengepul'){
            $pengepul = new Pengepul;
            $pengepul->ktp=$request->ktp==NULL?$user->id:$request->ktp;
            $pengepul->alamat=$request->alamat;
            $pengepul->provinsi=$request->provinsi;
            $user->pengepul()->save($pengepul);
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
        array_push($columns,'alamat','ktp','provinsi');

        if($user->kategori=='Pengepul')
        //tambah
        array_push($columns,'alamat','ktp','provinsi');

        return view('user.edit',compact(['columns','user']));
    }


    public function update(Request $request, $id)
    {
        $user=User::find($id);

        //validasi
        if($user->kategori=='Nasabah')
        {
            $id_kategori=$user->katget->id;

            $this->validate($request, [
                // "kategori" =>"required|in:Nasabah,Admin,Pengepul",
                "name" =>"required|string",
                "email" =>'sometimes|required|email|unique:users,id,' . $id,
                "telepon"=>"sometimes|required|string|unique:users,id," . $id,
                "username"=>"sometimes|required|string|unique:users,id," . $id,
                "password" =>"nullable|min:6",
                "alamat"=>"required|string",
                "ktp"=>"sometimes|string|unique:nasabahs,id,' .$id_kategori,",
                "provinsi"=>"required"
            ]);


        }
        elseif($user->kategori=='Pengepul')
        {
            $id_kategori=$user->katget->id;

            $this->validate($request, [
                // "kategori" =>"required|in:Nasabah,Admin,Pengepul",
                "name" =>"required|string",
                "email" =>'sometimes|required|email|unique:users,id,' . $id,
                "telepon"=>"sometimes|required|string|unique:users,id," . $id,
                "username"=>"sometimes|required|string|unique:users,id," . $id,
                "password" =>"nullable|min:6",
                "alamat"=>"required|string",
                "ktp"=>"sometimes|string|unique:pengepuls,id,' .$id_kategori,",
                "provinsi"=>"required"
            ]);
        }
        else{
            $this->validate($request, [
                // "kategori" =>"required|in:Nasabah,Admin,Pengepul",
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

        if($user->kategori=='Nasabah'){

            $nasabah=$user->nasabah;
            $nasabah->ktp=$request->ktp;
            $nasabah->alamat=$request->alamat;
            $nasabah->provinsi=$request->provinsi;
            $user->nasabah()->save($nasabah);
        }

        elseif($user->kategori=='Pengepul'){

            $pengepul=$user->pengepul;
            $pengepul->ktp=$request->ktp;
            $pengepul->alamat=$request->alamat;
            $pengepul->provinsi=$request->provinsi;
            $user->pengepul()->save($pengepul);
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
