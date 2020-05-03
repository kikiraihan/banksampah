<?php

use Illuminate\Database\Seeder;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Models\User::class,3)
        ->create(['password'=>'pulkam'])
        ->each(function($user){
            $user->name= $user->id==1?'Nasabah':$user->name;
            $user->email= $user->id==1?'nasabah@gmail.com':$user->email;
            $user->kategori= $user->id==1?'Nasabah':$user->kategori;

            $user->name= $user->id==2?'admin':$user->name;
            $user->email= $user->id==2?'admin@gmail.com':$user->email;
            $user->kategori= $user->id==2?'Admin':$user->kategori;


            if($user->kategori=='Nasabah')
            {
                //BUAT NASABAH
                factory(App\Models\Nasabah::class,1)
                ->create([
                    'id_user'=>$user->id,
                    'provinsi'=>'Gorontalo'
                ]);

                $user->assignRole('Nasabah');

            }
            else
            {
                $user->assignRole('Admin');
            }
            $user->save();
        });








        $user=new App\Models\User;
        $pengepul=new App\Models\Pengepul;

        $user->kategori="Pengepul";
        $user->name="Bagus";
        $user->username="bagus";
        $user->email="bagus@gmail.com";
        $user->telepon="087870636321";
        $user->password="1234";
        $user->assignRole('Pengepul');
        $user->save();

        $pengepul->id_user=$user->id;
        $pengepul->ktp="123";
        $pengepul->provinsi;
        $pengepul->alamat;
        $pengepul->save();






        $user=new App\Models\User;
        $pengepul=new App\Models\Pengepul;

        $user->kategori="Pengepul";
        $user->name="Adit";
        $user->username="adit";
        $user->email="adit@gmail.com";
        $user->telepon="082246461047";
        $user->password="1234";
        $user->assignRole('Pengepul');
        $user->save();

        $pengepul->id_user=$user->id;
        $pengepul->ktp="1234";
        $pengepul->provinsi;
        $pengepul->alamat;
        $pengepul->save();







        $user=new App\Models\User;
        $pengepul=new App\Models\Pengepul;

        $user->kategori="Pengepul";
        $user->name="Fauziyyah";
        $user->username="fau";
        $user->email="fau@gmail.com";
        $user->telepon="085103226373";
        $user->password="1234";
        $user->assignRole('Pengepul');
        $user->save();

        $pengepul->id_user=$user->id;
        $pengepul->ktp="12345";
        $pengepul->provinsi;
        $pengepul->alamat;
        $pengepul->save();







        $user=new App\Models\User;
        $pengepul=new App\Models\Pengepul;

        $user->kategori="Pengepul";
        $user->name="Melati";
        $user->username="melati";
        $user->email="melati@gmail.com";
        $user->telepon="082118282318";
        $user->password="1234";
        $user->assignRole('Pengepul');
        $user->save();

        $pengepul->id_user=$user->id;
        $pengepul->ktp="123456";
        $pengepul->provinsi;
        $pengepul->alamat;
        $pengepul->save();









        $user=new App\Models\User;
        $pengepul=new App\Models\Pengepul;

        $user->kategori="Pengepul";
        $user->name="Kiki";
        $user->username="kiki";
        $user->email="mohzulkiflikatili@gmail.com";
        $user->telepon="082291501085";
        $user->password="pulkam";
        $user->assignRole('Pengepul');
        $user->save();

        $pengepul->id_user=$user->id;
        $pengepul->ktp="1234567";
        $pengepul->provinsi="Gorontalo";
        $pengepul->alamat="Jl. Sawah Besar, Desa Talango, Kec. Kabila, Kab. Bone Bolango";
        $pengepul->save();
    }
}
