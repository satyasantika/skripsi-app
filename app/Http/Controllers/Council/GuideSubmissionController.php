<?php

namespace App\Http\Controllers\Council;

use App\Models\Guide;
use App\Models\Section;
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
        $submissionlists = Submission::join('users','submissions.student_id','=','users.id')
                                        ->select('submissions.*')
                                        ->orderBy('users.name')
                                        ->get();
        return view('council.guidesubmission.home',compact('submissionlists'));
    }

    public function store(Request $request)
    {
        // validation
        $currents = Guide::where('submission_id',$request->submission_id)->get();
        $count_of_guide_1 = GuideGroup::find($request->guide_group_id)->guide_1;
        $order_new = $count_of_guide_1 == 0 ? 2 : 1;
        foreach ($currents as $current) {
            $order_current = $current->guide_group->guide_1 == 0 ? 2 : 1;
            if ($order_current == $order_new) {
                return $this->index();
            }
        }
        // store process
        $input = $request->all();
        // $input['submission_id'] = $request->submission_id;
        // submission instantly accepted
        if (Section::first()->name > 1) {
            $input['is_approve'] = 1;
        }
        $input['section_order'] = Section::first()->name;
        $guide_submission_by_id = Guide::where('submission_id',$request->submission_id);
        $guide_group_by_id = GuideGroup::find($request->guide_group_id);
        if ($order_new == 1) {
            $count_of_guide = $count_of_guide_1;
        } else {
            $count_of_guide = $guide_group_by_id->guide_2;
        }

        if (
            $guide_submission_by_id->count() < 2 &&
            $guide_submission_by_id->where('guide_group_id',$request->guide_group_id)->doesntExist() &&
            Guide::where('guide_group_id',$request->guide_group_id)->count() < $count_of_guide
            )
        {
            Guide::create($input);
        }

        return $this->index();
    }

    public function edit(Guide $submissionlist)
    {
        $order = $submissionlist->guide_group->guide_1 == 0 ? 2 : 1;
        $guides = $this->_guideChoice($order,$submissionlist->submission_id);
        return view('council.guidesubmission.edit',compact('submissionlist','guides','order'));
    }

    public function update(Request $request, Guide $submissionlist)
    {
        $input = $request->all();
        $submissionlist->update($input);
        return $this->index();
    }

    public function destroy(Guide $submissionlist)
    {
        $submissionlist->delete();
        return $this->index();
    }

    public function createGuideSubmission($order,$submission_id)
    {
        $guides = $this->_guideChoice($order,$submission_id);
        return view('council.guidesubmission.create',compact('guides','order','submission_id'));
    }

    private function _submissionId($id)
    {
        $user_id = Submission::find($id);
        return Submission::find($id)->id;

    }

    // Menampilkan list pembimbing bergantung pada ajuan/belum
    private function _guideChoice($order,$submission_id)
    {
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
                return $this->_orderedGuide1ByGroup(2021,$group);
            } else {
                return $this->_orderedGuide2ByGroup(2021,$group);
            }
        }
    }
    // Mengambil kuota pembimbing
    private function _guideallocations($year)
    {
        $guideallocation = GuideAllocation::join('users','guide_allocations.lecture_id','=','users.id')
                                            ->select('users.name','guide_allocations.*')
                                            ->where('guide_allocations.year','=',$year);
        return GuideGroup::joinSub($guideallocation,'guide_allocations',function($join){
                            $join->on('guide_groups.guide_allocation_id','=','guide_allocations.id');
                        })
                        ->select('guide_groups.*','guide_allocations.name');
    }

    // List pembimbing 1 yang dipilih pertama kali
    private function _orderedGuide1First($year)
    {
        return $this->_guideallocations($year)
                        ->where('guide_groups.guide_1','>',0)
                        ->orderBy('guide_allocations.name')
                        ->get();
    }

    // List pembimbing 2 yang dipilih pertama kali
    private function _orderedGuide2First($year)
    {
        return $this->_guideallocations($year)
                        ->where('guide_groups.guide_2','>',0)
                        ->orderBy('guide_allocations.name')
                        ->get();
    }

    // List pembimbing 1 yang dipilih setelah pembimbing 2
    private function _orderedGuide1ByGroup($year,$group='')
    {
        return $this->_guideallocations($year)
                            ->where('guide_groups.guide_1','>',0)
                            ->where('guide_groups.group','=',$group)
                            ->orderBy('guide_allocations.name')
                            ->get();
    }

    // List pembimbing 2 yang dipilih setelah pembimbing 1
    private function _orderedGuide2ByGroup($year,$group='')
    {
        return $this->_guideallocations($year)
                            ->where('guide_groups.guide_2','>',0)
                            ->where('guide_groups.group','=',$group)
                            ->orderBy('guide_allocations.name')
                            ->get();
    }

}
