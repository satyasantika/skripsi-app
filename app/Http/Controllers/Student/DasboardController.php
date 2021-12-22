<?php

namespace App\Http\Controllers\Student;

use App\Models\Submission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DasboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        $submission = Submission::where('student_id',$user->id)->first();

        return view('student.dashboard',compact('user','submission'));
    }
}
