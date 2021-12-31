<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(User $studentprofile)
    {
        return view('student.profile.edit',compact('studentprofile'));
    }

    public function update(Request $request, User $studentprofile)
    {
        $input = $request->all();
        $studentprofile->update($input);
        return redirect()->route('student.home');
    }

}
