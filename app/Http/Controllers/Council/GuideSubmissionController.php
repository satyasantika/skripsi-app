<?php

namespace App\Http\Controllers\Council;

use App\Models\Submission;
use App\Http\Controllers\Controller;

class GuideSubmissionController extends Controller
{
    public function __invoke()
    {
        $submissionlists = Submission::join('users','submissions.student_id','=','users.id')
                                        ->select('submissions.*')
                                        ->orderBy('users.name')
                                        ->get();
        return view('council.guidesubmission.home',compact('submissionlists'));
    }
}
