<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Allocation;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\ToCollection;

class AllocationsImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = User::where('username',$row[0])->first();
            Allocation::create([
                'lecture_id'  => $user->id,
                'guide_1'     => $row[1],
                'guide_2'     => $row[2],
                'guide_all'   => $row[1] + $row[2],
                'examinator'  => $row[3],
                'year'        => 2021,
            ]);
        }
    }
}
