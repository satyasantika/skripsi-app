<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Guide;
use App\Models\GuideGroup;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Models\GuideAllocation;
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
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['submission_id'] = $this->_submissionId();

        if (Guide::where('submission_id',$this->_submissionId())->count() <= 2) {
            Guide::create($input);
        }

        return $this->index();
    }

    public function show(Guide $guide)
    {
        //
    }

    public function edit(Guide $guidesubmission)
    {
        $lectures = $this->_orderedGuide1(2021);
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

    public function createGuideSubmission($order)
    {
        $guides = $this->_guideChoice($order);
        return view('student.guidesubmission.create',compact('guides','order'));
    }

    private function _submissionId()
    {
        $user_id = Auth::id();
        return Submission::where('student_id',$user_id)->first()->id;

    }

    // Menampilkan list pembimbing bergantung pada ajuan/belum
    private function _guideChoice($order)
    {
        $submission_id = $this->_submissionId();
        $guidesubmission = Guide::where('submission_id',$submission_id);
        if ($guidesubmission->doesntExist()) {
            if ($order == 1) {
                return $this->_orderedGuide1First(2021);
            } else {
                return $this->_orderedGuide2First(2021);
            }
        } else {
            $group = GuideGroup::find($guidesubmission->first()->guide_group_id)->group;
            if ($order == 1) {
                return $this->_orderedGuide1Group(2021,$group);
            } else {
                return $this->_orderedGuide2Group(2021,$group);
            }
        }
    }
    // Mengambil kuota pembimbing
    private function _guideallocations($year)
    {
        $guideallocation = GuideAllocation::join('users','guide_allocations.lecture_id','=','users.id')
                                            ->select('users.name','guide_allocations.*')
                                            ->where('guide_allocations.year','=',$year);
        return GuideGroup::joinSub($guideallocation,'guideallocation',function($join){
                            $join->on('guide_groups.guide_allocation_id','=','guideallocation.id');
                        })->select('guide_groups.*','guideallocation.name');
    }

    // List pembimbing 1 yang dipilih pertama kali
    private function _orderedGuide1First($year)
    {
        return $this->_guideallocations($year)
                        ->where('guide_groups.guide_1','>',0)
                        ->orderBy('guideallocation.name')
                        ->get();
    }

    // List pembimbing 2 yang dipilih pertama kali
    private function _orderedGuide2First($year)
    {
        return $this->_guideallocations($year)
                        ->where('guide_groups.guide_2','>',0)
                        ->orderBy('guideallocation.name')
                        ->get();
    }

    // List pembimbing 1 yang dipilih setelah pembimbing 2
    private function _orderedGuide1Group($year,$group='')
    {
        // return GuideGroup::join('users','guide_allocations.lecture_id','=','users.id')
        //                     ->join('guide_allocations','guide_allocations.id','=','guide_gorups.guide_allocation_id')
        //                     ->select('users.name','guide_groups.*')
        //                     ->where('guide_allocations.year','=',$year)
        return $this->_guideallocations($year)
                            ->where('guide_groups.guide_1','>',0)
                            ->where('guide_groups.group','=',$group)
                            ->orderBy('guideallocation.name')
                            ->get();
    }

    // List pembimbing 2 yang dipilih setelah pembimbing 1
    private function _orderedGuide2Group($year,$group='')
    {
        return $this->_guideallocations($year)
                            ->where('guide_groups.guide_2','>',0)
                            ->where('guide_groups.group','=',$group)
                            ->orderBy('guideallocation.name')
                            ->get();
    }

}
