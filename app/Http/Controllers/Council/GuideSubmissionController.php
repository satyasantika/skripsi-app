<?php

namespace App\Http\Controllers\Council;

use App\Models\User;
use App\Models\Guide;
use App\Models\GuideGroup;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Models\GuideAllocation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
