<?php

namespace App\Http\Controllers\Admin;

use App\Models\Guide;
use App\Models\GuideAllocation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DasboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard');
    }
}
