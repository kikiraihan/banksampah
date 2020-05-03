<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportAllBackupSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(File::get("database/migrations/backup/users(nasabah).sql"));
        DB::unprepared(File::get("database/migrations/backup/model_has_roles(nasabah).sql"));
        DB::unprepared(File::get("database/migrations/backup/nasabahs.sql"));
    }
}
