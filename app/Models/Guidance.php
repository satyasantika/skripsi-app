<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guidance extends Model
{
    use Uuids, HasFactory;
    protected $guarded = [];

    public function guide()
    {
        return $this->belongsTo(Guide::class,'guide_id','id');
    }
}
