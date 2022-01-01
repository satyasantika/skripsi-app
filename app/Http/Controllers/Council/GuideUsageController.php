<?php

namespace App\Http\Controllers\Council;

use App\Models\Guide;
use App\Models\GuideGroup;
use App\Models\GuideAllocation;
use App\Http\Controllers\Controller;

class GuideUsageController extends Controller
{
    public function __invoke()
    {
        $allocations = GuideAllocation::join('users','guide_allocations.lecture_id','=','users.id')
                                        ->select('guide_allocations.*')
                                        ->orderBy('users.name')
                                        ->get();
        foreach ($allocations as $key => $value) {
            $guide_group_1 = GuideGroup::where('guide_allocation_id',$value->id)
                                        ->where('guide_1','>',0)
                                        ->get()->pluck('id');
            $guide_group_2 = GuideGroup::where('guide_allocation_id',$value->id)
                                        ->where('guide_2','>',0)
                                        ->get()->pluck('id');
            $guide_1_submission = Guide::whereIn('guide_group_id',$guide_group_1)->count();
            $guide_2_submission = Guide::whereIn('guide_group_id',$guide_group_2)->count();
            $guide_1_remain = $value->guide_1-$guide_1_submission;
            $guide_2_remain = $value->guide_2-$guide_2_submission;
            $guide_1_accept = Guide::whereIn('guide_group_id',$guide_group_1)->where('is_approve',1)->count();
            $guide_2_accept = Guide::whereIn('guide_group_id',$guide_group_2)->where('is_approve',1)->count();
            $guide_1_decline = Guide::whereIn('guide_group_id',$guide_group_1)->where('is_approve',0)->count();
            $guide_2_decline = Guide::whereIn('guide_group_id',$guide_group_2)->where('is_approve',0)->count();
            $guideallocations[$key] = [
                'name'=>$value->user->name,
                'guide_1_allocation'=>$value->guide_1,
                'guide_1_remain'=>$guide_1_remain,
                'guide_1_submission'=>$guide_1_submission,
                'guide_1_accept'=>$guide_1_accept,
                'guide_1_decline'=>$guide_1_decline,
                'guide_2_allocation'=>$value->guide_2,
                'guide_2_remain'=>$guide_2_remain,
                'guide_2_submission'=>$guide_2_submission,
                'guide_2_accept'=>$guide_2_accept,
                'guide_2_decline'=>$guide_2_decline,
            ];
        }
        // dd($guideallocations);
        return view('council.guideallocation.usage',compact('guideallocations'));
    }
}
