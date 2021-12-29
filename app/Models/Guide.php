<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guide extends Model
{
    use Uuids, HasFactory;
    protected $guarded = [];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function guide_group()
    {
        return $this->belongsTo(GuideGroup::class);
    }
}
