<?php

namespace App\Http\Controllers\council;

use App\Models\User;
use App\Models\GuideAllocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideAllocationController extends Controller
{
    public function index()
    {
        $guideallocations = GuideAllocation::where('year','2021')
                        ->join('users','guide_allocations.lecture_id','=','users.id')
                        ->select('guide_allocations.*')
                        ->orderBy('users.name')
                        ->get();
        return view('council.guideallocation.home',compact('guideallocations'));
    }

    public function create()
    {
        $lectures = $this->_orderedLecture();
        return view('council.guideallocation.create',compact('lectures'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['year'] = 2021;
        if (GuideAllocation::where([
            ['lecture_id','=',$request->lecture_id],
            ['year','=','2021'],
            ])->doesntExist()) {
            GuideAllocation::create($input);
        }
        return $this->index();
    }

    public function show(GuideAllocation $guideallocation)
    {
        //
    }

    public function edit(GuideAllocation $guideallocation)
    {
        $lectures = $this->_orderedLecture();
        return view('council.guideallocation.edit',compact('guideallocation','lectures'));
    }

    public function update(Request $request, GuideAllocation $guideallocation)
    {
        $input = $request->all();
        $guideallocation->update($input);
        return $this->index();
    }

    public function destroy(GuideAllocation $guideallocation)
    {
        $guideallocation->delete();
        return $this->index();
    }

    private function _orderedLecture()
    {
        return User::role('lecture')->orderBy('name')->get();
    }
}
