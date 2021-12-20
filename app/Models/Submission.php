<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use Uuids, HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }
}
