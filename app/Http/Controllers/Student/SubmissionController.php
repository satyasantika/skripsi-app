<?php

namespace App\Http\Controllers\Student;

use App\Models\Guide;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index()
    {
        $student_id = Auth::id();
        $submission = Submission::where('student_id',$student_id);
        if ($submission->doesntExist()) {
            return redirect()->route('submission.create');
        }
        $submission = $submission->first();
        $guidesubmissions = Guide::where('submission_id',$submission->id)->get();
        return view('student.submission.home',compact('submission','guidesubmissions'));
    }

    public function create()
    {
        return view('student.submission.create');
    }

    public function store(Request $request)
    {
        $student_id = Auth::id();

        $input = $request->all();
        $input['student_id'] = $student_id;

        if (Submission::where('student_id',$student_id)->doesntExist()) {
            Submission::create($input);
        }
        return $this->index();
    }

    public function show(Submission $submission)
    {
        //
    }

    public function edit(Submission $submission)
    {
        return view('student.submission.edit',compact('submission'));
    }

    public function update(Request $request, Submission $submission)
    {
        $input = $request->all();
        $submission->update($input);
        return $this->index();
    }

    public function destroy(Submission $submission)
    {
        $submission->delete();
        return $this->index();
    }
}
