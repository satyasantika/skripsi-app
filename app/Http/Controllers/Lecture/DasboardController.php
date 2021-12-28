<?php

namespace App\Http\Controllers\Lecture;

use App\Models\Guide;
use App\Models\Allocation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DasboardController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        if ($this->_quota($user->id) > 0) {
            $guides = Guide::where('lecture_id',$user->id)->latest()->get();
        } else {
            $guides = Guide::where([
                    ['lecture_id','=',$user->id],
                    ['is_approve','=','1']
                    ])->latest()->get();
        }
        return view('lecture.dashboard',compact('user','guides'));
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
