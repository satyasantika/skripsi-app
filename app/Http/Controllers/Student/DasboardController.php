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
            $guidesubmissions = Guide::where('submission_id',$submission->id)->get();
        }


        return view('student.dashboard',compact('user','submission','guidesubmissions'));
    }
}
