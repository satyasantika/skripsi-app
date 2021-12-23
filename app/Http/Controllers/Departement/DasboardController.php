<?php

namespace App\Http\Controllers\Departement;

use App\Models\Guide;
use App\Models\Allocation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DasboardController extends Controller
{
    public function __invoke()
    {
        return view('departement.dashboard');
    }
}
