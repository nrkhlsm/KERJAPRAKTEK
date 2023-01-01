<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'notaris'
        ]);
        Role::create([
            'name' => 'pemohon'
        ]);
    }
}
