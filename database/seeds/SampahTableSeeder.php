<?php

use Illuminate\Database\Seeder;

class SampahTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Sampah::class,2)
        ->create();

        // $sampah=new App\Models\Sampah;

        // 'id_member' => 5,
        // 'nama' => $faker->randomElement([
        //     'Pembungkus Plastik',
        //     'Botol kaca',
        // ]),
        // 'deskripsi' => $faker->randomElement([
        //     'Pembungkus makanan ringan, plastik kemasan, dll',
        //     'Botol sosro, fanta, cocacola, cocol aku bang, dan botol minuman lain.',
        // ]),
        // 'satuan' => $faker->randomElement(['kg','gram','pcs']),
        // 'point' => $faker->randomElement([200,100,300]),
    }
}
