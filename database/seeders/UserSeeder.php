<?php

namespace Database\Seeders;

use App\Imports\UsersImport;
use Illuminate\Database\Seeder;
use App\Imports\GuideGroupsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuideAllocationsImport;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = base_path().'/database/seeders/csv/lectures.csv';
        Excel::import(new UsersImport, $filename);
        $filename = base_path().'/database/seeders/csv/common.csv';
        Excel::import(new UsersImport, $filename);
        $filename = base_path().'/database/seeders/csv/allocations.csv';
        Excel::import(new GuideAllocationsImport, $filename);
        $filename = base_path().'/database/seeders/csv/groups.csv';
        Excel::import(new GuideGroupsImport, $filename);
        $filename = base_path().'/database/seeders/csv/students.csv';
        Excel::import(new UsersImport, $filename);
    }
}
