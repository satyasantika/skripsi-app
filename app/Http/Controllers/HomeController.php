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
        if ($role === 'admin') {
            return redirect()->route('admin.home');
        }
        if ($role === 'mahasiswa') {
            return redirect()->route('mahasiswa.home');
        }
        if ($role === 'dosen') {
            return redirect()->route('dosen.home');
        }
        if ($role === 'jurusan') {
            return redirect()->route('jurusan.home');
        }
        return view('home');
    }
}
