<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function edit()
    {
        return view('admin.section.edit');
    }

    public function update(Request $request)
    {
        $section = Section::find(1);
        $section->update($request->all());
        return $this->edit();
    }

}
