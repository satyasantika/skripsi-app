<?php

namespace App\Http\Controllers\council;

use App\Models\User;
use App\Models\GuideAllocation;
use App\Models\GuideGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuideGroupController extends Controller
{
    public function index()
    {
        $groups = GuideGroup::select('group')->groupBy('group')->get();

        return view('council.guidegroup.home',compact('groups'));
    }

    public function create()
    {
        $lectures = $this->_orderedLecture(2022);
        return view('council.guidegroup.create',compact('lectures'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        GuideGroup::create($input);
        return $this->index();
    }

    public function show(GuideGroup $guidegroup)
    {
        //
    }

    public function edit(GuideGroup $guidegroup)
    {
        $lectures = $this->_orderedLecture(2022);
        return view('council.guidegroup.edit',compact('guidegroup','lectures'));
    }

    public function update(Request $request, GuideGroup $guidegroup)
    {
        $input = $request->all();
        $guidegroup->update($input);
        return $this->index();
    }

    public function destroy(GuideGroup $guidegroup)
    {
        $guidegroup->delete();
        return $this->index();
    }

    private function _orderedLecture($year)
    {
        return GuideAllocation::join('users','guide_allocations.lecture_id','=','users.id')
                                ->select('users.name','guide_allocations.*')
                                ->where('guide_allocations.year','=',$year)
                                ->orderBy('users.name')
                                ->get();
    }
}
