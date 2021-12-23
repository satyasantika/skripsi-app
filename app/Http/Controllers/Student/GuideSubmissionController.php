<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Guide;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuideSubmissionController extends Controller
{
    public function index()
    {
        return redirect()->route('submission.index');
    }

    public function create()
    {
        $lectures = User::role('dosen')->get();
        return view('student.guidesubmission.create',compact('lectures'));
    }

    public function store(Request $request)
    {
        $student_id = Auth::id();
        $submission_id = Submission::where('student_id',$student_id)->first()->id;

        $input = $request->all();
        $input['submission_id'] = $submission_id;

        Guide::create($input);
        return $this->index();
    }

    public function show(Guide $guide)
    {
        //
    }

    public function edit(Guide $guidesubmission)
    {
        $lectures = User::role('dosen')->get();
        return view('student.guidesubmission.edit',compact('guidesubmission','lectures'));
    }

    public function update(Request $request, Guide $guidesubmission)
    {
        $input = $request->all();
        $guidesubmission->update($input);
        return $this->index();
    }

    public function destroy(Guide $guidesubmission)
    {
        $guidesubmission->delete();
        return $this->index();
    }
}
