<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamRegistration extends Model
{
    use Uuids, HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }
}
