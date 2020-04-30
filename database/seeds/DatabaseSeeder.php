<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeders::class);
        $this->call(UsersTableSeeders::class);
        // $this->call(MemberTableSeeders::class);
        $this->call(RewardTableSeeder::class);
        $this->call(SampahTableSeeder::class);
    }
}
