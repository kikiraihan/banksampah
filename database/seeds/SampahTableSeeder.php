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
    }
}
