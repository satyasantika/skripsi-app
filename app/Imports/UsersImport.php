<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Spatie\Permission\Models\Role;

class UsersImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            User::create([
                'username'     => $row[0],
                'name'     => $row[1],
                'phone'    => $row[2],
                'email'    => $row[3],
                'address'    => $row[4],
                'password' => bcrypt($row[5]),
            ]);
            $user = User::where('email',$row[3])->first();
            $user->assignRole($row[6]);
        }
    }
}
