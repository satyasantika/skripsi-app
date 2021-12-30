<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first();
        if ($user->hasRole('student')) {
            return redirect()->route('student.home');
        }
        if ($user->hasRole('lecture')) {
            return redirect()->route('lecture.home');
        }
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.home');
        }
        if ($user->hasRole('council')) {
            return redirect()->route('council.home');
        }
        return view('home');
    }
}
