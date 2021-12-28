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
        // $guidegroup = GuideAllocation::where('year','2021')->get();
        $guidegroup = GuideGroup::where('year','2021')->get();
        return view('council.guidegroup.home',compact('guidegroup'));
    }

    public function create()
    {
        $lectures = User::role('lecture')->get();
        return view('council.guidegroup.create',compact('lectures'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['year'] = 2021;
        if (GuideGroup::where([
            ['lecture_id','=',$request->lecture_id],
            ['year','=','2021'],
            ])->doesntExist()) {
            GuideGroup::create($input);
        }
        return $this->index();
    }

    public function show(GuideGroup $guidegroup)
    {
        //
    }

    public function edit(GuideGroup $guidegroup)
    {
        $lectures = User::role('lecture')->get();
        return view('council.guidegroup.edit',compact('GuideGroup','lectures'));
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
}
