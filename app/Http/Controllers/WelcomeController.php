<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->getRoleNames()->first();
            return $this->_toHome($role);
        }
        return view('welcome');
    }

    private function _toHome($role)
    {
        return redirect()->route($role.'.home');
    }
}
