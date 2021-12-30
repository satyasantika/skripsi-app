<?php

namespace App\Http\Controllers\Council;

use App\Models\GuideAllocation;
use App\Http\Controllers\Controller;

class GuideUsageController extends Controller
{
    public function __invoke()
    {
        $guideallocations = GuideAllocation::join('users','guide_allocations.lecture_id','=','users.id')
                                        ->select('guide_allocations.*')
                                        ->orderBy('users.name')
                                        ->get();
        return view('council.guideallocation.usage',compact('guideallocations'));
    }
}
