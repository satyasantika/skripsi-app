<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuideGroup extends Model
{
    use Uuids, HasFactory;
    protected $guarded = [];

    public function guide_allocation()
    {
        return $this->belongsTo(GuideAllocation::class);
    }
}
