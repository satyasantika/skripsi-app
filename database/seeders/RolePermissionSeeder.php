<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'lecture']);
        Role::create(['name' => 'student']);
        Role::create(['name' => 'council']);

        Permission::create(['name' => 'add submission'])->assignRole('student');
        Permission::create(['name' => 'delete submission'])->assignRole('student');
        Permission::create(['name' => 'approve submisison'])->assignRole('lecture');
        Permission::create(['name' => 'decline submission'])->assignRole('lecture');
        Permission::create(['name' => 'add guide allocation'])->assignRole('council');
        Permission::create(['name' => 'delete guide allocation'])->assignRole('council');
        Permission::create(['name' => 'add guide group allocation'])->assignRole('council');
        Permission::create(['name' => 'delete guide group allocation'])->assignRole('council');
    }
}
