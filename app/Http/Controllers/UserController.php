<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use App\Traits\arrayTrait;
use App\Models\Nasabah;
use App\Models\Pengepul;
use Illuminate\Support\Facades\Auth;
use App\Traits\wilayahIndonesia;

class UserController extends Controller
{
    use arrayTrait;
    use wilayahIndonesia;

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
        $columns = $columns->getFillable();unset($columns[5]);

        // dd($columns);
        // $columns = $this->removeIdTimestampKategoriPasswordAndRememberTokenCol(Schema::getColumnListing('users'));


        return view('user.index',compact(['admin','nasabah','pengepul','columns']));

    }

    public function create($kategori)
    {
        $user=new User;
        $columns = $user->getFillable();

        if($kategori=='Nasabah')
        //tambah
        array_push($columns,'ktp','alamat');

        elseif($kategori=='Pengepul')
        //tambah
        array_push($columns,'ktp','alamat');


        $sql_provinsi =$this->allProvinsi();


        return view('user.create',compact(['columns','kategori','sql_provinsi']));
    }


    public function store(Request $request)
    {
        //validasi
        if($request->kategori=='Nasabah')
        {


            $this->validate($request, [
                "kategori" =>"required|in:Nasabah",
                "name" =>"required|string",
                "email" =>"required|email|unique:users",
                "telepon"=>"required|string|unique:users",
                "username"=>"required|string|unique:users",
                "password" =>"required|min:6",
                "alamat"=>"required|string",
                "ktp"=>"nullable|sometimes|string|unique:nasabahs",

                "provinsi"=>"required|string",
                "kota"=>"required|string",
                "kecamatan"=>"required|string",
                "kelurahan"=>"required|string",
            ]);


        }
        elseif($request->kategori=='Pengepul')
        {
            $this->validate($request, [
                "kategori" =>"required|in:Nasabah",
                "name" =>"required|string",
                "email" =>"required|email|unique:users",
                "telepon"=>"required|string|unique:users",
                "username"=>"required|string|unique:users",
                "password" =>"required|min:6",
                "alamat"=>"required|string",
                "ktp"=>"nullable|sometimes|string|unique:nasabahs",

                "provinsi"=>"required|string",
                "kota"=>"required|string",
                "kecamatan"=>"required|string",
                "kelurahan"=>"required|string",
            ]);
        }
        else{
            $this->validate($request, [
                "kategori" =>"required|in:Admin",
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
            $nasabah->ktp=$request->ktp;//==NULL?$user->id:$request->ktp
            $nasabah->alamat=$request->alamat;
            $nasabah->provinsi=$this->provinsi($request->provinsi)->name;
            $nasabah->kota=$this->kota($request->kota)->name;
            $nasabah->kecamatan=$this->kecamatan($request->kecamatan)->name;
            $nasabah->kelurahan=$this->kelurahan($request->kelurahan)->name;
            $user->nasabah()->save($nasabah);
        }
        elseif($request->kategori=='Pengepul'){
            $pengepul = new Pengepul;
            $pengepul->ktp=$request->ktp;//==NULL?$user->id:$request->ktp
            $pengepul->alamat=$request->alamat;
            $pengepul->provinsi=$this->provinsi($request->provinsi)->name;
            $pengepul->kota=$this->kota($request->kota)->name;
            $pengepul->kecamatan=$this->kecamatan($request->kecamatan)->name;
            $pengepul->kelurahan=$this->kelurahan($request->kelurahan)->name;
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
        array_push($columns,'ktp','alamat');

        if($user->kategori=='Pengepul')
        //tambah
        array_push($columns,'ktp','alamat');


        $sql_provinsi =$this->allProvinsi();


        return view('user.edit',compact(['columns','user','sql_provinsi']));
    }


    public function update(Request $request, $id)
    {
        $user=User::find($id);

        //validasi
        if($user->kategori=='Nasabah')
        {
            $id_kategori=$user->katget->id;

            $this->validate($request, [
                // "kategori" =>"required|in:Nasabah",
                "name" =>"required|string",
                "email" =>'sometimes|required|email|unique:users,id,' . $id,
                "telepon"=>"sometimes|required|string|unique:users,id," . $id,
                "username"=>"sometimes|required|string|unique:users,id," . $id,
                "password" =>"nullable|min:6",
                "alamat"=>"sometimes|required|string",
                "ktp"=>"nullable|string|unique:nasabahs,id,' .$id_kategori,",

                "provinsi"=>"nullable|string",
                "kota"=>"nullable|string",
                "kecamatan"=>"nullable|string",
                "kelurahan"=>"nullable|string",
            ]);


        }
        elseif($user->kategori=='Pengepul')
        {
            $id_kategori=$user->katget->id;

            $this->validate($request, [
                // "kategori" =>"required|in:Pengepul",
                "name" =>"required|string",
                "email" =>'sometimes|required|email|unique:users,id,' . $id,
                "telepon"=>"sometimes|required|string|unique:users,id," . $id,
                "username"=>"sometimes|required|string|unique:users,id," . $id,
                "password" =>"nullable|min:6",
                "alamat"=>"sometimes|required|string",
                "ktp"=>"nullable|string|unique:pengepuls,id,' .$id_kategori,",

                "provinsi"=>"nullable|string",
                "kota"=>"nullable|string",
                "kecamatan"=>"nullable|string",
                "kelurahan"=>"nullable|string",
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
        echo "<p class='ini'>valid</p>";
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
            $columns = $nasabah->getFillable();
            foreach($columns as $col)
            {
                if($request->$col!=null) //jika tidak null, karena kalau pass null jangan insert
                {
                    if($col=='provinsi')
                    $nasabah->provinsi=$this->provinsi($request->provinsi)->name;
                    elseif($col=='kota')
                    $nasabah->kota=$this->kota($request->kota)->name;
                    elseif($col=='kecamatan')
                    $nasabah->kecamatan=$this->kecamatan($request->kecamatan)->name;
                    elseif($col=='kelurahan')
                    $nasabah->kelurahan=$this->kelurahan($request->kelurahan)->name;
                    else
                    $nasabah->$col=$request->$col;

                }
            }

            $user->nasabah()->save($nasabah);
        }

        elseif($user->kategori=='Pengepul'){

            $pengepul=$user->pengepul;
            $columns = $pengepul->getFillable();
            foreach($columns as $col)
            {
                if($request->$col!=null) //jika tidak null, karena kalau pass null jangan insert
                {
                    if($col=='provinsi')
                    $pengepul->provinsi=$this->provinsi($request->provinsi)->name;
                    elseif($col=='kota')
                    $pengepul->kota=$this->kota($request->kota)->name;
                    elseif($col=='kecamatan')
                    $pengepul->kecamatan=$this->kecamatan($request->kecamatan)->name;
                    elseif($col=='kelurahan')
                    $pengepul->kelurahan=$this->kelurahan($request->kelurahan)->name;
                    else
                    $pengepul->$col=$request->$col;

                }
            }
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
