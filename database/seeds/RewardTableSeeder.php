<?php

use Illuminate\Database\Seeder;

class RewardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Reward::class,2)
        ->create();
    }
}
