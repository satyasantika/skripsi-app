<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Imports\UsersImport;
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
        Excel::import(new UsersImport, $filename);
        $filename = base_path().'/database/seeders/csv/students.csv';
        Excel::import(new UsersImport, $filename);
    }
}
