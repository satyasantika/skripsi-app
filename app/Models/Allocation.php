<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use Uuids, HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'lecture_id','id');
    }
}
