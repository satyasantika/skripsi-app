<?php

namespace App\Imports;

use App\Models\User;
use App\Models\GuideGroup;
use App\Models\GuideAllocation;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\ToCollection;

class GuideGroupsImport implements ToCollection
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
            $guide_allocation = GuideAllocation::where([
                ['lecture_id','=',$user->id],
                ['year','=',$row[4]],
                ])->first();
            GuideGroup::create([
                'guide_allocation_id'   => $guide_allocation->id,
                'guide_1'               => $row[1],
                'guide_2'               => $row[2],
                'group'                 => $row[3],
            ]);
        }
    }
}
