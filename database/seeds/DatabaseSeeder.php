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
        // $this->call(RewardTableSeeder::class);
        $this->call(SampahTableSeeder::class);

        // $this->call(ImportAllBackupSeeders::class);
        //harus paling terakhir soalnya besar skali dpe data, kalau tidak mysql mpaksa kosong
        $this->call(WilayahIndonesiaImportTableSeeders::class);
    }
}
