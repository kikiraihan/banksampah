<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class WilayahIndonesiaImportTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::unprepared(File::get("database/migrations/wilayah_indonesia.sql"));
    }
}
