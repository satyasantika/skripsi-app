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
        Role::create(['name' => 'dosen']);
        Role::create(['name' => 'mahasiswa']);
        Role::create(['name' => 'sekjur']);
        Role::create(['name' => 'kajur']);
        Role::create(['name' => 'jurusan']);

        Permission::create(['name' => 'menambah ajuan judul'])->assignRole('mahasiswa');
        Permission::create(['name' => 'menghapus ajuan judul'])->assignRole('mahasiswa');
        Permission::create(['name' => 'menyetujui ajuan judul'])->assignRole('dosen');
        Permission::create(['name' => 'menolak ajuan judul'])->assignRole('dosen');
        Permission::create(['name' => 'menetapkan pembimbing'])->syncRoles(['kajur','sekjur']);
    }
}
