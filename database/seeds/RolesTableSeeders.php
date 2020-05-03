<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RolesTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles and assign created permissions
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Nasabah']);
        Role::create(['name' => 'Pengepul']);
        Role::create(['name' => 'Challengger']);
    }
}
