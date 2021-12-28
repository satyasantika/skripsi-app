<?php

namespace App\Imports;

use App\Models\User;
use App\Models\GuideAllocation;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\ToCollection;

class GuideAllocationsImport implements ToCollection
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
            GuideAllocation::create([
                'lecture_id'  => $user->id,
                'guide_1'     => $row[1],
                'guide_2'     => $row[2],
                'examinator'  => $row[3],
                'year'        => $row[4],
            ]);
        }
    }
}
