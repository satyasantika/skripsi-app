<?php

namespace App\Http\Controllers\Departement;

use App\Models\User;
use App\Models\Allocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllocationController extends Controller
{
    public function index()
    {
        $allocations = Allocation::where('year','2021')->get();
        return view('departement.allocation.home',compact('allocations'));
    }

    public function create()
    {
        $lectures = User::role('dosen')->get();
        return view('departement.allocation.create',compact('lectures'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['year'] = 2021;
        $input['guide_all'] = $request->guide_1 + $request->guide_2;
        if (Allocation::where([
            ['lecture_id','=',$request->lecture_id],
            ['year','=','2021'],
            ])->doesntExist()) {
            Allocation::create($input);
        }
        return $this->index();
    }

    public function show(Allocation $allocation)
    {
        //
    }

    public function edit(Allocation $allocation)
    {
        $lectures = User::role('dosen')->get();
        return view('departement.allocation.edit',compact('allocation','lectures'));
    }

    public function update(Request $request, Allocation $allocation)
    {
        $input = $request->all();
        $allocation->update($input);
        return $this->index();
    }

    public function destroy(Allocation $allocation)
    {
        $allocation->delete();
        return $this->index();
    }
}
