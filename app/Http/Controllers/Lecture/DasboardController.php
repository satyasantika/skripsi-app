<?php

namespace App\Http\Controllers\Lecture;

use App\Models\Guide;
use App\Models\GuideAllocation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DasboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $submission = Submission::join('users','submissions.student_id','=','users.id')
                                            ->select('users.name','submissions.*')
                                            ->where('submissions.student_id','=',$user->id);
        $guides = Guide::joinSub($submission,'submissions',function($join){
                            $join->on('guides.submission_id','=','submissions.id');
                        })
                        // join('guide_groups','guides.guide_group_id','=','guide_groups.id')
                        ->where('guide_groups.guide_allocation_id',$this->_allocation($user->id)->id);
        if ($this->_quota($user->id,1) > 0 || $this->_quota($user->id,2) > 0) {
            $guides = $guides->get();
        } else {
            $guides = $guides->where('guides.is_approve',1)
                        // ->latest()
                        ->get();
        }
        return view('lecture.dashboard',compact('user','guides'));
    }

    private function _quota($lecture_id,$order)
    {
        if ($order == 1) {
            $allocation = $this->_allocation()->guide_1;
        } else {
            $allocation = $this->_allocation()->guide_2;
        }

        $guidedecision = Guide::join('guide_groups','guides.guide_group_id','=','guide_groups.id')
                        ->where('guide_groups.guide_allocation_id',$this->_allocation()->id)
                        ->where('guides.is_approve',1)
                        ->count();
        return $allocation - $guidedecision;
    }

    private function _allocation()
    {
        return GuideAllocation::where([
                        ['lecture_id','=',Auth::id()],
                        ['year','=','2021']
                        ])->first();
    }
}
