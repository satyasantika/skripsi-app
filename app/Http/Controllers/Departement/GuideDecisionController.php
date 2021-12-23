<?php

namespace App\Http\Controllers\Lecture;

use App\Models\Guide;
use App\Models\Allocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideDecisionController extends Controller
{
    public function edit(Guide $guidedecision)
    {
        return view('lecture.guidedecision.edit',compact('guidedecision'));
    }

    public function update(Request $request, Guide $guidedecision)
    {
        $lecture_id = $guidedecision->lecture_id;
        // $guides = Guide::where('lecture_id',$lecture_id)->count();
        // if ($this->_quota() > 0) {
            $input = $request->all();
            if ($request->is_approve == "null") {
                $input['is_approve'] = null;
            }
            $guidedecision->update($input);
        // } else {
        //     $this->_declineAll($lecture_id);
        // }
        return redirect()->route('home');
    }

    private function _declineAll($lecture_id)
    {
        return Guide::where('is_approve', null)
                    ->where('lecture_id', $lecture_id)
                    ->update(['is_approve' => 0]);
    }

    private function _quota($lecture_id)
    {
        $allocation = Allocation::where([
                    ['lecture_id','=',$lecture_id],
                    ['year','=','2021']
                    ])->first()->guide_all;
        $guidedecision = Guide::where([
                    ['lecture_id','=',$lecture_id],
                    ['is_approve','=','1']
                    ])->count();
        return $allocation - $guidedecision;
    }

}
