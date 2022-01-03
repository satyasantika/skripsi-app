<?php

namespace App\Http\Controllers\Council;

use App\Models\User;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubmissionController extends Controller
{
    public function create()
    {
        return view('council.submission.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['title']='Belum ada judul';
        $student_id = User::where('username',$request->student_id)->first()->id;
        $input['student_id'] = $student_id;
        if (Submission::where('student_id',$student_id)->doesntExist()) {
            Submission::create($input);
        }
        return redirect()->route('submissionlist.index');
    }

}
