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
    }
}
