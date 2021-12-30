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
        if ($role === 'student') {
            return redirect()->route('student.home');
        }
        if ($role === 'lecture') {
            return redirect()->route('lecture.home');
        }
        if ($role === 'admin') {
            return redirect()->route('admin.home');
        }
        if ($role === 'council') {
            return redirect()->route('council.home');
        }
        return view('home');
    }
}
