<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guidance extends Model
{
    use Uuids, HasFactory;
    protected $guarded = [];

    public function guide()
    {
        return $this->belongsTo(Guide::class,'guide_id','id');
    }
}
