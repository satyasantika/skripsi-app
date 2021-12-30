<?php

namespace App\Http\Controllers\Lecture;

use App\Models\Guide;
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
        $input = $request->all();
        // PROSES RESET
        if ($request->is_approve == "null") {
            $input['is_approve'] = null;
        }
        $guidedecision->update($input);

        return redirect()->route('home');
    }
}
