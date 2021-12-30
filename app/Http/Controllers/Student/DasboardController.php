<?php

namespace App\Http\Controllers\Student;

use App\Models\Guide;
use App\Models\Submission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DasboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $submission = Submission::where('student_id',$user->id)->first();
        
        if (is_null($submission)) {
            $guidesubmissions = null;
        } else {
            $guidesubmissions = Guide::join('guide_groups','guides.guide_group_id','=','guide_groups.id')
                            ->where('guides.submission_id',$submission->id)
                            ->orderBy('guide_groups.guide_2')
                            ->get();
        }

        return view('student.dashboard',compact('user','submission','guidesubmissions'));
    }
}
