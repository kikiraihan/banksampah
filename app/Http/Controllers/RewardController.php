<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use File;
use Storage;
use Image;
use Carbon\Carbon;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reward=Reward::all();
        $columns=new Reward;
        $columns = $columns->getFillable();

        //tambah
        array_push($columns,'updated_at');

        return view('reward.index',compact(['reward','columns']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reward=new Reward;
        $columns = $reward->getFillable();

        return view('reward.create',compact(['columns']));
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
            'nama'=>"required|string|unique:rewards",
            'foto'=>"required|",
            'point'=>"required|int",
        ]);
        echo "<p class='ini'>valid</p>";
        // dd($request->all());


        $reward=new Reward;
        //menyimpan foto
        $this->simpanFoto($request, $reward);

        //simpan
        $columns = $reward->getFillable();
        foreach($columns as $col){
            if($col!='foto') $reward->$col=$request->$col;
        }
        $reward->save();

        return redirect()->route('reward');
    }

    public function simpanFoto($request,$reward)
    {

        //buat folder
        $folder='reward/'.title_case($request->nama);
        Storage::disk('public')->makeDirectory($folder);

        //ambil foto, buat..
        $imageData=$request->get('foto');
        $info = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        $avatarjadi=Image::make($info);

        //pathto
        $pathto=$folder.'/'.Carbon::now()->toDateTimeString().'.png';

        //upload
        if ($avatarjadi!=NULL)
        {
            $path=storage_path('app/public/'.$pathto);
            $avatarjadi->save($path);
        }


        if($reward->foto)
        File::delete(storage_path('app/public/'.$reward->getOriginal('foto')));//hapus old, kalo ada
        $reward->foto=$pathto;
        // $reward->save();


        return $avatarjadi->response();



    }










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

        $reward=Reward::find($id);
        $columns = $reward->getFillable();

        return view('reward.edit',compact(['columns','reward']));
    }

    public function update(Request $request, $id)
    {
        //validasi
        $this->validate($request, [
            'nama'=>"sometimes|required|string|unique:rewards,id," . $id,
            'foto'=>"nullable",
            'point'=>"required|int",
        ]);
        echo "<p class='ini'>valid</p>";
        // dd($request->all());


        $reward = Reward::find($id);
        //menyimpan foto
        //hanya jika tidak diset null
        if(isset($request->foto))$this->simpanFoto($request, $reward);

        //simpan
        $columns = $reward->getFillable();
        foreach($columns as $col){
            if($col!='foto') $reward->$col=$request->$col;
        }
        $reward->save();

        return redirect()->route('reward');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reward=Reward::find($id);


        if ($reward->foto) {
            Storage::delete($reward->foto);
        }


        if($reward->foto){
            File::delete(storage_path('app/public/'.$reward->getOriginal('foto')));//hapus old, kalo ada
            File::deleteDirectory(storage_path('app/public/reward/'.$reward->nama));
        }

        $reward->delete();

        return redirect()->route('reward');
    }
}
