<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Examination extends Model
{
    use Uuids, HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'lecture_id','id');
    }
    public function exam_registration()
    {
        return $this->belongsTo(ExamRegistration::class,'exam_registration_id','id');
    }
}
