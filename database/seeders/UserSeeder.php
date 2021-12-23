<?php

namespace Database\Seeders;

use App\Imports\UsersImport;
use Illuminate\Database\Seeder;
use App\Imports\AllocationsImport;
use Maatwebsite\Excel\Facades\Excel;

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
        // $filename = base_path().'/database/seeders/csv/common.csv';
        Excel::import(new UsersImport, $filename);
        $filename = base_path().'/database/seeders/csv/allocations.csv';
        Excel::import(new AllocationsImport, $filename);
        $filename = base_path().'/database/seeders/csv/students.csv';
        Excel::import(new UsersImport, $filename);
    }
}
