<?php

namespace App\Http\Controllers\Lecture;

use App\Models\Guide;
use App\Models\GuideAllocation;
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
        // AJUAN DITOLAK JIKA KUOTA SUDAH KOSONG
        if ($this->_quota($lecture_id) == 0 ) {
            $this->_declineAll($lecture_id);
        }

        $input = $request->all();
        // PROSES RESET
        if ($request->is_approve == "null") {
            $input['is_approve'] = null;
        }
        $guidedecision->update($input);

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
        $allocation = GuideAllocation::where([
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
